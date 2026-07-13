<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DokterAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Dokter::with(['poli', 'jadwal'])->whereNotNull('teramedik_id');

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('poli_id')) {
            $query->where('poli_id', $request->poli_id);
        }

        if ($request->filled('status')) {
            $query->where('is_active', (bool) $request->status);
        }

        $dokters    = $query->orderBy('poli_id')->orderBy('nama')->paginate(25);
        $polis      = Poli::whereNotNull('teramedik_id')->orderBy('nama')->get();
        $total      = Dokter::whereNotNull('teramedik_id')->count();
        $totalAktif = Dokter::whereNotNull('teramedik_id')->where('is_active', true)->count();

        return view('admin.dokter.index', compact('dokters', 'polis', 'total', 'totalAktif'));
    }

    public function create()
    {
        $polis = Poli::orderBy('nama')->get();
        return view('admin.dokter.form', ['dokter' => null, 'polis' => $polis]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'foto'  => 'nullable|image|max:4096',
        ]);

        $data = $request->only('nama', 'gelar_depan', 'gelar_belakang', 'poli_id', 'bio', 'pendidikan');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->storeCompressed('dokters', 'public');
        }

        Dokter::create($data);
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        $dokter->load('jadwal');
        $polis = Poli::orderBy('nama')->get();
        return view('admin.dokter.form', compact('dokter', 'polis'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'foto'  => 'nullable|image|max:4096',
        ]);

        $data = $request->only('nama', 'gelar_depan', 'gelar_belakang', 'poli_id', 'bio', 'pendidikan');
        $data['is_active'] = $request->boolean('is_active');

        // Hapus foto
        if ($request->boolean('hapus_foto') && $dokter->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($dokter->foto);
            $data['foto'] = null;
        }

        // Upload foto baru
        if ($request->hasFile('foto')) {
            if ($dokter->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($dokter->foto);
            }
            $data['foto'] = $request->file('foto')->storeCompressed('dokters', 'public');
        }

        $dokter->update($data);
        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        if ($dokter->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($dokter->foto);
        }
        $dokter->delete();
        return back()->with('success', 'Dokter berhasil dihapus.');
    }

    public function toggle(Dokter $dokter)
    {
        $dokter->update(['is_active' => !$dokter->is_active]);
        $status = $dokter->is_active ? 'ditampilkan' : 'disembunyikan';
        return back()->with('success', "Dokter \"{$dokter->nama_lengkap}\" berhasil {$status}.");
    }

    public function sync()
    {
        try {
            Artisan::call('teramedik:sync');
            $output = Artisan::output();

            if (str_contains($output, 'Terjadi Kesalahan')) {
                return back()->with('error', $output);
            }

            return back()->with('success', 'Sinkronisasi berhasil: ' . trim($output));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal sinkronisasi: ' . $e->getMessage());
        }
    }
}
