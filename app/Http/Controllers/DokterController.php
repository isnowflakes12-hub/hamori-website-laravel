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
        // Ambil poli yang ada di teramedik saja
        $polisQuery = Poli::whereNotNull('teramedik_id')
                          ->where('is_active', true)
                          ->orderBy('nama');

        if ($request->filled('poli')) {
            $polisQuery->where('id', $request->poli);
        }

        $polis = $polisQuery->with(['dokters' => function ($q) use ($request) {
            $q->whereNotNull('teramedik_id')->where('is_active', true);
            
            if ($request->filled('nama')) {
                $q->where('nama', 'ilike', '%' . $request->nama . '%');
            }
            if ($request->filled('hari')) {
                $q->whereHas('jadwal', fn($jq) => $jq->where('hari', $request->hari));
            }
            $q->with('jadwal');
        }])->get();

        // Filter out polis that have no doctors matching the search criteria
        if ($request->filled('nama') || $request->filled('hari')) {
            $polis = $polis->filter(function ($poli) {
                return $poli->dokters->count() > 0;
            });
        }

        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $allPolis = Poli::whereNotNull('teramedik_id')->where('is_active', true)->orderBy('nama')->get();

        return view('pages.jadwal-dokter', compact('polis', 'allPolis', 'haris'));
    }

    public function show($id)
    {
        $dokter = Dokter::with(['jadwal', 'poli'])->findOrFail($id);
        return view('pages.dokter-detail', compact('dokter'));
    }
}
