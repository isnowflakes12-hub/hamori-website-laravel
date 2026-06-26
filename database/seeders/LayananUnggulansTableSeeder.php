<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LayananUnggulansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('layanan_unggulans')->delete();
        
        \DB::table('layanan_unggulans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Gatam Institute: Pusat Ortopedi & Tulang Belakang',
                'slug' => 'gatam-institute-pusat-ortopedi-tulang-belakang',
                'logo' => NULL,
                'deskripsi' => 'Pusat layanan ortopedi dan tulang belakang terdepan.',
                'konten' => NULL,
                'urutan' => 1,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'ETWCC: Eka Tjipta Widjaja Cancer Center',
                'slug' => 'eka-hospital-cancer-center',
                'logo' => NULL,
                'deskripsi' => 'Pusat penanganan kanker komprehensif.',
                'konten' => NULL,
                'urutan' => 2,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Diabetes Connection Care: Pusat Diabetes Terintegrasi',
                'slug' => 'diabetes-connection-care-pusat-diabetes-terintegrasi',
                'logo' => NULL,
                'deskripsi' => 'Layanan diabetes terpadu dan komprehensif.',
                'konten' => NULL,
                'urutan' => 3,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'DIVINE: Digestive Intervention & Endoscopy Center',
                'slug' => 'divine-digestive-intervention-endoscopy-center',
                'logo' => NULL,
                'deskripsi' => 'Pusat endoskopi dan tindakan saluran cerna.',
                'konten' => NULL,
                'urutan' => 4,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Urology & Couple Clinic',
                'slug' => 'urology-couple-clinic',
                'logo' => NULL,
                'deskripsi' => 'Klinik urologi dan masalah pasangan.',
                'konten' => NULL,
                'urutan' => 5,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'MYcardia: Pusat Layanan Jantung dan Pembuluh Darah',
                'slug' => 'mycardia-pusat-layanan-jantung-dan-pembuluh-darah',
                'logo' => NULL,
                'deskripsi' => 'Pusat layanan jantung dan kardiovaskular.',
                'konten' => NULL,
                'urutan' => 6,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Pusat Layanan Kebidanan & Kandungan',
                'slug' => 'pusat-layanan-kebidanan-kandungan',
                'logo' => NULL,
                'deskripsi' => 'Layanan obstetri dan ginekologi lengkap.',
                'konten' => NULL,
                'urutan' => 7,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Pusat Layanan Kesehatan Anak Terpadu',
                'slug' => 'pusat-layanan-kesehatan-anak-terpadu',
                'logo' => NULL,
                'deskripsi' => 'Layanan kesehatan anak yang komprehensif.',
                'konten' => NULL,
                'urutan' => 8,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi_singkat' => NULL,
            ),
        ));
        
        
    }
}