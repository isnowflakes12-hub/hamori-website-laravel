<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks for clean seeding
        DB::statement('PRAGMA foreign_keys = OFF');

        $this->call([
            // Core / Master Data (urutan penting: parent dulu)
            UsersTableSeeder::class,
            SiteSettingsTableSeeder::class,

            // Fasilitas
            KategoriFasilitasTableSeeder::class,
            FasilitassTableSeeder::class,

            // Konten Publik
            BannersTableSeeder::class,
            PartnersTableSeeder::class,
            TempatTidursTableSeeder::class,

            // Dokter & Jadwal
            DoktersTableSeeder::class,
            JadwalDoktersTableSeeder::class,
            PolisTableSeeder::class,

            // Artikel
            KategoriArtikelsTableSeeder::class,
            ArtikelsTableSeeder::class,

            // Layanan & Promo
            LayananUnggulansTableSeeder::class,
            PromosTableSeeder::class,

            // Karir
            KarirsTableSeeder::class,

            // Informasi RS
            ProfilRsTableSeeder::class,
            MilestonesTableSeeder::class,

            // Konten Statis
            FaqsTableSeeder::class,
            PrivacyPoliciesTableSeeder::class,
        ]);

        // Re-enable foreign key checks
        DB::statement('PRAGMA foreign_keys = ON');
    }
}
