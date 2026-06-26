<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data promo lama agar tidak duplikat saat dijalankan ulang
        Promo::truncate();

        $csvPath = database_path('data/promo.csv');
        
        if (!file_exists($csvPath)) {
            $this->command->error("File promo.csv tidak ditemukan di folder database/data!");
            return;
        }

        $csvFile = fopen($csvPath, "r");
        $isHeader = true;
        
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if ($isHeader) { 
                $isHeader = false; 
                continue; 
            }

            // Pastikan baris data tidak kosong
            if (!isset($data[0]) || trim($data[0]) === '') {
                continue;
            }

            $mulai = $data[11] ?? null;
            if ($mulai && strpos($mulai, '/') !== false) {
                $mulai = \Carbon\Carbon::createFromFormat('d/m/Y', trim($mulai))->format('Y-m-d');
            }

            $sampai = $data[12] ?? null;
            if ($sampai && strpos($sampai, '/') !== false) {
                $sampai = \Carbon\Carbon::createFromFormat('d/m/Y', trim($sampai))->format('Y-m-d');
            }

            Promo::create([
                'judul'            => $data[0],
                'gambar'           => str_replace(',', '.', $data[1]), // Fix typo in filename if any
                'deskripsi'        => $data[2],
                'detail'           => $data[3],
                'syarat_ketentuan' => $data[4],
                'cara_mendapatkan' => !empty($data[5]) ? explode('|', $data[5]) : [],
                'terima_bpjs'      => (bool) $data[6],
                'benefit'          => !empty($data[7]) ? explode('|', $data[7]) : [],
                'link_cta'         => $data[8],
                'is_featured'      => (bool) $data[9],
                'is_home_featured' => (bool) $data[10],
                'berlaku_mulai'    => $mulai,
                'berlaku_sampai'   => $sampai,
                'urutan'           => (int) $data[13],
            ]);    
        }
       
        fclose($csvFile);
        
        $this->command->info('Data Promo berhasil di-seed dari file CSV!');
    }
}
