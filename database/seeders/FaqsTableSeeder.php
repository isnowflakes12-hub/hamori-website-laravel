<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faqs')->delete();
        
        \DB::table('faqs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pertanyaan' => 'Bagaimana cara membuat appointment di RS Hamori?',
                'jawaban' => 'Anda dapat membuat appointment melalui WhatsApp di nomor 0888-890-5555, menghubungi call center 1500 816, atau langsung datang ke RS Hamori.',
                'urutan' => 1,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            1 => 
            array (
                'id' => 2,
                'pertanyaan' => 'Apakah RS Hamori melayani pasien BPJS?',
            'jawaban' => 'Ya, RS Hamori menerima pasien BPJS Kesehatan. Pastikan Anda membawa kartu BPJS dan surat rujukan dari Faskes Tingkat 1 (Puskesmas atau Klinik).',
                'urutan' => 2,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            2 => 
            array (
                'id' => 3,
                'pertanyaan' => 'Apa saja jam operasional klinik rawat jalan?',
                'jawaban' => 'Klinik rawat jalan RS Hamori buka setiap hari Senin-Jumat pukul 07.00-21.00 dan Sabtu-Minggu pukul 07.00-17.00. Beberapa poli mungkin memiliki jadwal berbeda sesuai dokter yang bertugas.',
                'urutan' => 3,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            3 => 
            array (
                'id' => 4,
                'pertanyaan' => 'Apakah ada layanan IGD 24 jam?',
            'jawaban' => 'Ya, RS Hamori menyediakan layanan IGD (Instalasi Gawat Darurat) dan Ambulans 24 jam. Hubungi 0260-4250 999 untuk layanan darurat.',
                'urutan' => 4,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            4 => 
            array (
                'id' => 5,
                'pertanyaan' => 'Bagaimana cara mendaftar sebagai pasien rawat jalan?',
            'jawaban' => 'Pendaftaran rawat jalan dapat dilakukan di loket pendaftaran RS Hamori dengan membawa KTP/identitas diri, kartu BPJS (jika ada), dan dokumen medis relevan lainnya.',
                'urutan' => 5,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
            5 => 
            array (
                'id' => 6,
                'pertanyaan' => 'Metode pembayaran apa saja yang diterima?',
                'jawaban' => 'RS Hamori menerima pembayaran tunai, kartu debit/kredit, transfer bank, serta berbagai asuransi kesehatan. Kami juga melayani pasien BPJS Kesehatan.',
                'urutan' => 6,
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-21 02:57:20',
            ),
        ));
        
        
    }
}