<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TeramedikApiService;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SyncTeramedikCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teramedik:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Spesialis, Dokter, dan Jadwal dari Teramedik API';

    /**
     * Execute the console command.
     */
    public function handle(TeramedikApiService $api)
    {
        $this->info('Mulai sinkronisasi dari Teramedik API...');

        try {
            $data = $api->getSpecialistDoctorsSchedule();

            if (!is_array($data)) {
                $this->error('Format data tidak valid dari API.');
                return;
            }

            DB::beginTransaction();

            $totalPoli = 0;
            $totalDokter = 0;
            $totalJadwal = 0;

            // Mapping hari berdasarkan format umum (1 = Senin ... 7 = Minggu)
            $mapHari = [
                1 => 'Senin',
                2 => 'Selasa',
                3 => 'Rabu',
                4 => 'Kamis',
                5 => 'Jumat',
                6 => 'Sabtu',
                7 => 'Minggu'
            ];

            // Kumpulkan ID Dokter yang di-sync agar bisa hapus jadwal yang sudah tidak ada
            $syncedDokterIds = [];

            foreach ($data as $specialistData) {
                // 1. Update / Create Poli (Spesialis)
                $tmid = $specialistData['tmid'] ?? null;
                $namaSpesialis = $specialistData['specialist'] ?? 'Umum';

                if (!$tmid) continue;

                $slug = Str::slug($namaSpesialis);

                // Cari poli berdasarkan teramedik_id
                $poli = Poli::where('teramedik_id', (string) $tmid)->first();

                if (!$poli) {
                    // Jika tidak ada by teramedik_id, cari berdasarkan slug (poli manual yang sudah ada)
                    $poli = Poli::where('slug', $slug)->first();
                    if ($poli) {
                        // Jika ada poli lama dengan slug ini, update teramedik_id nya
                        $poli->update([
                            'teramedik_id' => (string) $tmid,
                            'nama' => $namaSpesialis,
                            'is_active' => true,
                        ]);
                    } else {
                        // Jika belum ada sama sekali, buat baru
                        $poli = Poli::create([
                            'teramedik_id' => (string) $tmid,
                            'nama' => $namaSpesialis,
                            'slug' => $slug,
                            'is_active' => true,
                        ]);
                    }
                } else {
                    // Jika poli sudah terhubung dengan teramedik_id, cukup update
                    $poli->update([
                        'nama' => $namaSpesialis,
                        'is_active' => true,
                    ]);
                }
                
                $totalPoli++;

                // 2. Looping Dokter
                $doctors = $specialistData['doctors'] ?? [];
                foreach ($doctors as $docData) {
                    $pid = $docData['pid'] ?? null;
                    $namaDokter = $docData['dokter'] ?? null;

                    if (!$pid || !$namaDokter) continue;

                    $dokter = Dokter::updateOrCreate(
                        ['teramedik_id' => (string) $pid],
                        [
                            'nama' => $namaDokter,
                            'poli_id' => $poli->id,
                            'is_active' => true,
                            // Kita tidak menimpa bio / foto jika sudah ada, jadi tidak diset default empty di sini
                        ]
                    );
                    $totalDokter++;
                    $syncedDokterIds[] = $dokter->id;

                    // 3. Sync Jadwal
                    $schedulesData = $docData['schedules'] ?? [];
                    $syncedDsids = [];

                    foreach ($schedulesData as $poliSchedule) {
                        $scheduleArray = $poliSchedule['schedule'] ?? [];
                        
                        foreach ($scheduleArray as $jadwalData) {
                            $dsid = $jadwalData['dsid'] ?? null;
                            if (!$dsid) continue;

                            $weekday = $jadwalData['weekday'] ?? 1;
                            $startHour = str_pad($jadwalData['start_hour'] ?? 0, 2, '0', STR_PAD_LEFT);
                            $startMinute = str_pad($jadwalData['start_minute'] ?? 0, 2, '0', STR_PAD_LEFT);
                            $endHour = str_pad($jadwalData['end_hour'] ?? 0, 2, '0', STR_PAD_LEFT);
                            $endMinute = str_pad($jadwalData['end_minute'] ?? 0, 2, '0', STR_PAD_LEFT);

                            $hari = $mapHari[$weekday] ?? 'Senin';
                            $jamMulai = "{$startHour}:{$startMinute}:00";
                            $jamSelesai = "{$endHour}:{$endMinute}:00";

                        JadwalDokter::updateOrCreate(
                            ['teramedik_dsid' => (string) $dsid],
                            [
                                'dokter_id' => $dokter->id,
                                'hari' => $hari,
                                'jam_mulai' => $jamMulai,
                                'jam_selesai' => $jamSelesai,
                                'kuota' => 0, // Default 0 atau sesuai kebutuhan
                            ]
                        );
                        $totalJadwal++;
                        $syncedDsids[] = (string) $dsid;
                        }
                    }

                    // Hapus jadwal dokter ini yang ada di DB lokal tetapi tidak ada di API (sudah dihapus di SIMRS)
                    if (!empty($syncedDsids)) {
                        JadwalDokter::where('dokter_id', $dokter->id)
                            ->whereNotNull('teramedik_dsid')
                            ->whereNotIn('teramedik_dsid', $syncedDsids)
                            ->delete();
                    } else {
                        // Jika tidak ada jadwal sama sekali dari API, hapus semua jadwalnya
                        JadwalDokter::where('dokter_id', $dokter->id)
                            ->whereNotNull('teramedik_dsid')
                            ->delete();
                    }
                }
            }

            DB::commit();

            $this->info("Sinkronisasi Selesai!");
            $this->info("Berhasil sinkron: {$totalPoli} Poli, {$totalDokter} Dokter, {$totalJadwal} Jadwal.");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Terjadi Kesalahan: ' . $e->getMessage());
        }
    }
}
