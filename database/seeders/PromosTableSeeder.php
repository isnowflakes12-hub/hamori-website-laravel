<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PromosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('promos')->delete();
        
        \DB::table('promos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'judul' => 'Paket Fisioterapi',
                'gambar' => 'promo/promo_1782435891.jpg',
                'deskripsi' => 'Paket layanan fisioterapi RS Hamori membantu pemulihan fisik pasien dengan 3 pilihan: Silver, Gold, dan Platinum. Tiap paket tersedia untuk 4 atau 8 kali kunjungan dengan tarif promo khusus, sehingga pasien dapat memilih layanan sesuai kebutuhan terapi dan kondisi pemulihannya.',
                'harga_normal' => NULL,
                'harga_promo' => NULL,
                'diskon' => NULL,
                'benefit' => '[]',
                'link_wa' => NULL,
                'link_daftar' => NULL,
                'berlaku_mulai' => '2026-07-01 00:00:00',
                'berlaku_sampai' => '2026-07-31 00:00:00',
                'is_active' => 1,
                'is_featured' => 0,
                'urutan' => 1,
                'created_at' => '2026-06-26 00:50:27',
                'updated_at' => '2026-06-26 01:52:50',
                'syarat_ketentuan' => 'Bisa custom layanan sesuai kebutuhan. 
Promo tidak dapat digabung dengan promo lain. 
Berlaku untuk penjamin Pribadi.',
                'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                'terima_bpjs' => 0,
                'is_home_featured' => 0,
            'detail' => 'Layanan fisioterapi ini menawarkan fleksibilitas pilihan perawatan sesuai kebutuhan pasien. Paket Silver mencakup 3 modalitas dengan tarif Rp 529.000 untuk 4 kali kunjungan (dari harga normal Rp 715.000) dan Rp 939.000 untuk 8 kali kunjungan (dari harga normal Rp 1.270.000). Bagi yang membutuhkan perawatan lebih komprehensif, Paket Gold menyediakan 2 modalitas ditambah dengan Massage/Exercise seharga Rp 579.000 untuk 4 kali kunjungan (normal Rp 785.000) dan Rp 1.029.000 untuk 8 kali kunjungan (normal Rp 1.390.000). Pilihan tertinggi adalah Paket Platinum yang memberikan 3 modalitas sekaligus ditambah Massage/Exercise dengan tarif Rp 739.000 untuk 4 kali kunjungan (normal Rp 1.000.000) serta Rp 1.319.000 untuk 8 kali kunjungan (normal Rp 1.785.000).',
                'link_cta' => 'https://wa.me/6281111121705',
            ),
            1 => 
            array (
                'id' => 2,
            'judul' => 'Skrining Benjolan (Cegah Tumor, Sebelum Terlambat!)',
                'gambar' => 'promo/promo_1782435904.jpg',
            'deskripsi' => 'Program pemeriksaan dini (skrining) untuk mendeteksi keberadaan benjolan pada tubuh guna mencegah perkembangan tumor sebelum terlambat. Program ini ditangani langsung oleh Dokter Spesialis Bedah Umum dengan tarif khusus sebesar Rp 75.000.',
                'harga_normal' => NULL,
                'harga_promo' => NULL,
                'diskon' => NULL,
                'benefit' => '[]',
                'link_wa' => NULL,
                'link_daftar' => NULL,
                'berlaku_mulai' => '2026-07-01 00:00:00',
                'berlaku_sampai' => '2026-07-31 00:00:00',
                'is_active' => 1,
                'is_featured' => 0,
                'urutan' => 2,
                'created_at' => '2026-06-26 00:50:27',
                'updated_at' => '2026-06-26 01:52:50',
                'syarat_ketentuan' => 'Hanya berlaku untuk pasien dengan penjamin pribadi.|Promo tidak dapat digabung dengan promo lain.',
                'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                'terima_bpjs' => 0,
                'is_home_featured' => 1,
                'detail' => 'Layanan pemeriksaan ini ditangani oleh dua Dokter Spesialis Bedah Umum dengan jadwal yang dapat disesuaikan. Praktik pertama dipimpin oleh dr. Risman Fadjar, Sp. B yang melayani pasien dari hari Senin sampai Sabtu pada pukul 11.00 hingga 13.00 WIB. Selain itu, terdapat pula jadwal praktik bersama dr. Taufik Gumilar, Sp. B yang tersedia setiap hari Senin, Rabu, dan Jumat pada pukul 16.00 hingga 18.00 WIB.',
                'link_cta' => 'https://wa.me/6281111121705',
            ),
            2 => 
            array (
                'id' => 3,
                'judul' => 'Promo Scaling Gigi',
                'gambar' => 'promo/promo_1782436801.jpg',
            'deskripsi' => 'Gigi Bersih, Senyum Percaya Diri. Program layanan pembersihan karang gigi (scaling) dengan penawaran tarif khusus sebesar Rp 199.000 untuk menjaga kesehatan mulut dan kebersihan gigi pasien agar tampil lebih percaya diri.',
                'harga_normal' => NULL,
                'harga_promo' => NULL,
                'diskon' => NULL,
                'benefit' => '[]',
                'link_wa' => NULL,
                'link_daftar' => NULL,
                'berlaku_mulai' => NULL,
                'berlaku_sampai' => NULL,
                'is_active' => 1,
                'is_featured' => 0,
                'urutan' => 0,
                'created_at' => '2026-06-26 01:20:01',
                'updated_at' => '2026-06-26 01:52:50',
                'syarat_ketentuan' => 'Hanya berlaku untuk pasien dengan penjamin pribadi.
Promo tidak dapat digabung dengan promo lain.',
                'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                'terima_bpjs' => 0,
                'is_home_featured' => 0,
                'detail' => 'Layanan perawatan gigi ini ditangani langsung oleh Dokter Gigi umum di Rumah Sakit Hamori. Jadwal praktiknya tersedia hampir setiap hari untuk memudahkan pasien menyesuaikan waktu kunjungan mereka. Poliklinik gigi ini melayani pasien dari hari Senin sampai Sabtu pada sesi pagi hingga siang hari, tepatnya mulai pukul 08.00 hingga 14.00 WIB.',
                'link_cta' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'judul' => 'Paket Vaksinasi HPV',
                'gambar' => 'promo/promo_1782436931.jpg',
            'deskripsi' => 'Program layanan pemberian vaksin HPV (Human Papillomavirus) di Rumah Sakit Hamori yang bertujuan untuk mencegah kanker serviks sejak dini. Program ini menyediakan dua pilihan paket proteksi yang disesuaikan dengan status pernikahan pasien.',
                'harga_normal' => NULL,
                'harga_promo' => NULL,
                'diskon' => NULL,
                'benefit' => '[]',
                'link_wa' => NULL,
                'link_daftar' => NULL,
                'berlaku_mulai' => '2026-06-26 00:00:00',
                'berlaku_sampai' => '2026-07-11 00:00:00',
                'is_active' => 1,
                'is_featured' => 1,
                'urutan' => 0,
                'created_at' => '2026-06-26 01:22:11',
                'updated_at' => '2026-06-26 01:52:50',
                'syarat_ketentuan' => 'Berlaku untuk pasien dengan metode pembayaran/penjamin pribadi.
Tindakan injeksi dilakukan sesuai jadwal berkala yang telah ditentukan (bulan ke-0, 2, dan 6).',
                    'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                    'terima_bpjs' => 0,
                    'is_home_featured' => 0,
                'detail' => 'Layanan vaksinasi ini dibagi menjadi dua kategori utama dengan fasilitas yang komprehensif. Pilihan pertama adalah Paket HPV Belum Menikah dengan tarif Rp 6.030.000, sedangkan pilihan kedua adalah Paket HPV Sudah Menikah dengan tarif Rp 6.305.000. Kedua paket tersebut sudah bersifat all-in, mencakup biaya administrasi, konsultasi dokter, serta 3 kali tindakan injeksi yang dilakukan langsung oleh Dokter Spesialis Obgyn (Kandungan) dan Vaksinator pada bulan ke-0, 2, dan 6 menggunakan Vaksin Gardasil-9. Khusus untuk Paket HPV Sudah Menikah, layanan juga sudah termasuk pemeriksaan Papsmear untuk deteksi dini tambahan.',
                    'link_cta' => NULL,
                ),
                4 => 
                array (
                    'id' => 5,
                    'judul' => 'Promo Khitan Anak Spesial Liburan',
                    'gambar' => 'promo/promo_1782437164.jpg',
                    'deskripsi' => 'Program paket khitan khusus anak-anak yang dihadirkan dalam rangka menyambut masa liburan sekolah. Program paket khitan anak khusus masa liburan sekolah di RS Hamori. Layanan dijamin aman dan nyaman karena ditangani langsung oleh Dokter Spesialis, serta dilengkapi hadiah menarik untuk anak.',
                    'harga_normal' => NULL,
                    'harga_promo' => NULL,
                    'diskon' => NULL,
                    'benefit' => '[]',
                    'link_wa' => NULL,
                    'link_daftar' => NULL,
                    'berlaku_mulai' => '2026-06-25 00:00:00',
                    'berlaku_sampai' => '2026-07-10 00:00:00',
                    'is_active' => 1,
                    'is_featured' => 1,
                    'urutan' => 0,
                    'created_at' => '2026-06-26 01:26:04',
                    'updated_at' => '2026-06-26 01:52:50',
                    'syarat_ketentuan' => 'Berlaku untuk penjamin Pribadi.

Wajib melakukan Perjanjian H-1 sebelum tindakan.

Tarif tidak berlaku jika ada penyulit secara medis.

Dilakukan oleh Dokter Spesialis Bedah / Spesialis Bedah Anak.',
                    'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                    'terima_bpjs' => 0,
                    'is_home_featured' => 0,
                    'detail' => 'Layanan khitan ini menawarkan dua pilihan paket sesuai dengan kebutuhan dan kenyamanan anak. Pilihan pertama adalah Paket Khitan Reguler seharga Rp 1.265.000 yang mencakup tindakan di Poliklinik oleh Dokter Spesialis, pemberian bius lokal, serta gratis konsultasi dokter. Pilihan kedua adalah Paket Khitan Premium seharga Rp 6.800.000 yang menawarkan fasilitas lebih intensif berupa tindakan yang dilakukan di Ruang Operasi oleh Dokter Spesialis, pemberian bius total, serta sudah termasuk fasilitas gratis konsultasi dokter.',
                    'link_cta' => NULL,
                ),
                5 => 
                array (
                    'id' => 6,
                    'judul' => 'Paket Vaksin Internasional',
                    'gambar' => 'promo/promo_1782437427.jpg',
                'deskripsi' => 'Program layanan paket vaksin internasional di RS Hamori untuk persiapan perjalanan ke luar negeri (seperti umroh atau traveling). Membantu menjaga kekebalan tubuh pasien sebelum berangkat dan sudah termasuk dokumen resmi E-ICV (Kartu Kuning).',
                    'harga_normal' => NULL,
                    'harga_promo' => NULL,
                    'diskon' => NULL,
                    'benefit' => '[]',
                    'link_wa' => NULL,
                    'link_daftar' => NULL,
                    'berlaku_mulai' => '2026-06-26 00:00:00',
                    'berlaku_sampai' => '2026-07-11 00:00:00',
                    'is_active' => 1,
                    'is_featured' => 1,
                    'urutan' => 0,
                    'created_at' => '2026-06-26 01:30:27',
                    'updated_at' => '2026-06-26 01:52:50',
                    'syarat_ketentuan' => 'Melakukan booking vaksin internasionalmu sebelum berangkat.
Berlaku di Rumah Sakit Hamori.',
                    'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                    'terima_bpjs' => 0,
                    'is_home_featured' => 0,
                    'detail' => 'Layanan vaksinasi internasional ini menyediakan dua pilihan paket proteksi yang dapat dipilih sesuai dengan kebutuhan perjalanan pasien. Pilihan pertama adalah Paket Basic dengan tarif Rp 550.000 yang mencakup Vaksin Meningitis, Polio, serta Imunbooster Caplet. Pilihan kedua yang lebih lengkap adalah Paket Premium seharga Rp 900.000, di mana pasien akan mendapatkan fasilitas Vaksin Meningitis, Polio, Influenza, serta Imunbooster Caplet. Kedua paket tersebut sudah termasuk dokumen E-ICV sebagai bukti validasi vaksinasi resmi.',
                    'link_cta' => NULL,
                ),
                6 => 
                array (
                    'id' => 7,
                    'judul' => 'Paket Persalinan Rumah Sakit Hamori',
                    'gambar' => 'promo/promo_1782437656.jpg',
                'deskripsi' => 'Program paket persalinan di RS Hamori yang menawarkan pilihan metode Normal, SC, dan SC ERACS untuk berbagai kelas rawat inap. Paket sudah termasuk beragam keuntungan gratis (Free Benefit) menarik serta layanan perawatan pasca melahirkan di rumah (Homecare).',
                    'harga_normal' => NULL,
                    'harga_promo' => NULL,
                    'diskon' => NULL,
                    'benefit' => '[]',
                    'link_wa' => NULL,
                    'link_daftar' => NULL,
                    'berlaku_mulai' => '2026-06-01 00:00:00',
                    'berlaku_sampai' => '2030-10-26 00:00:00',
                    'is_active' => 1,
                    'is_featured' => 0,
                    'urutan' => 0,
                    'created_at' => '2026-06-26 01:34:16',
                    'updated_at' => '2026-06-26 01:52:50',
                    'syarat_ketentuan' => '1. Promo tidak dapat digabung dengan promo lain.
2. Kamar rawat inap 2 hari sudah termasuk (obat-obatan rawat inap & obat pulang).
3. Hanya berlaku untuk penjamin pribadi.
4. Tidak berlaku untuk tindakan CITO.
5. Tidak berlaku untuk SC bayi kembar.',
                    'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                    'terima_bpjs' => 0,
                    'is_home_featured' => 0,
                'detail' => 'Layanan persalinan ini menyediakan tarif paket berdasarkan tiga metode tindakan dan tingkatan kelas perawatan. Untuk persalinan Normal, biaya dimulai dari Rp 7.000.000 (Kelas 2) hingga Rp 12.500.000 (President Suite). Bagi tindakan Sectio Caesarea (SC), tarif berkisar antara Rp 12.990.000 (Kelas 3) sampai Rp 29.600.000 (President Suite). Sementara untuk metode SC ERACS, biaya dimulai dari Rp 15.500.000 (Kelas 3) hingga Rp 31.000.000 (President Suite). Setiap pasien akan mendapatkan keuntungan gratis berupa foto bayi baru lahir, akta kelahiran (khusus KK Kabupaten Subang), satu kali breast care, dan tindik bayi perempuan. Selain itu, terdapat bonus layanan Homecare pasca tindakan; berupa perawatan luka operasi, baby massage, dan pijat oksitosin untuk paket SC/ERACS, serta baby massage dan pijat oksitosin untuk paket Normal.',
                    'link_cta' => NULL,
                ),
                7 => 
                array (
                    'id' => 8,
                    'judul' => 'Paket Medical Check Up Pra Nikah',
                    'gambar' => 'promo/promo_1782438218.jpg',
                    'deskripsi' => 'Program pemeriksaan kesehatan menyeluruh di RS Hamori bagi calon pasangan pengantin. Layanan ini bertujuan untuk mendeteksi kondisi kesehatan secara dini demi mewujudkan pernikahan yang sehat, bahagia, dan harmonis.',
                    'harga_normal' => NULL,
                    'harga_promo' => NULL,
                    'diskon' => NULL,
                    'benefit' => '[]',
                    'link_wa' => NULL,
                    'link_daftar' => NULL,
                    'berlaku_mulai' => '2026-06-01 00:00:00',
                    'berlaku_sampai' => '2026-06-30 00:00:00',
                    'is_active' => 1,
                    'is_featured' => 0,
                    'urutan' => 0,
                    'created_at' => '2026-06-26 01:43:38',
                    'updated_at' => '2026-06-26 01:52:50',
                'syarat_ketentuan' => 'Harga paket berlaku mulai dari tarif yang tertera (mulai dari Rp 600.000).
Item atau jenis pemeriksaan lengkap dapat dilihat dengan menggeser informasi lembar brosur berikutnya (swipe/geser).',
                    'cara_mendapatkan' => '["Daftar melalui aplikasi","Hubungi WhatsApp Customer Service"]',
                    'terima_bpjs' => 0,
                    'is_home_featured' => 0,
                    'detail' => 'Layanan pemeriksaan kesehatan ini dirancang khusus untuk mempersiapkan masa depan calon pengantin dengan tarif paket yang sangat terjangkau, yaitu ditawarkan mulai dari Rp 600.000. Melalui paket ini, Anda dan pasangan dapat mengetahui kondisi kesehatan fisik secara menyeluruh sebelum melangsungkan pernikahan, guna mengantisipasi risiko penyakit atau masalah kesehatan yang dapat memengaruhi keharmonisan keluarga di masa depan.',
                    'link_cta' => NULL,
                ),
            ));
        
        
    }
}