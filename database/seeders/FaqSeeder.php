<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder {
    public function run(): void {
        $faqs = [
            ['pertanyaan' => 'Bagaimana cara membuat appointment di RS Hamori?', 'jawaban' => 'Anda dapat membuat appointment melalui WhatsApp di nomor 0888-890-5555, menghubungi call center 1500 816, atau langsung datang ke RS Hamori.', 'urutan' => 1],
            ['pertanyaan' => 'Apakah RS Hamori melayani pasien BPJS?', 'jawaban' => 'Ya, RS Hamori menerima pasien BPJS Kesehatan. Pastikan Anda membawa kartu BPJS dan surat rujukan dari Faskes Tingkat 1 (Puskesmas atau Klinik).', 'urutan' => 2],
            ['pertanyaan' => 'Apa saja jam operasional klinik rawat jalan?', 'jawaban' => 'Klinik rawat jalan RS Hamori buka setiap hari Senin-Jumat pukul 07.00-21.00 dan Sabtu-Minggu pukul 07.00-17.00. Beberapa poli mungkin memiliki jadwal berbeda sesuai dokter yang bertugas.', 'urutan' => 3],
            ['pertanyaan' => 'Apakah ada layanan IGD 24 jam?', 'jawaban' => 'Ya, RS Hamori menyediakan layanan IGD (Instalasi Gawat Darurat) dan Ambulans 24 jam. Hubungi 0260-4250 999 untuk layanan darurat.', 'urutan' => 4],
            ['pertanyaan' => 'Bagaimana cara mendaftar sebagai pasien rawat jalan?', 'jawaban' => 'Pendaftaran rawat jalan dapat dilakukan di loket pendaftaran RS Hamori dengan membawa KTP/identitas diri, kartu BPJS (jika ada), dan dokumen medis relevan lainnya.', 'urutan' => 5],
            ['pertanyaan' => 'Metode pembayaran apa saja yang diterima?', 'jawaban' => 'RS Hamori menerima pembayaran tunai, kartu debit/kredit, transfer bank, serta berbagai asuransi kesehatan. Kami juga melayani pasien BPJS Kesehatan.', 'urutan' => 6],
        ];
        foreach ($faqs as $f) {
            DB::table('faqs')->insert(array_merge($f, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]));
        }
    }
}
