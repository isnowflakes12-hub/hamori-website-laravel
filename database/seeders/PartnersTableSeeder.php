<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('partners')->delete();
        
        \DB::table('partners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'BPJS Kesehatan',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://bpjs-kesehatan.go.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Prudential Indonesia',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://prudential.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Allianz Indonesia',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://allianz.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'AXA Mandiri',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://axa-mandiri.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Manulife Indonesia',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://manulife.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Sinarmas MSIG Life',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://sinarmasmsig.com',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Admedika',
                'logo' => NULL,
                'kategori' => 'Asuransi',
                'website' => 'https://admedika.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Bank Mandiri',
                'logo' => NULL,
                'kategori' => 'Korporat',
                'website' => 'https://bankmandiri.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'Bank BRI',
                'logo' => NULL,
                'kategori' => 'Korporat',
                'website' => 'https://bri.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            9 => 
            array (
                'id' => 10,
            'nama' => 'PLN (Persero)',
                'logo' => NULL,
                'kategori' => 'Korporat',
                'website' => 'https://pln.co.id',
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'Universitas Hamori',
                'logo' => NULL,
                'kategori' => 'Pendidikan',
                'website' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:39:57',
                'updated_at' => '2026-07-23 10:39:57',
            ),
        ));
        
        
    }
}