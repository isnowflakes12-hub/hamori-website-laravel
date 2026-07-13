<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DoktersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dokters')->delete();

        $now = Carbon::now();

        // Ambil poli_id berdasarkan nama (sudah di-seed oleh PolisTableSeeder)
        $poliMap = DB::table('polis')->pluck('id', 'nama');

        $dokters = [
            [
                'nama'          => 'Ahmad Fauzi',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.PD',
                'foto'          => null,
                'poli_id'       => $poliMap['Penyakit Dalam'] ?? null,
                'spesialisasi'  => 'Penyakit Dalam',
                'pendidikan'    => "S1 Kedokteran Universitas Indonesia\nSpesialis Penyakit Dalam FKUI",
                'bio'           => 'Dokter spesialis penyakit dalam dengan pengalaman lebih dari 15 tahun di bidang penanganan diabetes, hipertensi, dan penyakit metabolik.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Siti Rahayu',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.OG',
                'foto'          => null,
                'poli_id'       => $poliMap['Kandungan & Kebidanan'] ?? null,
                'spesialisasi'  => 'Obstetri & Ginekologi',
                'pendidikan'    => "S1 Kedokteran Universitas Gadjah Mada\nSpesialis Obstetri & Ginekologi UGM",
                'bio'           => 'Spesialis kandungan berpengalaman dalam penanganan kehamilan risiko tinggi, persalinan normal, dan caesar.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Budi Santoso',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.A',
                'foto'          => null,
                'poli_id'       => $poliMap['Anak'] ?? null,
                'spesialisasi'  => 'Anak',
                'pendidikan'    => "S1 Kedokteran Universitas Airlangga\nSpesialis Anak UNAIR",
                'bio'           => 'Dokter spesialis anak yang berdedikasi dalam penanganan tumbuh kembang, gizi, dan penyakit infeksi pada anak.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Dewi Kusumawati',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.JP',
                'foto'          => null,
                'poli_id'       => $poliMap['Jantung'] ?? null,
                'spesialisasi'  => 'Jantung & Pembuluh Darah',
                'pendidikan'    => "S1 Kedokteran Universitas Diponegoro\nSpesialis Jantung & Pembuluh Darah UNDIP",
                'bio'           => 'Spesialis jantung dengan keahlian dalam diagnosis dan tatalaksana penyakit jantung koroner, gagal jantung, dan aritmia.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Eko Prasetyo',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.B',
                'foto'          => null,
                'poli_id'       => $poliMap['Bedah Umum'] ?? $poliMap['Bedah'] ?? null,
                'spesialisasi'  => 'Bedah Umum',
                'pendidikan'    => "S1 Kedokteran Universitas Brawijaya\nSpesialis Bedah Umum UB",
                'bio'           => 'Dokter bedah umum berpengalaman dalam operasi laparoskopi, appendektomi, hernioplasti, dan bedah digestif.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Fitriani Nurdiani',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.S',
                'foto'          => null,
                'poli_id'       => $poliMap['Saraf'] ?? null,
                'spesialisasi'  => 'Neurologi (Saraf)',
                'pendidikan'    => "S1 Kedokteran Universitas Hasanuddin\nSpesialis Neurologi UNHAS",
                'bio'           => 'Spesialis saraf dengan fokus pada penanganan stroke, epilepsi, migrain, dan penyakit neurodegeneratif.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Gunawan Hidayat',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.M',
                'foto'          => null,
                'poli_id'       => $poliMap['Mata'] ?? null,
                'spesialisasi'  => 'Mata',
                'pendidikan'    => "S1 Kedokteran Universitas Padjadjaran\nSpesialis Mata UNPAD",
                'bio'           => 'Spesialis mata berpengalaman dalam penanganan katarak, glaukoma, kelainan refraksi, dan penyakit retina.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Hendra Wijaya',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.THT-KL',
                'foto'          => null,
                'poli_id'       => $poliMap['THT'] ?? $poliMap['THT-KL'] ?? null,
                'spesialisasi'  => 'THT-KL',
                'pendidikan'    => "S1 Kedokteran Universitas Sebelas Maret\nSpesialis THT-KL UNS",
                'bio'           => 'Dokter spesialis THT-KL dengan keahlian dalam penanganan sinusitis, tonsilitis, gangguan pendengaran, dan tumor kepala-leher.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Indah Permatasari',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.KK',
                'foto'          => null,
                'poli_id'       => $poliMap['Kulit & Kelamin'] ?? $poliMap['Kulit'] ?? null,
                'spesialisasi'  => 'Kulit & Kelamin',
                'pendidikan'    => "S1 Kedokteran Universitas Sam Ratulangi\nSpesialis Dermatologi & Venerologi UNSRAT",
                'bio'           => 'Spesialis kulit dan kelamin dengan pengalaman dalam penanganan dermatitis, psoriasis, acne, dan penyakit kelamin.',
                'is_active'     => true,
            ],
            [
                'nama'          => 'Joko Supriyanto',
                'gelar_depan'   => 'dr.',
                'gelar_belakang'=> 'Sp.OT',
                'foto'          => null,
                'poli_id'       => $poliMap['Ortopedi'] ?? null,
                'spesialisasi'  => 'Ortopedi & Traumatologi',
                'pendidikan'    => "S1 Kedokteran Universitas Indonesia\nSpesialis Ortopedi & Traumatologi FKUI",
                'bio'           => 'Dokter spesialis ortopedi berpengalaman dalam penanganan fraktur, penggantian sendi, skoliosis, dan cedera olahraga.',
                'is_active'     => true,
            ],
        ];

        foreach ($dokters as $dokter) {
            DB::table('dokters')->insert(array_merge($dokter, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}