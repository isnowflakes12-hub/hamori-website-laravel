<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PartnersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('partners')->delete();

        $now = Carbon::now();

        $partners = [
            // Asuransi
            ['nama' => 'BPJS Kesehatan',        'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://bpjs-kesehatan.go.id', 'is_active' => true],
            ['nama' => 'Prudential Indonesia',   'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://prudential.co.id',      'is_active' => true],
            ['nama' => 'Allianz Indonesia',       'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://allianz.co.id',         'is_active' => true],
            ['nama' => 'AXA Mandiri',             'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://axa-mandiri.co.id',     'is_active' => true],
            ['nama' => 'Manulife Indonesia',      'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://manulife.co.id',        'is_active' => true],
            ['nama' => 'Sinarmas MSIG Life',      'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://sinarmasmsig.com',      'is_active' => true],
            ['nama' => 'Admedika',                'logo' => null, 'kategori' => 'Asuransi', 'website' => 'https://admedika.co.id',        'is_active' => true],
            // Korporat / Rekanan
            ['nama' => 'Bank Mandiri',            'logo' => null, 'kategori' => 'Korporat', 'website' => 'https://bankmandiri.co.id',     'is_active' => true],
            ['nama' => 'Bank BRI',                'logo' => null, 'kategori' => 'Korporat', 'website' => 'https://bri.co.id',             'is_active' => true],
            ['nama' => 'PLN (Persero)',            'logo' => null, 'kategori' => 'Korporat', 'website' => 'https://pln.co.id',             'is_active' => true],
            // Pendidikan
            ['nama' => 'Universitas Hamori',      'logo' => null, 'kategori' => 'Pendidikan', 'website' => null,                         'is_active' => true],
        ];

        foreach ($partners as $partner) {
            DB::table('partners')->insert(array_merge($partner, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}