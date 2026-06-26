<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banners')->delete();
        
        \DB::table('banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'judul' => NULL,
                'gambar' => 'banners/LRrSRtP7wZm9lkBagzMqbSdhaEf8Cr6fQQYV5mlR.jpg',
                'gambar_mobile' => NULL,
                'link' => NULL,
                'urutan' => 0,
                'is_active' => 1,
                'created_at' => '2026-06-22 07:59:43',
                'updated_at' => '2026-06-22 07:59:43',
            ),
            1 => 
            array (
                'id' => 2,
                'judul' => NULL,
                'gambar' => 'banners/ztGqQNxTmwb0iaW9RM8yEQsBcA7tZIFVegDhmStq.jpg',
                'gambar_mobile' => NULL,
                'link' => NULL,
                'urutan' => 0,
                'is_active' => 1,
                'created_at' => '2026-06-22 07:59:52',
                'updated_at' => '2026-06-22 07:59:52',
            ),
        ));
        
        
    }
}