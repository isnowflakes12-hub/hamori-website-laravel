<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriArtikelController extends Controller
{
    public function index()
    {
        $kategoris = KategoriArtikel::withCount('artikels')->orderBy('urutan')->get();
        return view('admin.kategori-artikel.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori-artikel.form', ['kategori' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100|unique:kategori_artikels,nama',
            'warna' => 'nullable|string|max:20',
        ]);

        KategoriArtikel::create([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'warna'     => $request->warna ?? '#0055a5',
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.kategori-artikel.index')
                         ->with('success','Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriArtikel $kategoriArtikel)
    {
        return view('admin.kategori-artikel.form', ['kategori' => $kategoriArtikel]);
    }

    public function update(Request $request, KategoriArtikel $kategoriArtikel)
    {
        $request->validate([
            'nama'  => 'required|string|max:100|unique:kategori_artikels,nama,'.$kategoriArtikel->id,
            'warna' => 'nullable|string|max:20',
        ]);

        $kategoriArtikel->update([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'warna'     => $request->warna ?? '#0055a5',
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.kategori-artikel.index')
                         ->with('success','Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriArtikel $kategoriArtikel)
    {
        if ($kategoriArtikel->artikels()->count() > 0) {
            return back()->with('error','Tidak dapat menghapus kategori yang masih memiliki artikel.');
        }
        $kategoriArtikel->delete();
        return back()->with('success','Kategori berhasil dihapus.');
    }
}
