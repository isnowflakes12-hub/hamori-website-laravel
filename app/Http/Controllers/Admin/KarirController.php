<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use Illuminate\Http\Request;

use App\Models\KarirKategori;
use App\Models\KarirTipe;

class KarirController extends Controller
{

    public function index(Request $request)
    {
        $q = Karir::withCount('lamarans');
        if ($request->filled('search'))   $q->where('posisi', 'like', '%'.$request->search.'%');
        if ($request->filled('kategori')) $q->where('kategori', $request->kategori);
        if ($request->filled('status'))   $q->where('is_active', $request->status === 'aktif');
        $karirs = $q->latest()->paginate(15)->withQueryString();
        
        $kategoriList = KarirKategori::where('is_active', true)->orderBy('urutan')->pluck('nama')->toArray();
        return view('admin.karir.index', compact('karirs', 'kategoriList'));
    }

    public function create()
    {
        $kategoris = KarirKategori::where('is_active', true)->orderBy('urutan')->get();
        $tipes = KarirTipe::where('is_active', true)->orderBy('nama')->get();
        return view('admin.karir.form', ['karir' => null, 'kategoris' => $kategoris, 'tipes' => $tipes]);
    }

    public function store(Request $request)
    {
        $validKategoris = KarirKategori::pluck('nama')->toArray();
        $validTipes = KarirTipe::pluck('slug')->toArray();

        $request->validate([
            'posisi'       => 'required|string|max:255',
            'departemen'   => 'required|string|max:255',
            'kategori'     => 'required|in:' . implode(',', $validKategoris),
            'tipe'         => 'required|in:' . implode(',', $validTipes),
            'deskripsi'    => 'required|string',
            'persyaratan'  => 'required|string',
            'kuota'        => 'required|integer|min:1',
            'batas_lamaran'=> 'nullable|date|after:today',
        ]);

        Karir::create(array_merge(
            $request->only('posisi','departemen','kategori','tipe','deskripsi','persyaratan','lokasi','kuota','batas_lamaran'),
            ['is_active' => $request->boolean('is_active', true)]
        ));

        return redirect()->route('admin.karir.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Karir $karir)
    {
        $kategoris = KarirKategori::where('is_active', true)->orderBy('urutan')->get();
        $tipes = KarirTipe::where('is_active', true)->orderBy('nama')->get();
        return view('admin.karir.form', compact('karir', 'kategoris', 'tipes'));
    }

    public function update(Request $request, Karir $karir)
    {
        $validKategoris = KarirKategori::pluck('nama')->toArray();
        $validTipes = KarirTipe::pluck('slug')->toArray();

        $request->validate([
            'posisi'       => 'required|string|max:255',
            'departemen'   => 'required|string|max:255',
            'kategori'     => 'required|in:' . implode(',', $validKategoris),
            'tipe'         => 'required|in:' . implode(',', $validTipes),
            'deskripsi'    => 'required|string',
            'persyaratan'  => 'required|string',
            'kuota'        => 'required|integer|min:1',
            'batas_lamaran'=> 'nullable|date',
        ]);

        $karir->update(array_merge(
            $request->only('posisi','departemen','kategori','tipe','deskripsi','persyaratan','lokasi','kuota','batas_lamaran'),
            ['is_active' => $request->boolean('is_active')]
        ));

        return redirect()->route('admin.karir.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Karir $karir)
    {
        $karir->delete();
        return back()->with('success', 'Lowongan berhasil dihapus.');
    }

    public function toggleActive(Karir $karir)
    {
        $karir->update(['is_active' => !$karir->is_active]);
        return back()->with('success', 'Status lowongan diperbarui.');
    }

    public function bulkToggle(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:karirs,id',
            'action' => 'required|in:aktif,nonaktif'
        ]);

        $isActive = $request->action === 'aktif';
        
        Karir::whereIn('id', $request->ids)->update(['is_active' => $isActive]);

        return back()->with('success', count($request->ids) . ' lowongan berhasil di' . $request->action . 'kan.');
    }
}
