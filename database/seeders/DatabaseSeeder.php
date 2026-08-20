<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $driver = DB::getDriverName();

        // Disable foreign key checks sesuai driver
        match ($driver) {
            'sqlite' => DB::statement('PRAGMA foreign_keys = OFF'),
            'mysql'  => DB::statement('SET FOREIGN_KEY_CHECKS=0'),
            'pgsql'  => DB::statement('SET session_replication_role = replica'),
            default  => null,
        };

        $this->call([
            // Core / Master Data
            UsersTableSeeder::class,
            SiteSettingsTableSeeder::class,

            // Fasilitas
            KategoriFasilitasTableSeeder::class,
            FasilitassTableSeeder::class,

            // Konten Publik
            BannersTableSeeder::class,
            PartnersTableSeeder::class,
            TempatTidursTableSeeder::class,

            // Dokter & Jadwal (PolisTableSeeder harus sebelum DoktersTableSeeder)
            PolisTableSeeder::class,
            DoktersTableSeeder::class,
            JadwalDoktersTableSeeder::class,

            // Artikel
            KategoriArtikelsTableSeeder::class,
            ArtikelsTableSeeder::class,

            // Promo (tanpa LayananUnggulan)
            PromosTableSeeder::class,

            // Karir
            KarirKategoriSeeder::class,
            KarirTipeSeeder::class,
            KarirsTableSeeder::class,

            // Informasi RS
            ProfilRsTableSeeder::class,
            MilestonesTableSeeder::class,

            // Konten Statis
            FaqsTableSeeder::class,
            PrivacyPoliciesTableSeeder::class,

            // Info Tempat Tidur
            BedAvailabilitiesTableSeeder::class,

            // Admin Menu (Navbar Dinamis)
            AdminMenusTableSeeder::class,
        ]);

        // Re-enable foreign key checks
        match ($driver) {
            'sqlite' => DB::statement('PRAGMA foreign_keys = ON'),
            'mysql'  => DB::statement('SET FOREIGN_KEY_CHECKS=1'),
            'pgsql'  => DB::statement('SET session_replication_role = DEFAULT'),
            default  => null,
        };
    }
}
