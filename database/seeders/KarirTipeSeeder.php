<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KarirTipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karir_tipes')->truncate();

        DB::table('karir_tipes')->insert([
            [
                'id'        => 1,
                'nama'      => 'Full Time',
                'slug'      => 'full-time',
                'warna'     => '#0055a5',
                'is_active' => true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'id'        => 2,
                'nama'      => 'Part Time',
                'slug'      => 'part-time',
                'warna'     => '#00a859',
                'is_active' => true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'id'        => 3,
                'nama'      => 'Kontrak',
                'slug'      => 'kontrak',
                'warna'     => '#e8333c',
                'is_active' => true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'id'        => 4,
                'nama'      => 'Magang',
                'slug'      => 'magang',
                'warna'     => '#6c3fc5',
                'is_active' => true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
