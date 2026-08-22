<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karir;
use Carbon\Carbon;

class KarirSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data karir lama jika ada
        Karir::truncate();

        $data = [
            [
                'posisi'         => 'Dokter Spesialis Penyakit Dalam',
                'departemen'     => 'Poliklinik Spesialis',
                'kategori'       => 'Pelayanan Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang, Jawa Barat',
                'kuota'          => 2,
                'deskripsi'      => '<p>Kami mencari Dokter Spesialis Penyakit Dalam (Sp.PD) yang berdedikasi tinggi untuk bergabung dengan tim medis <strong>RS Hamori</strong>.</p><p>Tanggung jawab utama meliputi:</p><ul><li>Memberikan pelayanan konsultasi dan tindakan spesialistik penyakit dalam secara komprehensif.</li><li>Menangani pasien rawat jalan dan rawat inap.</li><li>Bekerja sama secara proaktif dengan tim medis dan perawat.</li></ul>',
                'persyaratan'    => "- Memiliki ijazah Profesi Dokter Spesialis Penyakit Dalam\n- Memiliki STR (Surat Tanda Registrasi) Spesialis yang masih aktif\n- Bersedia mengurus SIP (Surat Izin Praktik) di wilayah Subang\n- Berpengalaman minimal 2 tahun (Fresh Graduate Sp.PD dipersilakan melamar)\n- Komunikatif, empatik, dan berorientasi pada keselamatan pasien",
                'batas_lamaran'  => Carbon::now()->addDays(30),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Perawat Pelaksana ICU',
                'departemen'     => 'Intensive Care Unit (ICU)',
                'kategori'       => 'Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang, Jawa Barat',
                'kuota'          => 5,
                'deskripsi'      => '<p>Sebagai <strong>Perawat Pelaksana ICU</strong>, Anda akan berperan penting dalam memberikan asuhan keperawatan intensif dan kritis kepada pasien dengan kondisi mengancam jiwa.</p><p>Tugas Anda mencakup pemantauan ketat tanda-tanda vital, pengelolaan alat bantu napas mekanik (ventilator), dan tindakan respons cepat dalam keadaan darurat medis.</p>',
                'persyaratan'    => "- Lulusan D3/S1 Keperawatan\n- Memiliki STR Perawat yang masih aktif\n- Memiliki sertifikat pelatihan ICU Dasar / BTCLS / ACLS yang valid\n- Pengalaman minimal 1 tahun di ruang perawatan intensif (ICU/HCU/PICU)\n- Bersedia bekerja dengan sistem shift",
                'batas_lamaran'  => Carbon::now()->addDays(14),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Staff Administrasi Pendaftaran',
                'departemen'     => 'Rekam Medis & Pendaftaran',
                'kategori'       => 'Non Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang, Jawa Barat',
                'kuota'          => 3,
                'deskripsi'      => '<p>RS Hamori mengundang Anda yang bersemangat dalam bidang pelayanan pelanggan untuk bergabung sebagai <strong>Staff Administrasi Pendaftaran</strong>.</p><p>Anda akan menjadi garda terdepan dalam menyambut pasien, mengelola proses registrasi pasien rawat jalan dan rawat inap, serta memastikan kelancaran administrasi data pasien di Sistem Informasi Manajemen Rumah Sakit (SIMRS).</p>',
                'persyaratan'    => "- Minimal lulusan D3 semua jurusan (diutamakan D3 Rekam Medis / Administrasi Rumah Sakit)\n- Berpenampilan menarik, ramah, dan komunikatif\n- Mahir mengoperasikan komputer (Ms. Office dan sistem basis data)\n- Memiliki kemampuan <i>problem solving</i> yang baik saat menghadapi keluhan pasien\n- Bersedia bekerja shift",
                'batas_lamaran'  => Carbon::now()->addDays(20),
                'is_active'      => true,
            ],
        ];

        foreach ($data as $item) {
            Karir::create($item);
        }
    }
}
