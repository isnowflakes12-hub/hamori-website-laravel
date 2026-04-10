<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KarirSeeder::class,
            KategoriArtikelSeeder::class,
            LayananUnggulanSeeder::class,
            FasilitasSeeder::class,
            PoliSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
