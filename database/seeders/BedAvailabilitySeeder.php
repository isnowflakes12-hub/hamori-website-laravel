<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BedAvailability;
use Illuminate\Support\Facades\DB;

class BedAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bed_availabilities')->truncate();

        $beds = [
            [
                'kelas'        => 'VVIP',
                'nama_ruangan' => 'Suite Room',
                'kapasitas'    => 4,
                'terisi'       => 2,
                'urutan'       => 1,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'VIP',
                'nama_ruangan' => 'Paviliun Anggrek',
                'kapasitas'    => 10,
                'terisi'       => 6,
                'urutan'       => 2,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'Kelas I',
                'nama_ruangan' => 'Paviliun Melati',
                'kapasitas'    => 20,
                'terisi'       => 14,
                'urutan'       => 3,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'Kelas II',
                'nama_ruangan' => 'Bangsal Mawar',
                'kapasitas'    => 30,
                'terisi'       => 22,
                'urutan'       => 4,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'Kelas III',
                'nama_ruangan' => 'Bangsal Flamboyan',
                'kapasitas'    => 40,
                'terisi'       => 30,
                'urutan'       => 5,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'ICU',
                'nama_ruangan' => 'Intensive Care Unit',
                'kapasitas'    => 6,
                'terisi'       => 4,
                'urutan'       => 6,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'NICU',
                'nama_ruangan' => 'Neonatal Intensive Care',
                'kapasitas'    => 4,
                'terisi'       => 1,
                'urutan'       => 7,
                'is_active'    => true,
            ],
            [
                'kelas'        => 'Isolasi',
                'nama_ruangan' => 'Ruang Isolasi',
                'kapasitas'    => 6,
                'terisi'       => 2,
                'urutan'       => 8,
                'is_active'    => true,
            ],
        ];

        foreach ($beds as $bed) {
            BedAvailability::create($bed);
        }
    }
}
