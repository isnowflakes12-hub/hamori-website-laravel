<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder {
    public function run(): void {
        $fasilitas = [
            ['nama' => 'IGD & Ambulans 24 jam', 'slug' => 'igd-ambulans-24-jam', 'kategori' => 'Pelayanan Medis', 'deskripsi' => 'Layanan IGD dan ambulans tersedia 24 jam sehari, 7 hari seminggu dengan tenaga medis terlatih.'],
            ['nama' => 'Rawat Jalan', 'slug' => 'rawat-jalan', 'kategori' => 'Pelayanan Medis', 'deskripsi' => 'Layanan rawat jalan dengan berbagai poli spesialis yang lengkap.'],
            ['nama' => 'Rawat Intensive dan Isolasi', 'slug' => 'rawat-intensive-dan-isolasi', 'kategori' => 'Pelayanan Medis', 'deskripsi' => 'ICU dan ruang isolasi dengan peralatan medis canggih dan tenaga intensivis.'],
            ['nama' => 'Kamar Operasi', 'slug' => 'kamar-operasi', 'kategori' => 'Pelayanan Medis', 'deskripsi' => 'Kamar operasi modern dengan peralatan bedah terkini dan sterilisasi berstandar tinggi.'],
            ['nama' => 'Radiologi & CT-Scan', 'slug' => 'radiologi-ct-scan', 'kategori' => 'Penunjang Medis', 'deskripsi' => 'Fasilitas radiologi lengkap termasuk CT-Scan, MRI, dan X-Ray digital.'],
            ['nama' => 'Laboratorium', 'slug' => 'laboratorium', 'kategori' => 'Penunjang Medis', 'deskripsi' => 'Laboratorium klinik terakreditasi dengan pemeriksaan lengkap dan hasil cepat.'],
            ['nama' => 'Farmasi', 'slug' => 'farmasi', 'kategori' => 'Penunjang Medis', 'deskripsi' => 'Apotek RS dengan obat-obatan lengkap termasuk obat generik dan paten.'],
            ['nama' => 'Rehabilitasi Medik', 'slug' => 'rehabilitasi-medik', 'kategori' => 'Penunjang Medis', 'deskripsi' => 'Layanan fisioterapi dan rehabilitasi dengan peralatan modern dan fisioterapis berpengalaman.'],
            ['nama' => 'President Suite', 'slug' => 'president-suite', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar rawat inap eksklusif dengan fasilitas setara hotel bintang 5.'],
            ['nama' => 'Suite Room', 'slug' => 'suite-room', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar suite mewah dengan ruang tamu terpisah dan fasilitas premium.'],
            ['nama' => 'VIP', 'slug' => 'vip', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar VIP dengan fasilitas lengkap dan nyaman untuk pemulihan optimal.'],
            ['nama' => 'Kelas Utama', 'slug' => 'kelas-utama', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar kelas utama dengan fasilitas baik dan perawatan profesional.'],
            ['nama' => 'Kelas 1', 'slug' => 'kelas-1', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar kelas 1 untuk 1-2 pasien dengan fasilitas memadai.'],
            ['nama' => 'Kelas 2', 'slug' => 'kelas-2', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar kelas 2 untuk 2-3 pasien dengan fasilitas standar.'],
            ['nama' => 'Kelas 3', 'slug' => 'kelas-3', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar kelas 3 untuk pasien peserta BPJS dan umum.'],
            ['nama' => 'Kamar VK', 'slug' => 'kamar-vk', 'kategori' => 'Rawat Inap', 'deskripsi' => 'Kamar VK (Verlos Kamer) khusus untuk persalinan dengan standar keamanan tinggi.'],
        ];
        foreach ($fasilitas as $f) {
            DB::table('fasilitass')->insert(array_merge($f, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]));
        }
    }
}
