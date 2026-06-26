<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MilestonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('milestones')->delete();
        
        \DB::table('milestones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tahun' => 2023,
                'judul' => 'Peletakan Batu Pertama',
                'deskripsi' => 'Awal mula pembangunan Rumah Sakit Hamori untuk melayani masyarakat Subang.',
                'gambar' => NULL,
                'created_at' => '2026-06-23 14:57:31',
                'updated_at' => '2026-06-23 14:57:31',
            ),
            1 => 
            array (
                'id' => 2,
                'tahun' => 2024,
                'judul' => 'Soft Opening',
                'deskripsi' => 'Pembukaan layanan rawat jalan dan IGD 24 jam dengan fasilitas unggulan.',
                'gambar' => NULL,
                'created_at' => '2026-06-23 14:57:31',
                'updated_at' => '2026-06-23 14:57:31',
            ),
            2 => 
            array (
                'id' => 3,
                'tahun' => 2025,
                'judul' => 'Grand Opening',
                'deskripsi' => 'Peresmian operasional penuh dengan 100+ tempat tidur dan layanan spesialis lengkap.',
                'gambar' => NULL,
                'created_at' => '2026-06-23 14:57:31',
                'updated_at' => '2026-06-23 14:57:31',
            ),
        ));
        
        
    }
}