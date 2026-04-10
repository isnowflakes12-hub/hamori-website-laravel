<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterAdminController extends Controller
{
    public function index() { $dokters = Dokter::with('poli')->paginate(15); return view('admin.dokter.index', compact('dokters')); }
    public function create() { $polis = Poli::all(); return view('admin.dokter.form', ['dokter'=>null,'polis'=>$polis]); }
    public function store(Request $request)
    {
        $request->validate(['nama'=>'required|string|max:255','spesialis'=>'required|string|max:255']);
        $data = $request->only('nama','spesialis','poli_id','tentang','pendidikan','no_str','no_sip');
        $data['is_active'] = $request->boolean('is_active', true);
        if ($request->hasFile('foto')) $data['foto'] = $request->file('foto')->store('dokters','public');
        Dokter::create($data);
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }
    public function edit(Dokter $dokter) { $polis = Poli::all(); return view('admin.dokter.form', compact('dokter','polis')); }
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate(['nama'=>'required|string|max:255','spesialis'=>'required|string|max:255']);
        $data = $request->only('nama','spesialis','poli_id','tentang','pendidikan','no_str','no_sip');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('foto')) $data['foto'] = $request->file('foto')->store('dokters','public');
        $dokter->update($data);
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diperbarui.');
    }
    public function destroy(Dokter $dokter) { $dokter->delete(); return back()->with('success', 'Dokter dihapus.'); }
}
