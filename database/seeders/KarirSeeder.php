<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karir;
use Carbon\Carbon;

class KarirSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // PERAWAT
            [
                'posisi'         => 'Perawat Pelaksana IGD',
                'departemen'     => 'Instalasi Gawat Darurat',
                'kategori'       => 'Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 3,
                'deskripsi'      => 'Memberikan asuhan keperawatan langsung kepada pasien gawat darurat dengan tanggap dan profesional.',
                'persyaratan'    => "- D3/S1 Keperawatan, memiliki STR aktif\n- Pengalaman minimal 1 tahun di IGD\n- Memiliki sertifikat BTCLS/ACLS\n- Mampu bekerja dalam tim dan tekanan tinggi",
                'batas_lamaran'  => Carbon::now()->addDays(30),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Perawat Ruang Rawat Inap',
                'departemen'     => 'Rawat Inap Umum',
                'kategori'       => 'Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 5,
                'deskripsi'      => 'Melaksanakan asuhan keperawatan pada pasien rawat inap sesuai standar prosedur operasional RS Hamori.',
                'persyaratan'    => "- D3/S1 Keperawatan, STR aktif\n- Berpengalaman minimal 1 tahun rawat inap\n- Komunikatif dan sabar dalam melayani pasien",
                'batas_lamaran'  => Carbon::now()->addDays(21),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Perawat ICU/ICCU',
                'departemen'     => 'Intensive Care Unit',
                'kategori'       => 'Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 2,
                'deskripsi'      => 'Mengelola asuhan keperawatan kritis pada pasien ICU dengan monitoring ketat dan tindakan cepat.',
                'persyaratan'    => "- S1 Keperawatan, STR aktif\n- Pengalaman ICU minimal 2 tahun\n- Sertifikat CCRN atau ICU Basic diutamakan",
                'batas_lamaran'  => Carbon::now()->addDays(14),
                'is_active'      => true,
            ],
            // PENUNJANG MEDIS
            [
                'posisi'         => 'Analis Laboratorium',
                'departemen'     => 'Laboratorium Klinik',
                'kategori'       => 'Penunjang Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 2,
                'deskripsi'      => 'Melakukan pemeriksaan laboratorium klinik meliputi hematologi, kimia darah, urinalisa, dan mikrobiologi.',
                'persyaratan'    => "- D3/D4 Analis Kesehatan / Teknologi Laboratorium Medis\n- STR aktif\n- Teliti, terorganisir, dan bertanggung jawab",
                'batas_lamaran'  => Carbon::now()->addDays(28),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Radiografer',
                'departemen'     => 'Radiologi',
                'kategori'       => 'Penunjang Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 2,
                'deskripsi'      => 'Melakukan pemeriksaan radiologi konvensional, CT-Scan, dan prosedur radiografi sesuai standar proteksi radiasi.',
                'persyaratan'    => "- D3/D4 Radiologi, memiliki SIB dan STR aktif\n- Memahami proteksi radiasi\n- Teliti dan bertanggung jawab",
                'batas_lamaran'  => Carbon::now()->addDays(35),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Apoteker / Asisten Apoteker',
                'departemen'     => 'Instalasi Farmasi',
                'kategori'       => 'Penunjang Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 3,
                'deskripsi'      => 'Melakukan dispensing obat, pelayanan informasi obat, dan farmasi klinik kepada pasien rawat jalan/inap.',
                'persyaratan'    => "- S1 Farmasi / Apoteker (STRA aktif) atau D3 Farmasi (STRTTK aktif)\n- Teliti dan jujur\n- Mampu bekerja shift",
                'batas_lamaran'  => Carbon::now()->addDays(20),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Fisioterapis',
                'departemen'     => 'Rehabilitasi Medik',
                'kategori'       => 'Penunjang Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 1,
                'deskripsi'      => 'Memberikan pelayanan fisioterapi komprehensif kepada pasien dengan gangguan muskuloskeletal, neurologis, dan kardiopulmonal.',
                'persyaratan'    => "- D3/D4/S1 Fisioterapi, STR aktif\n- Pengalaman minimal 1 tahun\n- Sabar dan empatik",
                'batas_lamaran'  => Carbon::now()->addDays(25),
                'is_active'      => true,
            ],
            // PELAYANAN MEDIS
            [
                'posisi'         => 'Dokter Umum',
                'departemen'     => 'Poliklinik Umum & IGD',
                'kategori'       => 'Pelayanan Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 4,
                'deskripsi'      => 'Memberikan pelayanan medis umum di poliklinik rawat jalan dan IGD, serta melakukan triase awal pasien.',
                'persyaratan'    => "- Dokter Umum, SIP aktif\n- Bersedia bekerja shift termasuk malam dan akhir pekan\n- Berkomitmen terhadap mutu pelayanan",
                'batas_lamaran'  => Carbon::now()->addDays(40),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Dokter Spesialis Penyakit Dalam',
                'departemen'     => 'Poliklinik Spesialis',
                'kategori'       => 'Pelayanan Medis',
                'tipe'           => 'part-time',
                'lokasi'         => 'Subang',
                'kuota'          => 1,
                'deskripsi'      => 'Memberikan pelayanan konsultasi dan tindakan spesialistik penyakit dalam untuk pasien rawat jalan dan rawat inap.',
                'persyaratan'    => "- Dokter Spesialis Penyakit Dalam (Sp.PD)\n- SIP aktif dan bersedia praktik di Subang\n- Pengalaman minimal 2 tahun",
                'batas_lamaran'  => Carbon::now()->addDays(45),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Bidan',
                'departemen'     => 'Kebidanan & Kandungan',
                'kategori'       => 'Pelayanan Medis',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 3,
                'deskripsi'      => 'Memberikan asuhan kebidanan pada ibu hamil, bersalin, nifas, dan bayi baru lahir sesuai standar profesi.',
                'persyaratan'    => "- D3/D4/S1 Kebidanan, STR aktif\n- Pengalaman minimal 1 tahun\n- Empati tinggi dan komunikatif",
                'batas_lamaran'  => Carbon::now()->addDays(18),
                'is_active'      => true,
            ],
            // NON PERAWAT
            [
                'posisi'         => 'Staff Administrasi Rawat Jalan',
                'departemen'     => 'Pendaftaran & Rekam Medis',
                'kategori'       => 'Non Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 3,
                'deskripsi'      => 'Melayani pendaftaran pasien rawat jalan, mengelola rekam medis, dan memberikan informasi pelayanan kepada pasien.',
                'persyaratan'    => "- D3/S1 semua jurusan (diutamakan Rekam Medis/Manajemen)\n- Ramah, komunikatif, dan sabar\n- Mampu mengoperasikan komputer",
                'batas_lamaran'  => Carbon::now()->addDays(22),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'Staff Keuangan & Akuntansi',
                'departemen'     => 'Keuangan',
                'kategori'       => 'Non Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 2,
                'deskripsi'      => 'Membantu pengelolaan keuangan rumah sakit meliputi pembukuan, laporan keuangan, dan verifikasi tagihan.',
                'persyaratan'    => "- S1 Akuntansi / Keuangan\n- Memahami akuntansi dasar\n- Teliti, jujur, dan bertanggung jawab",
                'batas_lamaran'  => Carbon::now()->addDays(30),
                'is_active'      => true,
            ],
            [
                'posisi'         => 'IT Support & Infrastruktur',
                'departemen'     => 'Teknologi Informasi',
                'kategori'       => 'Non Perawat',
                'tipe'           => 'full-time',
                'lokasi'         => 'Subang',
                'kuota'          => 1,
                'deskripsi'      => 'Mengelola dan memelihara infrastruktur IT rumah sakit termasuk jaringan, server, dan sistem informasi manajemen RS.',
                'persyaratan'    => "- D3/S1 Teknik Informatika / Sistem Informasi\n- Menguasai jaringan, hardware, dan troubleshooting\n- Berpengalaman dengan SIMRS diutamakan",
                'batas_lamaran'  => Carbon::now()->addDays(38),
                'is_active'      => true,
            ],
        ];

        foreach ($data as $item) {
            Karir::create($item);
        }
    }
}
