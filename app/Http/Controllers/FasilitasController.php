<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function show($nama)
    {
        $fasilitas = Fasilitas::with('kategori')->where('slug', $nama)->orWhere('nama', $nama)->firstOrFail();
        $groups = \App\Models\KategoriFasilitas::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.fasilitas-detail', compact('fasilitas', 'groups'));
    }

    public function rawatInap()
    {
        $fasilitas = Fasilitas::with('kategori')->whereHas('kategori', function($q) {
            $q->where('nama', 'Rawat Inap');
        })->where('is_active', true)->orderBy('nama')->get();
        return view('pages.fasilitas-rawat-inap', compact('fasilitas'));
    }

    public function index(Request $request)
    {
        $query = Fasilitas::with('kategori')->where('is_active', true);
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhereHas('kategori', function($qKat) use ($search) {
                      $qKat->where('nama', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $fasilitas = $query->orderBy('nama')->paginate(6)->appends($request->all());
        
        return view('pages.fasilitas-index', compact('fasilitas'));
    }

    public function kategori($slug)
    {
        // Temukan kategori berdasarkan slug
        $kategori = \App\Models\KategoriFasilitas::where('slug', $slug)->firstOrFail();
        
        // Ambil semua fasilitas yang ada di kategori tersebut
        $fasilitas = Fasilitas::with('kategori')
            ->where('kategori_id', $kategori->id)
            ->where('is_active', true)
            ->orderBy('nama')
            ->get();
            
        // Jika kategori adalah Rawat Inap, arahkan ke view khusus Rawat Inap
        if (strtolower($kategori->nama) === 'rawat inap') {
            return view('pages.fasilitas-rawat-inap', compact('fasilitas'));
        }
            
        // Jika tidak, kita gunakan view generic untuk kategori
        return view('pages.fasilitas-kategori', compact('fasilitas', 'kategori'));
    }
}
