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
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Kardiologi',
                'slug' => 'kardiologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Ortopedi',
                'slug' => 'ortopedi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Neurologi',
                'slug' => 'neurologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Onkologi',
                'slug' => 'onkologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Urologi',
                'slug' => 'urologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Kebidanan & Kandungan',
                'slug' => 'kebidanan-kandungan',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Kesehatan Anak',
                'slug' => 'kesehatan-anak',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'Paru-Paru',
                'slug' => 'paru-paru',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'THT',
                'slug' => 'tht',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'Mata',
                'slug' => 'mata',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nama' => 'Kulit & Kelamin',
                'slug' => 'kulit-kelamin',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nama' => 'Gigi & Mulut',
                'slug' => 'gigi-mulut',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nama' => 'Rehabilitasi Medik',
                'slug' => 'rehabilitasi-medik',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nama' => 'Psikiatri',
                'slug' => 'psikiatri',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nama' => 'Bedah Umum',
                'slug' => 'bedah-umum',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'nama' => 'Bedah Saraf',
                'slug' => 'bedah-saraf',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'nama' => 'Bedah Plastik',
                'slug' => 'bedah-plastik',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
                'teramedik_id' => NULL,
            ),
            18 => 
            array (
                'id' => 22,
                'nama' => 'Spesialis Anak',
                'slug' => 'spesialis-anak',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '1',
            ),
            19 => 
            array (
                'id' => 23,
                'nama' => 'Spesialis Kebidanan dan Kandungan',
                'slug' => 'spesialis-kebidanan-dan-kandungan',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '2',
            ),
            20 => 
            array (
                'id' => 24,
                'nama' => 'Spesialis Penyakit Dalam',
                'slug' => 'spesialis-penyakit-dalam',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '3',
            ),
            21 => 
            array (
                'id' => 25,
                'nama' => 'Spesialis Bedah',
                'slug' => 'spesialis-bedah',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '4',
            ),
            22 => 
            array (
                'id' => 26,
                'nama' => 'Spesialis Anestesiologi dan Terapi Intensif',
                'slug' => 'spesialis-anestesiologi-dan-terapi-intensif',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '7',
            ),
            23 => 
            array (
                'id' => 27,
                'nama' => 'Spesialis Jantung dan Pembuluh Darah',
                'slug' => 'spesialis-jantung-dan-pembuluh-darah',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '8',
            ),
            24 => 
            array (
                'id' => 28,
                'nama' => 'Spesialis Mata',
                'slug' => 'spesialis-mata',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '9',
            ),
            25 => 
            array (
                'id' => 29,
                'nama' => 'Spesialis THT',
                'slug' => 'spesialis-tht',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '10',
            ),
            26 => 
            array (
                'id' => 30,
                'nama' => 'Dokter Umum',
                'slug' => 'dokter-umum',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '12',
            ),
            27 => 
            array (
                'id' => 31,
                'nama' => 'Gigi Umum',
                'slug' => 'gigi-umum',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '13',
            ),
            28 => 
            array (
                'id' => 32,
                'nama' => 'Spesialis Bedah Orthopaedi dan Traumatologi',
                'slug' => 'spesialis-bedah-orthopaedi-dan-traumatologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '21',
            ),
            29 => 
            array (
                'id' => 33,
                'nama' => 'Spesialis Bedah Anak',
                'slug' => 'spesialis-bedah-anak',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '22',
            ),
            30 => 
            array (
                'id' => 34,
                'nama' => 'Spesialis Kedokteran Fisik dan Rehabilitasi',
                'slug' => 'spesialis-kedokteran-fisik-dan-rehabilitasi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '23',
            ),
            31 => 
            array (
                'id' => 35,
                'nama' => 'Spesialis Urologi',
                'slug' => 'spesialis-urologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '29',
            ),
            32 => 
            array (
                'id' => 36,
                'nama' => 'Spesialis Bedah Mulut',
                'slug' => 'spesialis-bedah-mulut',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '31',
            ),
            33 => 
            array (
                'id' => 37,
                'nama' => 'Spesialis Paru',
                'slug' => 'spesialis-paru',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '33',
            ),
            34 => 
            array (
                'id' => 38,
                'nama' => 'Spesialis Bedah Saraf',
                'slug' => 'spesialis-bedah-saraf',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '38',
            ),
            35 => 
            array (
                'id' => 39,
                'nama' => 'Spesialis Konservasi Gigi',
                'slug' => 'spesialis-konservasi-gigi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '44',
            ),
            36 => 
            array (
                'id' => 40,
                'nama' => 'Spesialis Ortodonti',
                'slug' => 'spesialis-ortodonti',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '53',
            ),
            37 => 
            array (
                'id' => 41,
                'nama' => 'Spesialis Kulit dan Kelamin',
                'slug' => 'spesialis-kulit-dan-kelamin',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '60',
            ),
            38 => 
            array (
                'id' => 42,
                'nama' => 'Spesialis Neurologi',
                'slug' => 'spesialis-neurologi',
                'deskripsi' => NULL,
                'ikon' => NULL,
                'is_active' => true,
                'created_at' => '2026-07-23 10:42:23',
                'updated_at' => '2026-07-23 10:42:23',
                'teramedik_id' => '66',
            ),
        ));
        
        
    }
}