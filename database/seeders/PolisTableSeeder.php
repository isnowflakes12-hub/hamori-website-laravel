<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PolisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('polis')->delete();
        
        \DB::table('polis')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Penyakit Dalam',
                'slug' => 'penyakit-dalam',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Kardiologi',
                'slug' => 'kardiologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Ortopedi',
                'slug' => 'ortopedi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Neurologi',
                'slug' => 'neurologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Onkologi',
                'slug' => 'onkologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Urologi',
                'slug' => 'urologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Kebidanan & Kandungan',
                'slug' => 'kebidanan-kandungan',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Kesehatan Anak',
                'slug' => 'kesehatan-anak',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'Paru-Paru',
                'slug' => 'paru-paru',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'THT',
                'slug' => 'tht',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'Mata',
                'slug' => 'mata',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            11 => 
            array (
                'id' => 12,
                'nama' => 'Kulit & Kelamin',
                'slug' => 'kulit-kelamin',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            12 => 
            array (
                'id' => 13,
                'nama' => 'Gigi & Mulut',
                'slug' => 'gigi-mulut',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            13 => 
            array (
                'id' => 14,
                'nama' => 'Rehabilitasi Medik',
                'slug' => 'rehabilitasi-medik',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            14 => 
            array (
                'id' => 15,
                'nama' => 'Psikiatri',
                'slug' => 'psikiatri',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            15 => 
            array (
                'id' => 16,
                'nama' => 'Bedah Umum',
                'slug' => 'bedah-umum',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            16 => 
            array (
                'id' => 17,
                'nama' => 'Bedah Saraf',
                'slug' => 'bedah-saraf',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            17 => 
            array (
                'id' => 18,
                'nama' => 'Bedah Plastik',
                'slug' => 'bedah-plastik',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
        ));
        
        
    }
}