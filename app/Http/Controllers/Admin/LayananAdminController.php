<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = LayananUnggulan::query();
        if ($request->filled('search')) $q->where('nama','like','%'.$request->search.'%');
        $layanans = $q->orderBy('urutan')->orderBy('nama')->paginate(15)->withQueryString();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.form', ['layanan' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255|unique:layanan_unggulans,nama',
            'deskripsi' => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = $request->only('nama','deskripsi','deskripsi_singkat','konten','urutan');
        $data['slug']      = Str::slug($request->nama);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('layanan','public');
        }

        LayananUnggulan::create($data);
        return redirect()->route('admin.layanan.index')->with('success','Layanan berhasil ditambahkan.');
    }

    public function edit(LayananUnggulan $layanan)
    {
        return view('admin.layanan.form', compact('layanan'));
    }

    public function update(Request $request, LayananUnggulan $layanan)
    {
        $request->validate([
            'nama'      => 'required|string|max:255|unique:layanan_unggulans,nama,'.$layanan->id,
            'deskripsi' => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = $request->only('nama','deskripsi','deskripsi_singkat','konten','urutan');
        $data['slug']      = Str::slug($request->nama);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('layanan','public');
        }

        $layanan->update($data);
        return redirect()->route('admin.layanan.index')->with('success','Layanan berhasil diperbarui.');
    }

    public function destroy(LayananUnggulan $layanan)
    {
        $layanan->delete();
        return back()->with('success','Layanan berhasil dihapus.');
    }

    public function toggleActive(LayananUnggulan $layanan)
    {
        $layanan->update(['is_active' => !$layanan->is_active]);
        return back()->with('success','Status layanan diperbarui.');
    }
}
