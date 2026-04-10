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
        $q = Artikel::with('kategori')->latest();
        if ($request->filled('search'))   $q->where('judul','like','%'.$request->search.'%');
        if ($request->filled('kategori')) $q->where('kategori_id',$request->kategori);
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
            'judul'      => 'required|string|max:255',
            'konten'     => 'required|string',
            'kategori_id'=> 'exists:kategori_artikels,id',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only('judul','konten','kategori_id','ringkasan');
        $data['slug']         = Str::slug($request->judul).'-'.time();
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikels','public');
        }

        Artikel::create($data);
        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.artikel.form', compact('artikel','kategoris'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'konten'     => 'required|string',
            'kategori_id'=> 'required|exists:kategori_artikels,id',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->only('judul','konten','kategori_id','ringkasan');
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && !$artikel->published_at) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikels','public');
        }

        $artikel->update($data);
        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
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
