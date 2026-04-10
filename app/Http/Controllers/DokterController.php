<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\JadwalDokter;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $query = Dokter::with(['jadwal', 'poli'])->where('is_active', true);

        if ($request->filled('poli')) {
            $query->whereHas('poli', fn($q) => $q->where('id', $request->poli));
        }

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('hari')) {
            $query->whereHas('jadwal', fn($q) => $q->where('hari', $request->hari));
        }

        $dokters = $query->paginate(12);
        $polis = Poli::where('is_active', true)->orderBy('nama')->get();
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('pages.jadwal-dokter', compact('dokters', 'polis', 'haris'));
    }

    public function show($id)
    {
        $dokter = Dokter::with(['jadwal', 'poli'])->findOrFail($id);
        return view('pages.dokter-detail', compact('dokter'));
    }
}
