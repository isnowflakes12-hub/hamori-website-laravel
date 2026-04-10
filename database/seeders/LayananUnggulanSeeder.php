<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananUnggulanSeeder extends Seeder {
    public function run(): void {
        $layanans = [
            ['nama' => 'Gatam Institute: Pusat Ortopedi & Tulang Belakang', 'slug' => 'gatam-institute-pusat-ortopedi-tulang-belakang', 'deskripsi' => 'Pusat layanan ortopedi dan tulang belakang terdepan.', 'urutan' => 1],
            ['nama' => 'ETWCC: Eka Tjipta Widjaja Cancer Center', 'slug' => 'eka-hospital-cancer-center', 'deskripsi' => 'Pusat penanganan kanker komprehensif.', 'urutan' => 2],
            ['nama' => 'Diabetes Connection Care: Pusat Diabetes Terintegrasi', 'slug' => 'diabetes-connection-care-pusat-diabetes-terintegrasi', 'deskripsi' => 'Layanan diabetes terpadu dan komprehensif.', 'urutan' => 3],
            ['nama' => 'DIVINE: Digestive Intervention & Endoscopy Center', 'slug' => 'divine-digestive-intervention-endoscopy-center', 'deskripsi' => 'Pusat endoskopi dan tindakan saluran cerna.', 'urutan' => 4],
            ['nama' => 'Urology & Couple Clinic', 'slug' => 'urology-couple-clinic', 'deskripsi' => 'Klinik urologi dan masalah pasangan.', 'urutan' => 5],
            ['nama' => 'MYcardia: Pusat Layanan Jantung dan Pembuluh Darah', 'slug' => 'mycardia-pusat-layanan-jantung-dan-pembuluh-darah', 'deskripsi' => 'Pusat layanan jantung dan kardiovaskular.', 'urutan' => 6],
            ['nama' => 'Pusat Layanan Kebidanan & Kandungan', 'slug' => 'pusat-layanan-kebidanan-kandungan', 'deskripsi' => 'Layanan obstetri dan ginekologi lengkap.', 'urutan' => 7],
            ['nama' => 'Pusat Layanan Kesehatan Anak Terpadu', 'slug' => 'pusat-layanan-kesehatan-anak-terpadu', 'deskripsi' => 'Layanan kesehatan anak yang komprehensif.', 'urutan' => 8],
        ];
        foreach ($layanans as $l) {
            DB::table('layanan_unggulans')->insert(array_merge($l, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]));
        }
    }
}
