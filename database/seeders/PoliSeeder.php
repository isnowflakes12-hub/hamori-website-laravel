<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder {
    public function run(): void {
        $polis = [
            'Penyakit Dalam','Kardiologi','Ortopedi','Neurologi','Onkologi',
            'Urologi','Kebidanan & Kandungan','Kesehatan Anak','Paru-Paru',
            'THT','Mata','Kulit & Kelamin','Gigi & Mulut','Rehabilitasi Medik',
            'Psikiatri','Bedah Umum','Bedah Saraf','Bedah Plastik',
        ];
        foreach ($polis as $p) {
            DB::table('polis')->insert(['nama' => $p, 'slug' => Str::slug($p), 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
