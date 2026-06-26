<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategoriArtikelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kategori_artikels')->delete();
        
        \DB::table('kategori_artikels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'COVID-19',
                'slug' => 'covid-19',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Kisah Inspiratif',
                'slug' => 'kisah-inspiratif',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Berita dan Kegiatan',
                'slug' => 'berita-dan-kegiatan',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'ETWCC',
                'slug' => 'etwcc',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Event',
                'slug' => 'event',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Gatam Institute',
                'slug' => 'gatam-institute',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Info',
                'slug' => 'info',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Disease',
                'slug' => 'disease',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'Artikel',
                'slug' => 'artikel',
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'deskripsi' => NULL,
                'warna' => '#0055a5',
                'urutan' => 0,
                'is_active' => 1,
            ),
        ));
        
        
    }
}