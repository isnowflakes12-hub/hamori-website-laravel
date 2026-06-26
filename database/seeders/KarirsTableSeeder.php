<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KarirsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('karirs')->delete();
        
        \DB::table('karirs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'posisi' => 'Perawat Pelaksana IGD',
                'departemen' => 'Instalasi Gawat Darurat',
                'kategori' => 'Perawat',
                'tipe' => 'full-time',
                'lokasi' => 'Subang',
                'kuota' => 3,
                'deskripsi' => 'Memberikan asuhan keperawatan langsung kepada pasien gawat darurat dengan tanggap dan profesional.',
                'persyaratan' => '- D3/S1 Keperawatan, memiliki STR aktif
- Pengalaman minimal 1 tahun di IGD
- Memiliki sertifikat BTCLS/ACLS
- Mampu bekerja dalam tim dan tekanan tinggi',
                'batas_lamaran' => '2026-07-21 02:57:20',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            1 => 
            array (
                'id' => 2,
                'posisi' => 'Perawat Ruang Rawat Inap',
                'departemen' => 'Rawat Inap Umum',
                'kategori' => 'Perawat',
                'tipe' => 'full-time',
                'lokasi' => 'Subang',
                'kuota' => 5,
                'deskripsi' => 'Melaksanakan asuhan keperawatan pada pasien rawat inap sesuai standar prosedur operasional RS Hamori.',
                'persyaratan' => '- D3/S1 Keperawatan, STR aktif
- Berpengalaman minimal 1 tahun rawat inap
- Komunikatif dan sabar dalam melayani pasien',
                'batas_lamaran' => '2026-07-12 02:57:20',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            2 => 
            array (
                'id' => 3,
                'posisi' => 'Perawat ICU/ICCU',
                'departemen' => 'Intensive Care Unit',
                'kategori' => 'Perawat',
                'tipe' => 'full-time',
                'lokasi' => 'Subang',
                'kuota' => 2,
                'deskripsi' => 'Mengelola asuhan keperawatan kritis pada pasien ICU dengan monitoring ketat dan tindakan cepat.',
                'persyaratan' => '- S1 Keperawatan, STR aktif
- Pengalaman ICU minimal 2 tahun
- Sertifikat CCRN atau ICU Basic diutamakan',
                'batas_lamaran' => '2026-07-05 02:57:20',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            3 => 
            array (
                'id' => 4,
                'posisi' => 'Analis Laboratorium',
                'departemen' => 'Laboratorium Klinik',
                'kategori' => 'Penunjang Medis',
                'tipe' => 'full-time',
                'lokasi' => 'Subang',
                'kuota' => 2,
                'deskripsi' => 'Melakukan pemeriksaan laboratorium klinik meliputi hematologi, kimia darah, urinalisa, dan mikrobiologi.',
                'persyaratan' => '- D3/D4 Analis Kesehatan / Teknologi Laboratorium Medis
- STR aktif
- Teliti, terorganisir, dan bertanggung jawab',
                'batas_lamaran' => '2026-07-19 02:57:20',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            4 => 
            array (
                'id' => 5,
                'posisi' => 'Radiografer',
                'departemen' => 'Radiologi',
                'kategori' => 'Penunjang Medis',
                'tipe' => 'full-time',
                'lokasi' => 'Subang',
                'kuota' => 2,
                'deskripsi' => 'Melakukan pemeriksaan radiologi konvensional, CT-Scan, dan prosedur radiografi sesuai standar proteksi radiasi.',
                'persyaratan' => '- D3/D4 Radiologi, memiliki SIB dan STR aktif
- Memahami proteksi radiasi
- Teliti dan bertanggung jawab',
                'batas_lamaran' => '2026-07-26 02:57:20',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            5 => 
            array (
                'id' => 6,
                'posisi' => 'Apoteker / Asisten Apoteker',
                'departemen' => 'Instalasi Farmasi',
                'kategori' => 'Penunjang Medis',
                'tipe' => 'full-time',
                'lokasi' => 'Subang',
                'kuota' => 3,
                'deskripsi' => 'Melakukan dispensing obat, pelayanan informasi obat, dan farmasi klinik kepada pasien rawat jalan/inap.',
            'persyaratan' => '- S1 Farmasi / Apoteker (STRA aktif) atau D3 Farmasi (STRTTK aktif)
- Teliti dan jujur
- Mampu bekerja shift',
            'batas_lamaran' => '2026-07-11 02:57:20',
            'is_active' => 1,
            'created_at' => '2026-06-21 02:57:20',
            'updated_at' => '2026-06-21 02:57:20',
        ),
        6 => 
        array (
            'id' => 7,
            'posisi' => 'Fisioterapis',
            'departemen' => 'Rehabilitasi Medik',
            'kategori' => 'Penunjang Medis',
            'tipe' => 'full-time',
            'lokasi' => 'Subang',
            'kuota' => 1,
            'deskripsi' => 'Memberikan pelayanan fisioterapi komprehensif kepada pasien dengan gangguan muskuloskeletal, neurologis, dan kardiopulmonal.',
            'persyaratan' => '- D3/D4/S1 Fisioterapi, STR aktif
- Pengalaman minimal 1 tahun
- Sabar dan empatik',
            'batas_lamaran' => '2026-07-16 02:57:20',
            'is_active' => 1,
            'created_at' => '2026-06-21 02:57:20',
            'updated_at' => '2026-06-21 02:57:20',
        ),
        7 => 
        array (
            'id' => 8,
            'posisi' => 'Dokter Umum',
            'departemen' => 'Poliklinik Umum & IGD',
            'kategori' => 'Pelayanan Medis',
            'tipe' => 'full-time',
            'lokasi' => 'Subang',
            'kuota' => 4,
            'deskripsi' => 'Memberikan pelayanan medis umum di poliklinik rawat jalan dan IGD, serta melakukan triase awal pasien.',
            'persyaratan' => '- Dokter Umum, SIP aktif
- Bersedia bekerja shift termasuk malam dan akhir pekan
- Berkomitmen terhadap mutu pelayanan',
            'batas_lamaran' => '2026-07-31 02:57:20',
            'is_active' => 1,
            'created_at' => '2026-06-21 02:57:20',
            'updated_at' => '2026-06-21 02:57:20',
        ),
        8 => 
        array (
            'id' => 9,
            'posisi' => 'Dokter Spesialis Penyakit Dalam',
            'departemen' => 'Poliklinik Spesialis',
            'kategori' => 'Pelayanan Medis',
            'tipe' => 'part-time',
            'lokasi' => 'Subang',
            'kuota' => 1,
            'deskripsi' => 'Memberikan pelayanan konsultasi dan tindakan spesialistik penyakit dalam untuk pasien rawat jalan dan rawat inap.',
        'persyaratan' => '- Dokter Spesialis Penyakit Dalam (Sp.PD)
- SIP aktif dan bersedia praktik di Subang
- Pengalaman minimal 2 tahun',
        'batas_lamaran' => '2026-08-05 02:57:20',
        'is_active' => 1,
        'created_at' => '2026-06-21 02:57:20',
        'updated_at' => '2026-06-21 02:57:20',
    ),
    9 => 
    array (
        'id' => 10,
        'posisi' => 'Bidan',
        'departemen' => 'Kebidanan & Kandungan',
        'kategori' => 'Pelayanan Medis',
        'tipe' => 'full-time',
        'lokasi' => 'Subang',
        'kuota' => 3,
        'deskripsi' => 'Memberikan asuhan kebidanan pada ibu hamil, bersalin, nifas, dan bayi baru lahir sesuai standar profesi.',
        'persyaratan' => '- D3/D4/S1 Kebidanan, STR aktif
- Pengalaman minimal 1 tahun
- Empati tinggi dan komunikatif',
        'batas_lamaran' => '2026-07-09 02:57:20',
        'is_active' => 1,
        'created_at' => '2026-06-21 02:57:20',
        'updated_at' => '2026-06-21 02:57:20',
    ),
    10 => 
    array (
        'id' => 11,
        'posisi' => 'Staff Administrasi Rawat Jalan',
        'departemen' => 'Pendaftaran & Rekam Medis',
        'kategori' => 'Non Perawat',
        'tipe' => 'full-time',
        'lokasi' => 'Subang',
        'kuota' => 3,
        'deskripsi' => 'Melayani pendaftaran pasien rawat jalan, mengelola rekam medis, dan memberikan informasi pelayanan kepada pasien.',
    'persyaratan' => '- D3/S1 semua jurusan (diutamakan Rekam Medis/Manajemen)
- Ramah, komunikatif, dan sabar
- Mampu mengoperasikan komputer',
    'batas_lamaran' => '2026-07-13 02:57:20',
    'is_active' => 1,
    'created_at' => '2026-06-21 02:57:20',
    'updated_at' => '2026-06-21 02:57:20',
),
11 => 
array (
    'id' => 12,
    'posisi' => 'Staff Keuangan & Akuntansi',
    'departemen' => 'Keuangan',
    'kategori' => 'Non Perawat',
    'tipe' => 'full-time',
    'lokasi' => 'Subang',
    'kuota' => 2,
    'deskripsi' => 'Membantu pengelolaan keuangan rumah sakit meliputi pembukuan, laporan keuangan, dan verifikasi tagihan.',
    'persyaratan' => '- S1 Akuntansi / Keuangan
- Memahami akuntansi dasar
- Teliti, jujur, dan bertanggung jawab',
    'batas_lamaran' => '2026-07-21 02:57:20',
    'is_active' => 1,
    'created_at' => '2026-06-21 02:57:20',
    'updated_at' => '2026-06-21 02:57:20',
),
12 => 
array (
    'id' => 13,
    'posisi' => 'IT Support & Infrastruktur',
    'departemen' => 'Teknologi Informasi',
    'kategori' => 'Non Perawat',
    'tipe' => 'full-time',
    'lokasi' => 'Subang',
    'kuota' => 1,
    'deskripsi' => 'Mengelola dan memelihara infrastruktur IT rumah sakit termasuk jaringan, server, dan sistem informasi manajemen RS.',
    'persyaratan' => '- D3/S1 Teknik Informatika / Sistem Informasi
- Menguasai jaringan, hardware, dan troubleshooting
- Berpengalaman dengan SIMRS diutamakan',
    'batas_lamaran' => '2026-07-29 02:57:20',
    'is_active' => 1,
    'created_at' => '2026-06-21 02:57:20',
    'updated_at' => '2026-06-21 02:57:20',
),
));
        
        
    }
}