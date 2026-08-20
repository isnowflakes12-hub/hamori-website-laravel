<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KarirKategori;
use App\Models\Karir;
use Illuminate\Http\Request;

class KarirKategoriController extends Controller
{
    public function index()
    {
        $kategoris = KarirKategori::orderBy('urutan')->get();
        return view('admin.karir-kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.karir-kategori.form', ['kategori' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:karir_kategoris,nama',
            'warna' => 'required|string',
            'warna_bg' => 'required|string',
            'icon' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        KarirKategori::create(array_merge($request->all(), ['is_active' => $request->boolean('is_active', true)]));

        return redirect()->route('admin.karir-kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KarirKategori $karir_kategori)
    {
        return view('admin.karir-kategori.form', ['kategori' => $karir_kategori]);
    }

    public function update(Request $request, KarirKategori $karir_kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:karir_kategoris,nama,' . $karir_kategori->id,
            'warna' => 'required|string',
            'warna_bg' => 'required|string',
            'icon' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        $oldNama = $karir_kategori->nama;

        $karir_kategori->update(array_merge($request->all(), ['is_active' => $request->boolean('is_active')]));

        // Jika nama kategori berubah, update juga di tabel karirs
        if ($oldNama !== $karir_kategori->nama) {
            Karir::where('kategori', $oldNama)->update(['kategori' => $karir_kategori->nama]);
        }

        return redirect()->route('admin.karir-kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KarirKategori $karir_kategori)
    {
        if ($karir_kategori->karirs()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh lowongan.');
        }

        $karir_kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function toggleActive(KarirKategori $karir_kategori)
    {
        $karir_kategori->update(['is_active' => !$karir_kategori->is_active]);
        return back()->with('success', 'Status kategori diperbarui.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:karir_kategoris,id',
        ]);

        foreach ($request->ids as $urutan => $id) {
            KarirKategori::where('id', $id)->update(['urutan' => $urutan + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil disimpan.']);
    }
}
