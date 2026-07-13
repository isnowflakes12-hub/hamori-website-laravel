<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TempatTidursTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tempat_tidurs')->delete();

        $now = Carbon::now();

        $data = [
            ['kelas' => 'VIP',          'total' => 20,  'terisi' => 12, 'tersedia' => 8],
            ['kelas' => 'Kelas I',      'total' => 40,  'terisi' => 28, 'tersedia' => 12],
            ['kelas' => 'Kelas II',     'total' => 60,  'terisi' => 45, 'tersedia' => 15],
            ['kelas' => 'Kelas III',    'total' => 80,  'terisi' => 55, 'tersedia' => 25],
            ['kelas' => 'ICU',          'total' => 10,  'terisi' => 7,  'tersedia' => 3],
            ['kelas' => 'NICU',         'total' => 8,   'terisi' => 5,  'tersedia' => 3],
            ['kelas' => 'PICU',         'total' => 6,   'terisi' => 4,  'tersedia' => 2],
            ['kelas' => 'HCU',          'total' => 8,   'terisi' => 6,  'tersedia' => 2],
            ['kelas' => 'Isolasi',      'total' => 12,  'terisi' => 3,  'tersedia' => 9],
        ];

        foreach ($data as $item) {
            DB::table('tempat_tidurs')->insert(array_merge($item, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}