<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BedAvailabilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bed_availabilities')->delete();
        
        \DB::table('bed_availabilities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kelas' => 'VVIP',
                'nama_ruangan' => 'Suite Room',
                'kapasitas' => 4,
                'terisi' => 2,
                'urutan' => 1,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            1 => 
            array (
                'id' => 2,
                'kelas' => 'VIP',
                'nama_ruangan' => 'Paviliun Anggrek',
                'kapasitas' => 10,
                'terisi' => 6,
                'urutan' => 2,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            2 => 
            array (
                'id' => 3,
                'kelas' => 'Kelas I',
                'nama_ruangan' => 'Paviliun Melati',
                'kapasitas' => 20,
                'terisi' => 14,
                'urutan' => 3,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            3 => 
            array (
                'id' => 4,
                'kelas' => 'Kelas II',
                'nama_ruangan' => 'Bangsal Mawar',
                'kapasitas' => 30,
                'terisi' => 22,
                'urutan' => 4,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            4 => 
            array (
                'id' => 5,
                'kelas' => 'Kelas III',
                'nama_ruangan' => 'Bangsal Flamboyan',
                'kapasitas' => 40,
                'terisi' => 30,
                'urutan' => 5,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            5 => 
            array (
                'id' => 6,
                'kelas' => 'ICU',
                'nama_ruangan' => 'Intensive Care Unit',
                'kapasitas' => 6,
                'terisi' => 4,
                'urutan' => 6,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            6 => 
            array (
                'id' => 7,
                'kelas' => 'NICU',
                'nama_ruangan' => 'Neonatal Intensive Care',
                'kapasitas' => 4,
                'terisi' => 1,
                'urutan' => 7,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
            7 => 
            array (
                'id' => 8,
                'kelas' => 'Isolasi',
                'nama_ruangan' => 'Ruang Isolasi',
                'kapasitas' => 6,
                'terisi' => 2,
                'urutan' => 8,
                'is_active' => true,
                'created_at' => '2026-07-27 13:48:44',
                'updated_at' => '2026-07-27 13:48:44',
            ),
        ));
        
        
    }
}