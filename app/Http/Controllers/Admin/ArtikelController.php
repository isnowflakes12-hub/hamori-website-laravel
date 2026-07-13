<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $q = Artikel::with('kategoris')->latest();
        if ($request->filled('search'))   $q->where('judul','like','%'.$request->search.'%');
        if ($request->filled('kategori')) $q->whereHas('kategoris', function($query) use ($request) {
            $query->where('kategori_artikels.id', $request->kategori);
        });
        if ($request->filled('status')) {
            $q->where('is_published', $request->status === 'published');
        }
        $artikels  = $q->paginate(15)->withQueryString();
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.artikel.index', compact('artikels','kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.artikel.form', ['artikel' => null, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'konten'        => 'required|string',
            'kategori_ids'  => 'required|array|min:1',
            'kategori_ids.*'=> 'exists:kategori_artikels,id',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'galeri.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only('judul','konten','ringkasan');
        $data['slug']         = Str::slug($request->judul).'-'.time();
        // Auto publish - tidak ada draft
        $data['is_published'] = true;
        $data['published_at'] = now();
        // Set kategori_id utama (first selection) untuk URL & backward compat
        $data['kategori_id']  = $request->kategori_ids[0];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->storeCompressed('artikels','public');
        }

        $galeri = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->storeCompressed('artikels/galeri','public');
            }
        }
        $data['galeri'] = count($galeri) > 0 ? $galeri : null;

        $artikel = Artikel::create($data);

        // Sync many-to-many kategoris
        $artikel->kategoris()->sync($request->kategori_ids);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan dan dipublikasikan.');
    }

    public function edit(Artikel $artikel)
    {
        $artikel->load('kategoris');
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.artikel.form', compact('artikel','kategoris'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'konten'        => 'required|string',
            'kategori_ids'  => 'required|array|min:1',
            'kategori_ids.*'=> 'exists:kategori_artikels,id',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'galeri.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only('judul','konten','ringkasan');
        // Auto-publish on update juga
        $data['is_published'] = true;
        if (!$artikel->published_at) {
            $data['published_at'] = now();
        }
        // Update kategori_id utama
        $data['kategori_id'] = $request->kategori_ids[0];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->storeCompressed('artikels','public');
        }

        $galeri_lama = is_array($artikel->galeri) ? $artikel->galeri : [];
        if ($request->delete_galeri) {
            $galeri_lama = array_diff($galeri_lama, $request->delete_galeri);
        }

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri_lama[] = $file->storeCompressed('artikels/galeri','public');
            }
        }
        $data['galeri'] = count($galeri_lama) > 0 ? array_values($galeri_lama) : null;

        $artikel->update($data);

        // Sync many-to-many kategoris
        $artikel->kategoris()->sync($request->kategori_ids);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->kategoris()->detach();
        $artikel->delete();
        return back()->with('success','Artikel berhasil dihapus.');
    }

    public function togglePublish(Artikel $artikel)
    {
        $artikel->update([
            'is_published' => !$artikel->is_published,
            'published_at' => !$artikel->is_published ? now() : null,
        ]);
        return back()->with('success','Status publikasi diperbarui.');
    }
}
