<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KarirTipe;
use App\Models\Karir;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KarirTipeController extends Controller
{
    public function index()
    {
        $tipes = KarirTipe::orderBy('nama')->get();
        return view('admin.karir-tipe.index', compact('tipes'));
    }

    public function create()
    {
        return view('admin.karir-tipe.form', ['tipe' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'warna' => 'required|string',
        ]);

        $slug = Str::slug($request->nama);
        
        // Cek jika slug sudah ada
        if (KarirTipe::where('slug', $slug)->exists()) {
            return back()->withInput()->withErrors(['nama' => 'Nama/slug sudah digunakan.']);
        }

        KarirTipe::create([
            'nama' => $request->nama,
            'slug' => $slug,
            'warna' => $request->warna,
            'is_active' => $request->boolean('is_active', true)
        ]);

        return redirect()->route('admin.karir-tipe.index')->with('success', 'Tipe Pekerjaan berhasil ditambahkan.');
    }

    public function edit(KarirTipe $karir_tipe)
    {
        return view('admin.karir-tipe.form', ['tipe' => $karir_tipe]);
    }

    public function update(Request $request, KarirTipe $karir_tipe)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'warna' => 'required|string',
        ]);

        $slug = Str::slug($request->nama);
        
        // Cek jika slug sudah ada dan bukan miliknya
        if (KarirTipe::where('slug', $slug)->where('id', '!=', $karir_tipe->id)->exists()) {
            return back()->withInput()->withErrors(['nama' => 'Nama/slug sudah digunakan.']);
        }

        $oldSlug = $karir_tipe->slug;

        $karir_tipe->update([
            'nama' => $request->nama,
            'slug' => $slug,
            'warna' => $request->warna,
            'is_active' => $request->boolean('is_active')
        ]);

        // Jika slug tipe berubah, update juga di tabel karirs
        if ($oldSlug !== $slug) {
            Karir::where('tipe', $oldSlug)->update(['tipe' => $slug]);
        }

        return redirect()->route('admin.karir-tipe.index')->with('success', 'Tipe Pekerjaan berhasil diperbarui.');
    }

    public function destroy(KarirTipe $karir_tipe)
    {
        if ($karir_tipe->karirs()->exists()) {
            return back()->with('error', 'Tipe Pekerjaan tidak bisa dihapus karena masih digunakan oleh lowongan.');
        }

        $karir_tipe->delete();
        return back()->with('success', 'Tipe Pekerjaan berhasil dihapus.');
    }

    public function toggleActive(KarirTipe $karir_tipe)
    {
        $karir_tipe->update(['is_active' => !$karir_tipe->is_active]);
        return back()->with('success', 'Status tipe pekerjaan diperbarui.');
    }
}
