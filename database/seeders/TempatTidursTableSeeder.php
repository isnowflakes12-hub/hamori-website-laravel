<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TempatTidursTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tempat_tidurs')->delete();
        
        \DB::table('tempat_tidurs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kelas' => 'VIP',
                'total' => 20,
                'terisi' => 12,
                'tersedia' => 8,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            1 => 
            array (
                'id' => 2,
                'kelas' => 'Kelas I',
                'total' => 40,
                'terisi' => 28,
                'tersedia' => 12,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            2 => 
            array (
                'id' => 3,
                'kelas' => 'Kelas II',
                'total' => 60,
                'terisi' => 45,
                'tersedia' => 15,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            3 => 
            array (
                'id' => 4,
                'kelas' => 'Kelas III',
                'total' => 80,
                'terisi' => 55,
                'tersedia' => 25,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            4 => 
            array (
                'id' => 5,
                'kelas' => 'ICU',
                'total' => 10,
                'terisi' => 7,
                'tersedia' => 3,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            5 => 
            array (
                'id' => 6,
                'kelas' => 'NICU',
                'total' => 8,
                'terisi' => 5,
                'tersedia' => 3,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            6 => 
            array (
                'id' => 7,
                'kelas' => 'PICU',
                'total' => 6,
                'terisi' => 4,
                'tersedia' => 2,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            7 => 
            array (
                'id' => 8,
                'kelas' => 'HCU',
                'total' => 8,
                'terisi' => 6,
                'tersedia' => 2,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            8 => 
            array (
                'id' => 9,
                'kelas' => 'Isolasi',
                'total' => 12,
                'terisi' => 3,
                'tersedia' => 9,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
        ));
        
        
    }
}