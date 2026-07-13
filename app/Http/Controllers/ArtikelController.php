<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::with('kategoris')->where('is_published', true);

        if ($request->filled('kategori')) {
            $query->whereHas('kategoris', fn($q) => $q->where('slug', $request->kategori));
        }

        if ($request->filled('search')) {
            $keyword = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('judul',    'like', $keyword)
                  ->orWhere('konten', 'like', $keyword)
                  ->orWhere('ringkasan', 'like', $keyword)
                  ->orWhereHas('kategoris', fn($k) => $k->where('nama', 'like', $keyword));
            });
        }

        $artikels = $query->orderBy('published_at', 'desc')->paginate(5);
        $kategoris = KategoriArtikel::withCount(['artikelsPivot as artikels_count' => fn($q) => $q->where('is_published', true)])->get();

        return view('pages.artikel-index', compact('artikels', 'kategoris'));
    }

    public function show($kategori, $slug)
    {
        $artikel = Artikel::with(['kategoris', 'dokter'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $artikel->increment('views');

        // Related articles based on any of the categories this article has
        $kategoriIds = $artikel->kategoris->pluck('id')->toArray();
        $artikelTerkait = Artikel::whereHas('kategoris', function($q) use ($kategoriIds) {
                $q->whereIn('kategori_artikels.id', $kategoriIds);
            })
            ->where('id', '!=', $artikel->id)
            ->where('is_published', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $kategoris = KategoriArtikel::withCount(['artikelsPivot as artikels_count' => fn($q) => $q->where('is_published', true)])->get();

        return view('pages.artikel-detail', compact('artikel', 'artikelTerkait', 'kategoris'));
    }

    public function byKategori($kategori)
    {
        $kategoriModel = KategoriArtikel::where('slug', $kategori)->firstOrFail();
        
        $artikels = Artikel::whereHas('kategoris', function($q) use ($kategoriModel) {
                $q->where('kategori_artikels.id', $kategoriModel->id);
            })
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(5);

        $kategoris = KategoriArtikel::withCount(['artikelsPivot as artikels_count' => fn($q) => $q->where('is_published', true)])->get();

        return view('pages.artikel-index', compact('artikels', 'kategoris', 'kategoriModel'));
    }
}