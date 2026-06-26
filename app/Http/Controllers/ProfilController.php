<?php

namespace App\Http\Controllers;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = \App\Models\ProfilRs::first() ?? new \App\Models\ProfilRs([
            'deskripsi' => 'Kami adalah Member of "JIH" Group...',
            'visi' => 'Menjadi Rumah Sakit Unggul...',
            'misi' => "Menyediakan pelayanan kesehatan...\nMengembangkan sumber daya manusia...",
            'total_dokter' => '32+', 'total_bed' => '100+', 'pusat_unggulan' => '10+'
        ]);
        $milestones = \App\Models\Milestone::orderBy('tahun', 'asc')->get();
        return view('pages.profil', compact('profil', 'milestones'));
    }
}
