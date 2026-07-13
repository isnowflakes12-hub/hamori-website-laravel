<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ArtikelsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('artikel_kategori')->delete();
        DB::table('artikels')->delete();

        $now = Carbon::now();

        $kategoriMap = DB::table('kategori_artikels')->pluck('id', 'nama');
        $dokterIds   = DB::table('dokters')->pluck('id')->toArray();

        $artikels = [
            [
                'judul'        => 'Kenali Gejala Diabetes Mellitus Sejak Dini',
                'slug'         => 'kenali-gejala-diabetes-mellitus-sejak-dini',
                'kategori_id'  => $kategoriMap['Kesehatan Umum'] ?? $kategoriMap->first(),
                'dokter_id'    => $dokterIds[0] ?? null,
                'thumbnail'    => null,
                'ringkasan'    => 'Diabetes mellitus adalah penyakit kronis yang ditandai kadar gula darah tinggi. Kenali gejalanya sejak dini untuk mencegah komplikasi.',
                'konten'       => '<p>Diabetes mellitus merupakan salah satu penyakit kronis yang paling umum dijumpai. Penyakit ini terjadi ketika tubuh tidak dapat memproduksi atau menggunakan insulin secara efektif.</p><h3>Gejala Utama</h3><ul><li>Sering buang air kecil</li><li>Mudah haus berlebihan</li><li>Berat badan turun tanpa sebab</li><li>Mudah lelah dan lemas</li><li>Penglihatan kabur</li><li>Luka lambat sembuh</li></ul><p>Jika Anda mengalami gejala-gejala di atas, segera konsultasikan dengan dokter untuk pemeriksaan lebih lanjut.</p>',
                'views'        => 1250,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(30),
            ],
            [
                'judul'        => 'Tips Menjaga Kesehatan Jantung di Usia Produktif',
                'slug'         => 'tips-menjaga-kesehatan-jantung-di-usia-produktif',
                'kategori_id'  => $kategoriMap['Kesehatan Jantung'] ?? $kategoriMap->first(),
                'dokter_id'    => $dokterIds[3] ?? null,
                'thumbnail'    => null,
                'ringkasan'    => 'Penyakit jantung bukan hanya milik lansia. Usia produktif pun rentan terkena serangan jantung jika gaya hidup tidak dijaga.',
                'konten'       => '<p>Penyakit jantung koroner adalah penyebab kematian nomor satu di dunia, termasuk Indonesia. Yang mengejutkan, kasus serangan jantung pada usia muda semakin meningkat.</p><h3>Faktor Risiko</h3><ul><li>Merokok</li><li>Kurang olahraga</li><li>Konsumsi makanan tinggi lemak jenuh</li><li>Stres berkepanjangan</li><li>Hipertensi dan diabetes</li></ul><h3>Pencegahan</h3><p>Olahraga minimal 30 menit per hari, konsumsi makanan bergizi, berhenti merokok, dan rutin cek kesehatan adalah kunci menjaga kesehatan jantung Anda.</p>',
                'views'        => 980,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
            ],
            [
                'judul'        => 'Panduan Imunisasi Anak Sesuai Jadwal Kemenkes',
                'slug'         => 'panduan-imunisasi-anak-sesuai-jadwal-kemenkes',
                'kategori_id'  => $kategoriMap['Kesehatan Anak'] ?? $kategoriMap->first(),
                'dokter_id'    => $dokterIds[2] ?? null,
                'thumbnail'    => null,
                'ringkasan'    => 'Imunisasi adalah salah satu upaya terbaik melindungi anak dari penyakit berbahaya. Simak jadwal lengkap imunisasi wajib dan anjuran.',
                'konten'       => '<p>Imunisasi merupakan investasi kesehatan terbaik untuk buah hati Anda. Vaksinasi dapat mencegah penyakit serius yang berpotensi mengancam jiwa.</p><h3>Jadwal Imunisasi Dasar</h3><ul><li><strong>0 bulan:</strong> Hepatitis B</li><li><strong>1 bulan:</strong> BCG, Polio 1</li><li><strong>2 bulan:</strong> DPT-HB-Hib 1, Polio 2, PCV 1</li><li><strong>3 bulan:</strong> DPT-HB-Hib 2, Polio 3</li><li><strong>4 bulan:</strong> DPT-HB-Hib 3, Polio 4, IPV</li><li><strong>9 bulan:</strong> MR/MMR</li></ul><p>Jangan lewatkan jadwal imunisasi anak Anda. Hubungi poli anak RS Hamori untuk informasi lebih lanjut.</p>',
                'views'        => 2100,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15),
            ],
            [
                'judul'        => 'Mengenal Prosedur Operasi Katarak Modern',
                'slug'         => 'mengenal-prosedur-operasi-katarak-modern',
                'kategori_id'  => $kategoriMap['Kesehatan Mata'] ?? $kategoriMap->first(),
                'dokter_id'    => $dokterIds[6] ?? null,
                'thumbnail'    => null,
                'ringkasan'    => 'Katarak adalah penyebab kebutaan terbanyak di Indonesia. Operasi Phacoemulsification adalah solusi modern yang aman dan efektif.',
                'konten'       => '<p>Katarak terjadi ketika lensa mata menjadi keruh sehingga menghalangi cahaya masuk ke retina. Kondisi ini paling sering dialami oleh lansia, namun bisa terjadi di segala usia.</p><h3>Gejala Katarak</h3><ul><li>Penglihatan kabur seperti berkabut</li><li>Silau saat melihat cahaya terang</li><li>Warna tampak pudar</li><li>Penglihatan ganda</li></ul><h3>Prosedur Phacoemulsification</h3><p>Operasi ini menggunakan gelombang ultrasonik untuk menghancurkan lensa yang keruh, kemudian diganti dengan lensa intraokular buatan. Prosedur berlangsung sekitar 15-30 menit dengan anestesi lokal.</p>',
                'views'        => 750,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'judul'        => 'Perawatan Pasca Persalinan yang Perlu Diketahui Ibu Baru',
                'slug'         => 'perawatan-pasca-persalinan-yang-perlu-diketahui-ibu-baru',
                'kategori_id'  => $kategoriMap['Kesehatan Ibu & Anak'] ?? $kategoriMap->first(),
                'dokter_id'    => $dokterIds[1] ?? null,
                'thumbnail'    => null,
                'ringkasan'    => 'Masa nifas adalah periode penting bagi ibu baru. Ketahui cara merawat diri dan bayi dengan tepat untuk pemulihan optimal.',
                'konten'       => '<p>Periode pasca persalinan atau masa nifas berlangsung selama 6 minggu setelah melahirkan. Pada masa ini, tubuh ibu mengalami banyak perubahan yang membutuhkan perhatian khusus.</p><h3>Tips Perawatan Pasca Persalinan</h3><ul><li>Istirahat cukup dan teratur</li><li>Konsumsi makanan bergizi tinggi protein dan zat besi</li><li>Tetap terhidrasi, terutama saat menyusui</li><li>Jaga kebersihan luka jahitan</li><li>Lakukan senam nifas secara bertahap</li></ul><p>Jangan ragu berkonsultasi dengan dokter kandungan jika mengalami keluhan seperti demam, perdarahan berlebih, atau tanda-tanda baby blues.</p>',
                'views'        => 1850,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'judul'        => 'Pentingnya Medical Check Up Rutin untuk Deteksi Dini Penyakit',
                'slug'         => 'pentingnya-medical-check-up-rutin-untuk-deteksi-dini-penyakit',
                'kategori_id'  => $kategoriMap['Kesehatan Umum'] ?? $kategoriMap->first(),
                'dokter_id'    => $dokterIds[0] ?? null,
                'thumbnail'    => null,
                'ringkasan'    => 'Medical check up rutin dapat mendeteksi penyakit sejak dini sebelum berkembang menjadi kondisi yang serius. Kapan sebaiknya dilakukan?',
                'konten'       => '<p>Medical check up atau pemeriksaan kesehatan menyeluruh adalah cara terbaik untuk memantau kondisi kesehatan secara berkala.</p><h3>Manfaat Medical Check Up</h3><ul><li>Deteksi dini penyakit sebelum bergejala</li><li>Memantau faktor risiko penyakit kronis</li><li>Evaluasi efektivitas pengobatan yang sedang dijalani</li><li>Ketenangan pikiran</li></ul><h3>Frekuensi yang Dianjurkan</h3><p>Usia 20-39 tahun: setiap 3-5 tahun. Usia 40-49 tahun: setiap 1-3 tahun. Usia 50 tahun ke atas: setiap tahun atau sesuai anjuran dokter.</p>',
                'views'        => 3200,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($artikels as $artikel) {
            DB::table('artikels')->insert(array_merge($artikel, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}