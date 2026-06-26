<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrivacyPoliciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('privacy_policies')->delete();
        
        \DB::table('privacy_policies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'judul' => 'Pengumpulan Informasi',
                'konten' => 'Contoh',
                'urutan' => 1,
                'is_active' => 1,
                'created_at' => '2026-06-23 07:55:31',
                'updated_at' => '2026-06-23 07:55:31',
            ),
        ));
        
        
    }
}