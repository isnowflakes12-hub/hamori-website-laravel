<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KategoriArtikelSeeder extends Seeder {
    public function run(): void {
        $kategoris = ['COVID-19','Kisah Inspiratif','Berita dan Kegiatan','ETWCC','Event','Gatam Institute','Info','Disease','Artikel'];
        foreach ($kategoris as $k) {
            DB::table('kategori_artikels')->insert(['nama' => $k, 'slug' => Str::slug($k), 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
