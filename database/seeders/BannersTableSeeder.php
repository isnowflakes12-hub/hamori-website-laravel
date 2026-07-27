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
                'id' => 3,
                'judul' => NULL,
                'gambar' => 'banners/6dXnwjuVEWi5smIfg1rXpU0qjuGjymJAj8lj8u16.webp',
                'gambar_mobile' => 'banners/nho2KeLwbBpII519V6ryfYxMg1bQZSrBLXLFedBt.webp',
                'link' => NULL,
                'urutan' => 0,
                'is_active' => true,
                'created_at' => '2026-07-23 12:53:12',
                'updated_at' => '2026-07-23 12:53:12',
            ),
            1 => 
            array (
                'id' => 4,
                'judul' => NULL,
                'gambar' => 'banners/kZ5sg0v8hC1gkXMuLtY9fRHHxxl5wtEkSvjETaam.webp',
                'gambar_mobile' => 'banners/3mO8PKoNaNcOFctJSnNLDh24LccQb9RuC2WPvegt.webp',
                'link' => NULL,
                'urutan' => 2,
                'is_active' => true,
                'created_at' => '2026-07-23 13:08:15',
                'updated_at' => '2026-07-23 13:08:15',
            ),
        ));
        
        
    }
}