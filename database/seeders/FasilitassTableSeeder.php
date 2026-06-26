<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FasilitassTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fasilitass')->delete();
        
        \DB::table('fasilitass')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'IGD & Ambulans 24 jam',
                'slug' => 'igd-ambulans-24-jam',
                'deskripsi' => 'Pelayanan IGD 24 jam dengan kapasitas 17 tempat tidur yang terbagi dalam zona Triage, Resusitasi, Bedah dan Non Bedah, Observasi, Ponek, serta IGD Infeksius. Layanan ambulans tersedia 24 jam penuh untuk kebutuhan transportasi dan evakuasi medis.',
                'konten' => '<p>Konten contohPelayanan 24jam/hari untuk kasus gawat darurat. Terdiri dari 17 tempat tidur yang terbagi dalam zona Triage, Resusitasi, Bedah dan Non Bedah, Observasi, Ponek dan IGD Infeksius.&nbsp;</p><p><br></p><p>Ambulans disiagakan untuk transportasi dan evakuasi selama 24 jam penuh setiap harinya.</p>',
                'gambar' => 'fasilitas/qZwhbCim8yxBqBnIhFuKVMwHPLYAFKgbWZkDXC5G.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:22:08',
                'kategori_id' => 3,
                'galeri' => '["fasilitas\\/qZwhbCim8yxBqBnIhFuKVMwHPLYAFKgbWZkDXC5G.jpg","fasilitas\\/OQp3eSDovLCtNKOyVwRte9d1Foc7glqOzH9afBWW.jpg"]',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Rawat Jalan',
                'slug' => 'rawat-jalan',
                'deskripsi' => 'Layanan rawat jalan dengan berbagai poli spesialis yang lengkap.Layanan rawat jalan komprehensif mencakup klinik spesialis regular dan eksekutif, mulai dari layanan kesehatan umum, gigi, hingga berbagai subspesialis bedah dan rehabilitasi medik. Dilengkapi dengan fasilitas penunjang untuk memberikan kenyamanan dan kemudahan akses bagi pasien.',
            'konten' => '<p><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Rawat Jalan kami terdiri dari rawat jalan eksekutif dan regular untuk pelayanan Klinik Umum, Klinik Gigi, Klinik Penyakit Dalam, Klinik Anak, Klinik Kandungan &amp; Kebidanan, Klinik Bedah Umum, Klinik Bedah Orthopaedi, Klinik Bedah Syaraf, Klinik THT, Klinik Syaraf, Klinik Paru, Klinik Jiwa, Klinik Rehabilitasi Medik, Klinik, Hemodialisa, Klinik Vaksin dan akan terus bertambah sesuai kebutuhan.</span><br style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;"><br style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;"><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Informasi mengenai jadwal praktek dokter dapat menghubungi Call Center 0260-425888 atau pesan whatsapp 08 11111 21 705</span></p>',
                'gambar' => 'fasilitas/O5b7Rv9eaP8mFmc3jR10xJlS2jpPV17kBuoFPbWx.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:20:56',
                'kategori_id' => 2,
                'galeri' => '["fasilitas\\/O5b7Rv9eaP8mFmc3jR10xJlS2jpPV17kBuoFPbWx.jpg","fasilitas\\/CVMpmzL4xytkgLlj4e1KegwQLMFH1ZkMMdcDs8Ne.jpg"]',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Rawat Intensive dan Isolasi',
                'slug' => 'rawat-intensive-dan-isolasi',
                'deskripsi' => 'Layanan perawatan intensif dan ruang isolasi yang dilengkapi dengan peralatan medis mutakhir serta diawasi langsung oleh tenaga medis spesialis intensivis untuk penanganan pasien dengan kondisi kritis secara komprehensif.',
            'konten' => '<p><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Untuk penanganan pasien yang membutuhkan perawatan secara intensive, kami memiliki ruang Intensive Care Unit (ICU), Pediatric Intensive Care Unit (PICU), Neonatal Intensive Care Unit (NICU). Kami juga memiliki Kamar Isolasi, Kamar Bersalin/VK (VIP dan Standar)</span></p>',
                'gambar' => 'fasilitas/wIj2Enuho0z0KUsBANEmO8aX5G2SvOCwbSzL5seV.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 01:59:16',
                'kategori_id' => 2,
                'galeri' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Kamar Operasi',
                'slug' => 'kamar-operasi',
                'deskripsi' => 'Fasilitas kamar operasi modern yang didukung oleh peralatan bedah terkini, teknologi anestesi canggih, serta lingkungan steril berstandar tinggi untuk menjamin keamanan dan keberhasilan tindakan medis bagi pasien.',
            'konten' => '<p style="font-family: Poppins, sans-serif; color: rgb(70, 70, 70) !important; font-size: 17px !important; padding-top: 5px !important;">Terdiri dari empat kamar operasi yang dilengkapi dengan peralatan kedokteran terkini seperti Modular Operation Theatre (MOT), High Efficiency Particulate Air (HEPA) Filter untuk menjaga sirkulasi udara tetap bersih dan sehat serta CSSD untuk menjamin instrument operasi steril saat digunakan.&nbsp;</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Dilengkapi dengan fasilitas ruang tunggu yang nyaman dan pelayanan yang cepat serta didukung dengan tenaga medis yang profesional</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><br></p>',
                'gambar' => 'fasilitas/Pvi0WaXNJE76d0eJcoe8RTe2bJld6Vqq95Pbwn5W.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:23:49',
                'kategori_id' => 3,
                'galeri' => '["fasilitas\\/Pvi0WaXNJE76d0eJcoe8RTe2bJld6Vqq95Pbwn5W.jpg"]',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Radiologi & CT-Scan',
                'slug' => 'radiologi-ct-scan',
                'deskripsi' => 'Layanan penunjang diagnostik modern yang dilengkapi dengan teknologi CT-Scan, MRI, dan X-Ray digital terkini untuk memberikan gambaran medis yang akurat, cepat, dan detail guna mendukung ketepatan diagnosis dokter.',
            'konten' => '<p style="font-family: Poppins, sans-serif; color: rgb(70, 70, 70) !important; font-size: 17px !important; padding-top: 5px !important;">Kami memiliki CT-Scan 128 slices untuk membantu dokter dalam mendeteksi beragam penyakit. Keunggulan CT-Scan 128 slices adalah waktu pemeriksaan lebih cepat dan akurat, hasil gambar lebih detail dan varisi jenis pemeriksaan lebih luas dan rinci.<br></p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Dosis radiasi yang rendah jika dibandingkan dengan CT Scan konvensional yang lain sehingga aman bagi pasien baik dewasa maupun anak-anak.<br>Tersedia juga alat pemeriksaan Rontgen Mobile, Rontgen Konvensional, C-Arm, USG</p>',
                'gambar' => 'fasilitas/4AIhdsZAIUl7s5nRpCnOK6WNiF5rbQ6dzMjShz2e.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:25:00',
                'kategori_id' => 3,
                'galeri' => '["fasilitas\\/4AIhdsZAIUl7s5nRpCnOK6WNiF5rbQ6dzMjShz2e.jpg"]',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Laboratorium',
                'slug' => 'laboratorium',
                'deskripsi' => 'Laboratorium klinik terakreditasi yang didukung teknologi otomatisasi terkini untuk layanan pemeriksaan medis yang akurat, komprehensif, dan hasil yang cepat guna mendukung ketepatan diagnosis Anda.',
            'konten' => '<p><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Dengan pelayanan 24 jam untuk melakukan pemeriksaan elektrolit, hematologi, kimia klinik, imunoserologi, urinalisa, feaces bagi pasien rawat jalan, rawat inap dan gawat darurat untuk mengukur, menetapkan dan menguji jenis penyakit, penyebab penyakit dan melayani medical check up baik perorangan maupun perusahaan.</span></p>',
                'gambar' => 'fasilitas/AWwat4MPoINXkaixQTdAzmFvXP5RSGyUeJ5GDeRc.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:27:29',
                'kategori_id' => 3,
                'galeri' => '["fasilitas\\/AWwat4MPoINXkaixQTdAzmFvXP5RSGyUeJ5GDeRc.jpg"]',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Farmasi',
                'slug' => 'farmasi',
                'deskripsi' => 'Layanan farmasi 24 jam yang menyediakan obat-obatan lengkap, mulai dari obat generik hingga paten, dengan pelayanan yang cepat, akurat, dan konsultasi profesional oleh apoteker berpengalaman untuk menjamin keamanan pengobatan Anda.',
            'konten' => '<p style="text-align: left;"><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Unit Farmasi memberikan layanan 24 jam bagi pasien rawat inap sehingga dapat memudahkan pasien mendapatkan obat-obatan yang dibutuhkan. Unit Farmasi berorientasi kepada keselamatan pasien, dengan prinsip tepat pasien, tepat indikasi, tepat dosis, tepat sediaan dan waspada efek samping.</span></p>',
                'gambar' => 'fasilitas/bTzsDxkDXHJz5oQDKKBuaWp4wNFNKPpvZM1kc51c.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:28:37',
                'kategori_id' => 3,
                'galeri' => '["fasilitas\\/bTzsDxkDXHJz5oQDKKBuaWp4wNFNKPpvZM1kc51c.jpg"]',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Rehabilitasi Medik',
                'slug' => 'rehabilitasi-medik',
                'deskripsi' => 'Layanan rehabilitasi medik komprehensif yang didukung oleh tenaga fisioterapis profesional dan peralatan modern, dirancang untuk membantu pemulihan fungsi fisik serta meningkatkan kualitas hidup pasien secara optimal.',
            'konten' => '<p><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Memberikan pelayanan professional didukung tenaga berkompeten dan modalitas yang modern, peralatan Latihan yang memadai dan program terapi yang komprehensif.</span><br style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;"><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Layanan Fisioterapi meliputi :</span></p><ol><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">MWD ( Microwave Diathermy)</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">TENS ( Transcutaneus Electrical Nerve Stimulation)</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">US (Ultrasound)</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Infrared</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">ES (Electrical Stimulation)</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Breast Care ( Perawatan Payudara)</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Senam Hamil</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Baby Massage</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Pemeriksaan Tumbuh Kembang Anak</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Chest Therapy</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Nebulizer</span></li><li><span style="color: rgb(70, 70, 70); font-family: Poppins, sans-serif; font-size: 17px;">Terapi Latihan aktif dan pasien (exercise)</span></li></ol>',
                'gambar' => 'fasilitas/TBU2gwIkUPgETpBYv1ndaPXLaf6OmLyHdUTzNTOf.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:30:39',
                'kategori_id' => 3,
                'galeri' => '["fasilitas\\/TBU2gwIkUPgETpBYv1ndaPXLaf6OmLyHdUTzNTOf.jpg"]',
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'President Suite',
                'slug' => 'president-suite',
                'deskripsi' => 'Kamar rawat inap dengan standar layanan premium, dirancang khusus untuk kenyamanan maksimal dengan fasilitas setara hotel bintang lima dan privasi tingkat tinggi bagi kenyamanan pemulihan Anda.',
            'konten' => '<p class="MsoNormal" style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Kamar perawatan President Suite menawarkan kenyamanan layanan kesehatan yang eksklusif dengan desain ruangan modern, elegan dan homy dengan luas kamar 75m2 Dilengkapi dengan ruang tunggu keluarga, dua kamar mandi dan dining room yang nyaman beserta dua TV LED berukuran 42 Inch&nbsp; dan akses internet atau Wifi berkecepatan tinggi.<br><br>Tersedia : 1 Kamar<br>Harga : <b>Rp. 3.150.000</b><br></p><p class="MsoNormal" style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;"><b>Fasilitas&nbsp;</b></p><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Bed Pasien 5 Motor (Paramount)</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Sofa Single</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Kulkas</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Meja kerja</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Kitchen set</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">2 TV</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">1 set Meja makan</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Wastafel</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">4 Kursi Kayu + Meja</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Sofa Panjang + Meja</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Kasur Penunggu</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">2 Kamar Mandi</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Rak sepatu</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Dispenser&nbsp;</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Lemari Pakaian</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">2 AC</li><li style="font-family: Poppins, sans-serif; font-size: 17px; line-height: normal; color: rgb(70, 70, 70) !important;">Telepon</li></ul>',
                'gambar' => 'fasilitas/5Hjj9UN2u0NXQIxN54bnRSfLT19kYo8LNXuPEYGF.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:32:31',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/5Hjj9UN2u0NXQIxN54bnRSfLT19kYo8LNXuPEYGF.jpg","fasilitas\\/Lwnk7qwJ4ewWlTSSGJY7WJGKWAC97se7IPOSBfVr.jpg"]',
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'Suite Room',
                'slug' => 'suite-room',
                'deskripsi' => 'Kamar suite mewah dengan ruang tamu terpisah dan fasilitas premium.',
            'konten' => '<p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Nikmati kenyamanan Anda dalam pemulihanan kesehatan di kamar perawatan dengan desain modern, elegan dan homy dengan luas kamar 38m2. Dilengkapi dengan ruang tunggu keluarga dan 1 set meja makan yang nyaman serta dilengkapi dengan TV LED 42 Inch&nbsp; dan akses internet Wifi berkecepatan tinggi.</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Tersedia : 3 Kamar<br>Harga : <b>Rp. 1.500.000</b><br></p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><b>Fasilitas :</b></p><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Bed Pasien 3 Motor (Paramount) </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Kulkas Kitchen Set </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">1 Set Meja Makan Kursi Kayu + Meja </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Sofa Bed </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Sofa Panjang </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Lemari Baju </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">TV </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Side Table</span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Kamar Mandi </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Dispenser </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Ac </span></li><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0); font-family: sans-serif;">Telepon</span></li></ul>',
                'gambar' => 'fasilitas/1WSBrWn7AUDQtnYXLviuvjRIOrhf9k8qgcRmQZHM.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:35:38',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/1WSBrWn7AUDQtnYXLviuvjRIOrhf9k8qgcRmQZHM.jpg","fasilitas\\/oyb8YxdTfccQUWRIFlFYQndbtfNyou9xcDsLuZPb.jpg"]',
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'VIP',
                'slug' => 'vip',
                'deskripsi' => 'Kamar VIP dengan fasilitas lengkap dan nyaman untuk pemulihan optimal.',
            'konten' => '<p style="font-family: Poppins, sans-serif; color: rgb(70, 70, 70) !important; font-size: 17px !important; padding-top: 5px !important;">Kenyamanan rawat inap kami sajikan untuk Anda dalam pemulihanan kesehatan di kamar perawatan dengan desain klasik, elegan dan homy dengan luas kamar 38m2. Dilengkapi dengan ruang tunggu keluarga yang nyaman beserta TV LED 42 Inch dan akses internet Wifi berkecepatan tinggi. Disertai dengan jendela besar sehingga memperlihatkan view atau pemandangan sekitar Rumah Sakit Hamori.</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Tersedia : 3 Kamar<br><p>Harga : <b>Rp. 900.000</b></p><p><b><br></b><br><b>Fasilitas :</b></p></p><p><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Bed Pasien 3 Motor </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Kulkas </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Sofa bed </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Meja Kursi Kayu + Meja </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Sofa Single </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Lemari baju </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Tv </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Side Table </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Dispenser </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Kamar Mandi </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">AC </span></li></ul><ul><li style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><span style="font-size: 14px; color: rgb(0, 0, 0);">Telepon</span></li></ul></p>',
                'gambar' => 'fasilitas/UhoDyHeQzDq6EurzFcVxVXELaMkj263qJOEOqpGS.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:55:08',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/UhoDyHeQzDq6EurzFcVxVXELaMkj263qJOEOqpGS.jpg"]',
            ),
            11 => 
            array (
                'id' => 12,
                'nama' => 'Kelas Utama',
                'slug' => 'kelas-utama',
                'deskripsi' => 'Kamar rawat inap dengan fasilitas yang memadai dan nyaman, dirancang untuk memberikan pengalaman perawatan yang tenang serta didukung oleh layanan medis profesional bagi proses pemulihan Anda.',
            'konten' => '<p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Kenyamanan rawat inap kami sajikan untuk Anda dalam pemulihanan kesehatan di kamar perawatan dengan desain klasik, elegan dan homy dengan luas kamar 38m2 Dilengkapi dengan ruang tunggu keluarga yang nyaman beserta TV LED 42 Inch dan akses internet Wifi berkecepatan tinggi.</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Tersedia : 5 Kamar dengan 2 tempat tidur<br>Harga : <b>Rp. 600.000</b></p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"><br><b>Fasilitas :</b></p><ul><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Bed Pasien 3 Motor</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Sofa Selonjor</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Lemari baju</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">TV LED</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Side Table</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Dispenser</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Kamar Mandi</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">AC</span></li></ul>',
                'gambar' => 'fasilitas/oCCB584VQAPZXGlMbIixs2KLUnPcK14BS1GcTG1m.png',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 02:57:17',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/oCCB584VQAPZXGlMbIixs2KLUnPcK14BS1GcTG1m.png"]',
            ),
            12 => 
            array (
                'id' => 13,
                'nama' => 'Kelas 1',
                'slug' => 'kelas-1',
                'deskripsi' => 'Kamar rawat inap dengan kapasitas 1-2 tempat tidur yang dirancang dengan fasilitas memadai untuk memberikan kenyamanan dan ketenangan bagi proses pemulihan Anda.',
            'konten' => '<p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Kamar perawatan Kelas satu dengan kapasitas 2 pasien dan tetap mengutamakan kenyamanan dengan fasilitas yang lengkap. Dilengkapi dengan kursi dan meja bagi penunggu pasien yang nyaman beserta TV LED 42 Inch dan akses internet Wifi berkecepatan tinggi.&nbsp;</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;">Tersedia :&nbsp; Kamar<br>Harga : Rp. 500.000<br>Fasilitas :</p><p style="font-family: Poppins, sans-serif; font-size: 17px; color: rgb(70, 70, 70) !important;"></p><ul style="padding: 0px 0px 0px 24px; margin: 0px 0px 30px; list-style-type: circle; font-size: 30px; font-family: Poppins, sans-serif;"><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Bed Pasien 3 Crank (Paramount)</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Sofa selonjor</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Lemari Pakaian</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Bed side cabinet</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">TV LED</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Side Table</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">AC</span></li><li style="list-style: none; margin-bottom: 10px; line-height: 18px !important; font-size: 14px !important;"><span style="font-weight: bolder;">Kamar Mandi</span></li></ul>',
                'gambar' => 'fasilitas/AIwQSLikLEIoQAMYYKDbwURDedWVc6AVmjc0NEGF.png',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 03:04:30',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/AIwQSLikLEIoQAMYYKDbwURDedWVc6AVmjc0NEGF.png"]',
            ),
            13 => 
            array (
                'id' => 14,
                'nama' => 'Kelas 2',
                'slug' => 'kelas-2',
                'deskripsi' => 'Kamar rawat inap dengan kapasitas 2-3 tempat tidur yang dirancang untuk memberikan kenyamanan standar bagi proses pemulihan pasien, dengan fasilitas yang tertata rapi dan layanan medis yang sigap.',
            'konten' => '<p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Kamar perawatan Kelas Standar dengan kapasitas 3 pasien dan tetap mengutamakan kenyamanan dengan fasilitas yang lengkap.</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><br></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Tersedia : 8 Kamar dengan 3 tempat tidur</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Harga : Rp. 420.000</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Fasilitas :</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><br></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Bed Pasien 1 Crank (Paramount)</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Kursi Penunggu</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Bed Side Cabinet</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Tv</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Side Table</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">AC</span></font></p><p style="margin: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; font-variant-emoji: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; line-height: normal;"><font face="Helvetica Neue"><span style="font-size: 13px;">Kamar Mandi</span></font></p><ul class="ul1" style="padding: 0px 0px 0px 24px; margin: 0px 0px 30px; list-style-type: circle; font-size: medium; font-family: Poppins, sans-serif;"><li class="li1" style="list-style: none; line-height: normal; margin: 0px; font-size: 13px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-family: &quot;Helvetica Neue&quot;;"><span class="s1" style="font-size: 9px; vertical-align: top; position: relative; left: 0px; color: rgb(70, 70, 70); font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; line-height: normal; font-family: Menlo;"></span></li></ul><ul class="ul1" style="padding: 0px 0px 0px 24px; margin: 0px 0px 30px; list-style-type: circle; font-size: medium; font-family: Poppins, sans-serif;"><li class="li1" style="list-style: none; line-height: normal; margin: 0px; font-size: 13px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-family: &quot;Helvetica Neue&quot;;"><span class="s1" style="font-size: 9px; vertical-align: top; position: relative; left: 0px; color: rgb(70, 70, 70); font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; line-height: normal; font-family: Menlo;"></span></li></ul><ul class="ul1" style="padding: 0px 0px 0px 24px; margin: 0px 0px 30px; list-style-type: circle; font-size: medium; font-family: Poppins, sans-serif;"><li class="li1" style="list-style: none; line-height: normal; margin: 0px; font-size: 13px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-family: &quot;Helvetica Neue&quot;;"><span class="s1" style="font-size: 9px; vertical-align: top; position: relative; left: 0px; color: rgb(70, 70, 70); font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; line-height: normal; font-family: Menlo;"></span></li></ul><ul class="ul1" style="padding: 0px 0px 0px 24px; margin: 0px 0px 30px; list-style-type: circle; font-size: medium; font-family: Poppins, sans-serif;"><li class="li1" style="list-style: none; line-height: normal; margin: 0px; font-size: 13px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-family: &quot;Helvetica Neue&quot;;"><span class="s1" style="font-size: 9px; vertical-align: top; position: relative; left: 0px; color: rgb(70, 70, 70); font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; line-height: normal; font-family: Menlo;"></span></li></ul><ul class="ul1" style="padding: 0px 0px 0px 24px; margin: 0px 0px 30px; list-style-type: circle; font-size: medium; font-family: Poppins, sans-serif;"><li class="li1" style="list-style: none; line-height: normal; margin: 0px; font-size: 13px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-family: &quot;Helvetica Neue&quot;;"><span class="s1" style="font-size: 9px; vertical-align: top; position: relative; left: 0px; color: rgb(70, 70, 70); font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; line-height: normal; font-family: Menlo;"></span></li></ul>',
                'gambar' => 'fasilitas/YwYrQNN7EK8mHpanKtzX5o8vGwKY3iAhtbkDkxYC.png',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 03:06:26',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/YwYrQNN7EK8mHpanKtzX5o8vGwKY3iAhtbkDkxYC.png"]',
            ),
            14 => 
            array (
                'id' => 15,
                'nama' => 'Kelas 3',
                'slug' => 'kelas-3',
                'deskripsi' => 'Kamar rawat inap standar dengan kapasitas 3 tempat tidur yang dirancang untuk memberikan kenyamanan, kebersihan, dan layanan perawatan yang optimal bagi pasien peserta BPJS maupun umum selama proses pemulihan.',
            'konten' => '<p>Kamar perawatan Kelas Standar dengan kapasitas 3 pasien dan tetap mengutamakan kenyamanan dengan fasilitas yang lengkap.</p><p>Tersedia : 5 Kamar dengan 3 tempat tidur</p><p>Harga : <b>Rp. 350.000</b></p><p><b>Fasilitas :</b></p><ul><li>Bed Pasien 1 Crank (Paramount)</li><li>Kursi Penunggu</li><li>Bed Side Cabinet</li><li>Side Table</li><li>AC</li><li>Kamar Mandi</li></ul>',
                'gambar' => 'fasilitas/rJDqDoN6p7X9jhSAZhIFPTHJA3b9dM6CEV3gOS85.png',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 03:07:36',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/rJDqDoN6p7X9jhSAZhIFPTHJA3b9dM6CEV3gOS85.png"]',
            ),
            15 => 
            array (
                'id' => 16,
                'nama' => 'Kamar VK',
                'slug' => 'kamar-vk',
                'deskripsi' => 'Ruang persalinan dengan standar sterilitas tinggi dan dukungan peralatan medis modern, dirancang untuk memberikan kenyamanan serta keamanan maksimal bagi ibu dan bayi selama proses persalinan berlangsung',
            'konten' => '<p><b>Daftar Fasilitas VK</b></p><p>1. VK VIP A</p><ul><li>Bed Pasien Gynecologi 3 Motor (MAK)</li><li>Sofa bed</li><li>Kursi Kayu + Meja</li><li>Tv</li><li>Kitchen Set</li><li>Dispenser</li><li>Kamar Mandi</li><li>Side Table</li><li>AC</li></ul><p><span style="white-space:pre">	</span></p><p>2. VK VIP B</p><ul><li>Bed Pasien Gynecologi 3 Motor (MAK)</li><li>Kursi Kayu + Meja</li><li>Tv&nbsp;</li><li>Side Table</li><li>Dispenser</li><li>Kamar Mandi</li><li>AC</li></ul><p><br></p><p>3. VK STANDAR</p><ul><li>Bed Pasien Gynecologi Standar</li><li>Side Table</li><li>Dispenser</li><li>Kamar Mandi</li><li>AC</li></ul>',
                'gambar' => 'fasilitas/JkzjnfgToUv5CGwCUpkMg7LvkPNQSTzIzeageuiY.jpg',
                'is_active' => 1,
                'created_at' => '2026-06-21 02:57:20',
                'updated_at' => '2026-06-26 03:11:27',
                'kategori_id' => 1,
                'galeri' => '["fasilitas\\/JkzjnfgToUv5CGwCUpkMg7LvkPNQSTzIzeageuiY.jpg","fasilitas\\/vVrikeFwB1IkBL1dN1xIFF51YdbWFDk0XRmPDusv.jpg","fasilitas\\/2JvKDGuPgkFE5c8i2ryb8p5LGJNguOOTEf3RrhMB.jpg"]',
            ),
        ));
        
        
    }
}