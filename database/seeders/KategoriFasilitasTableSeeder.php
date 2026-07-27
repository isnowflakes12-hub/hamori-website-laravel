<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategoriFasilitasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kategori_fasilitas')->delete();
        
        \DB::table('kategori_fasilitas')->insert(array (
            0 => 
            array (
                'id' => 2,
                'nama' => 'Pelayanan Medis',
                'slug' => 'pelayanan-medis',
                'deskripsi' => 'Fasilitas poliklinik rawat jalan',
                'urutan' => 1,
                'is_active' => true,
                'created_at' => '2026-06-24 10:12:48',
                'updated_at' => '2026-07-24 14:35:10',
            ),
            1 => 
            array (
                'id' => 3,
                'nama' => 'Penunjang Medis',
                'slug' => 'penunjang-medis',
                'deskripsi' => 'Fasilitas laboratorium, radiologi, dll',
                'urutan' => 2,
                'is_active' => true,
                'created_at' => '2026-06-24 10:12:48',
                'updated_at' => '2026-07-24 14:35:10',
            ),
            2 => 
            array (
                'id' => 1,
                'nama' => 'Rawat Inap',
                'slug' => 'rawat-inap',
                'deskripsi' => 'Fasilitas kamar rawat inap',
                'urutan' => 3,
                'is_active' => true,
                'created_at' => '2026-06-24 10:12:48',
                'updated_at' => '2026-07-24 14:35:10',
            ),
            3 => 
            array (
                'id' => 5,
                'nama' => 'Card Previllage',
                'slug' => 'card-previllage',
                'deskripsi' => 'Contoh card',
                'urutan' => 4,
                'is_active' => true,
                'created_at' => '2026-07-24 14:34:51',
                'updated_at' => '2026-07-24 14:35:10',
            ),
        ));
        
        
    }
}