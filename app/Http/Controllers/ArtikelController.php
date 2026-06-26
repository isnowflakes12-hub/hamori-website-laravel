<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::with('kategori')->where('is_published', true);

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }

        if ($request->filled('search')) {
            $keyword = '%' . $request->search . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('judul',    'like', $keyword)
                  ->orWhere('konten', 'like', $keyword)
                  ->orWhereHas('kategori', fn($k) => $k->where('nama', 'like', $keyword));
            });
        }

        $artikels = $query->orderBy('published_at', 'desc')->paginate(9);
        $kategoris = KategoriArtikel::withCount(['artikels' => fn($q) => $q->where('is_published', true)])->get();

        return view('pages.artikel-index', compact('artikels', 'kategoris'));
    }

    public function show($kategori, $slug)
    {
        $artikel = Artikel::with(['kategori', 'dokter'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $artikel->increment('views');

        $artikelTerkait = Artikel::where('kategori_id', $artikel->kategori_id)
            ->where('id', '!=', $artikel->id)
            ->where('is_published', true)
            ->take(4)
            ->get();

        return view('pages.artikel-detail', compact('artikel', 'artikelTerkait'));
    }

    public function byKategori($kategori)
    {
        $kategoriModel = KategoriArtikel::where('slug', $kategori)->firstOrFail();
        $artikels = Artikel::where('kategori_id', $kategoriModel->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $kategoris = KategoriArtikel::withCount(['artikels' => fn($q) => $q->where('is_published', true)])->get();

        return view('pages.artikel-index', compact('artikels', 'kategoris', 'kategoriModel'));
    }
}