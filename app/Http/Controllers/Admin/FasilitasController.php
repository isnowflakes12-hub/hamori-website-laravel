<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with('kategori')->orderBy('kategori_id')->orderBy('nama')->paginate(15);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        $kategori = \App\Models\KategoriFasilitas::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.fasilitas.form', ['fasilitas' => null, 'kategori' => $kategori]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_fasilitas,id',
            'deskripsi' => 'nullable|string',
            'konten'    => 'nullable|string',
            'gambar.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only('nama', 'kategori_id', 'deskripsi', 'konten');
        
        // Generate a unique slug
        $slug = Str::slug($request->nama);
        $count = Fasilitas::where('slug', 'LIKE', "{$slug}%")->count();
        $data['slug'] = $count ? "{$slug}-{$count}" : $slug;
        
        $data['is_active'] = $request->boolean('is_active', true);
        $data['tampil_di_navbar'] = $request->boolean('tampil_di_navbar', false);

        if ($request->hasFile('gambar')) {
            $galeri = [];
            foreach ($request->file('gambar') as $file) {
                $path = $file->storeCompressed('fasilitas', 'public');
                $galeri[] = $path;
            }
            $data['gambar'] = $galeri[0] ?? null;
            $data['galeri'] = $galeri;
        }

        Fasilitas::create($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $kategori = \App\Models\KategoriFasilitas::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.fasilitas.form', compact('fasilitas', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_fasilitas,id',
            'deskripsi' => 'nullable|string',
            'konten'    => 'nullable|string',
            'gambar.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only('nama', 'kategori_id', 'deskripsi', 'konten');
        
        if ($request->nama !== $fasilitas->nama) {
            $slug = Str::slug($request->nama);
            $count = Fasilitas::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $fasilitas->id)->count();
            $data['slug'] = $count ? "{$slug}-{$count}" : $slug;
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['tampil_di_navbar'] = $request->boolean('tampil_di_navbar');

        if ($request->hasFile('gambar')) {
            $galeri = [];
            foreach ($request->file('gambar') as $file) {
                $path = $file->storeCompressed('fasilitas', 'public');
                $galeri[] = $path;
            }
            $data['gambar'] = $galeri[0] ?? null;
            $data['galeri'] = $galeri;
        }

        $fasilitas->update($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function toggleActive($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update(['is_active' => !$fasilitas->is_active]);
        return back()->with('success', 'Status Fasilitas diperbarui.');
    }

    public function bulkNavbar(Request $request)
    {
        $request->validate([
            'action' => 'required|in:tampilkan,sembunyikan',
            'ids'    => 'required|array|min:1',
            'ids.*'  => 'integer|exists:fasilitass,id',
        ]);

        $value = $request->action === 'tampilkan';
        $count = Fasilitas::whereIn('id', $request->ids)->update(['tampil_di_navbar' => $value]);

        $label = $value ? 'ditampilkan di navbar' : 'disembunyikan dari navbar';
        return back()->with('success', "{$count} fasilitas berhasil {$label}.");
    }
}
