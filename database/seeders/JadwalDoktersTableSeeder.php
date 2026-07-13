<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JadwalDoktersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_dokters')->delete();

        $now     = Carbon::now();
        $dokters = DB::table('dokters')->pluck('id')->toArray();

        if (empty($dokters)) return;

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        $jadwalTemplate = [
            ['jam_mulai' => '08:00:00', 'jam_selesai' => '12:00:00', 'kuota' => 20],
            ['jam_mulai' => '13:00:00', 'jam_selesai' => '17:00:00', 'kuota' => 15],
        ];

        $rows = [];
        foreach ($dokters as $index => $dokterId) {
            // Setiap dokter punya 3 hari praktek
            $hariDokter = array_slice($hariList, ($index * 2) % count($hariList), 3);
            $sesi       = $jadwalTemplate[$index % 2];

            foreach ($hariDokter as $hari) {
                $rows[] = [
                    'dokter_id'   => $dokterId,
                    'hari'        => $hari,
                    'jam_mulai'   => $sesi['jam_mulai'],
                    'jam_selesai' => $sesi['jam_selesai'],
                    'kuota'       => $sesi['kuota'],
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }
        }

        DB::table('jadwal_dokters')->insert($rows);
    }
}