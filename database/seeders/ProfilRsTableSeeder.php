<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfilRsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('profil_rs')->delete();
        
        \DB::table('profil_rs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'deskripsi' => 'Kami adalah Member of "JIH" Group. Berdiri dibawah naungan PT Hamori Medical Center, hadir untuk masyarakat Subang dan sekitarnya dengan memberikan layanan ultimate didukung tenaga profesional yang berkompeten di bidangnya serta peralatan kesehatan terkini. Kami siap menjadi “Mitra Terpercaya Kesehatan Anda”',
                'visi' => 'Menjadi Rumah Sakit Unggul Pilihan Masyarakat dengan Pelayanan Terbaik dan Ramah Lingkungan Menuju Subang Sehat Untuk Semua pada Tahun 2026.',
                'misi' => 'Menyediakan pelayanan kesehatan yang cepat, tanggap, bermutu serta terjangkau bagi masyarakat
Mengembangkan sumber daya manusia yang professional, beretika, dan berintregritas tinggi dengan peningkatan kompetensi yang berkesinambungan
Mengembangkan sarana dan prasarana sesuai perkembangan ilmu pengetahuan dan teknologi kesehatan terkini
Menerapkan sistem manajemen yang efektif, efisien, dan relevan.',
                'kars_logo' => 'profil/9ZsRFl03IIWBU44bsGJZY6vAd3FdOiNdv3kGLJq5.png',
                'gambar_utama' => NULL,
                'total_dokter' => '32+',
                'total_bed' => '100+',
                'pusat_unggulan' => '10+',
                'created_at' => '2026-06-23 14:50:49',
                'updated_at' => '2026-06-25 08:10:16',
            ),
        ));
        
        
    }
}