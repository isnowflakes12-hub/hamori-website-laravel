<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    private array $kategoriList = ['Perawat', 'Penunjang Medis', 'Pelayanan Medis', 'Non Perawat'];

    public function index(Request $request)
    {
        $q = Karir::withCount('lamarans');
        if ($request->filled('search'))   $q->where('posisi', 'like', '%'.$request->search.'%');
        if ($request->filled('kategori')) $q->where('kategori', $request->kategori);
        if ($request->filled('status'))   $q->where('is_active', $request->status === 'aktif');
        $karirs = $q->latest()->paginate(15)->withQueryString();
        return view('admin.karir.index', compact('karirs'), ['kategoriList' => $this->kategoriList]);
    }

    public function create()
    {
        return view('admin.karir.form', ['karir' => null, 'kategoriList' => $this->kategoriList]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'posisi'       => 'required|string|max:255',
            'departemen'   => 'required|string|max:255',
            'kategori'     => 'required|in:' . implode(',', $this->kategoriList),
            'tipe'         => 'required|in:full-time,part-time,kontrak,magang',
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
        return view('admin.karir.form', compact('karir'), ['kategoriList' => $this->kategoriList]);
    }

    public function update(Request $request, Karir $karir)
    {
        $request->validate([
            'posisi'       => 'required|string|max:255',
            'departemen'   => 'required|string|max:255',
            'kategori'     => 'required|in:' . implode(',', $this->kategoriList),
            'tipe'         => 'required|in:full-time,part-time,kontrak,magang',
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
}
