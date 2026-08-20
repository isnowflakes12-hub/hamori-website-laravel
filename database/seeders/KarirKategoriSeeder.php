<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KarirKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate to avoid duplicates (safe karena ada FK check)
        DB::table('karir_kategoris')->truncate();

        DB::table('karir_kategoris')->insert([
            [
                'id'       => 1,
                'nama'     => 'Keperawatan',
                'warna'    => '#0055a5',
                'warna_bg' => '#eff6ff',
                'icon'     => 'bi-heart-pulse',
                'urutan'   => 1,
                'is_active'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'       => 2,
                'nama'     => 'Penunjang Medis',
                'warna'    => '#00a859',
                'warna_bg' => '#f0fdf4',
                'icon'     => 'bi-capsule',
                'urutan'   => 2,
                'is_active'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'       => 3,
                'nama'     => 'Pelayanan Medis',
                'warna'    => '#6c3fc5',
                'warna_bg' => '#faf5ff',
                'icon'     => 'bi-hospital',
                'urutan'   => 3,
                'is_active'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'       => 4,
                'nama'     => 'Front Office',
                'warna'    => '#e6820f',
                'warna_bg' => '#fff7ed',
                'icon'     => 'bi-person-badge',
                'urutan'   => 4,
                'is_active'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'       => 5,
                'nama'     => 'Back Office',
                'warna'    => '#64748b',
                'warna_bg' => '#f8fafc',
                'icon'     => 'bi-briefcase',
                'urutan'   => 5,
                'is_active'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
