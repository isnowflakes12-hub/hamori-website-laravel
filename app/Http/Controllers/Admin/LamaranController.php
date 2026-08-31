<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LamaranKarir;
use App\Models\Karir;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    public function index(Request $request)
    {
        $karirs = Karir::orderBy('posisi')->get();

        // Level 3: Tampilkan daftar pelamar (Jika ada karir_id, status, atau search)
        if ($request->filled('karir_id') || $request->filled('search') || $request->filled('status')) {
            $q = LamaranKarir::with('karir');
            if ($request->filled('karir_id')) $q->where('karir_id', $request->karir_id);
            if ($request->filled('status'))   $q->where('status', $request->status);
            if ($request->filled('search'))   $q->where('nama', 'like', '%'.$request->search.'%');
            $lamarans = $q->latest()->paginate(20)->withQueryString();
            
            return view('admin.lamaran.index', compact('lamarans', 'karirs'));
        }

        // Level 2: Tampilkan Posisi berdasarkan Kategori
        if ($request->filled('kategori')) {
            $karirList = Karir::withCount([
                                'lamarans', 
                                'lamarans as pelamar_baru' => function($q) {
                                    $q->where('status', 'pending');
                                }
                              ])
                              ->where('kategori', $request->kategori)
                              ->orderBy('posisi')
                              ->paginate(20)->withQueryString();
            $kategori_title = $request->kategori;
            $kategoriMeta = \App\Models\KarirKategori::get()->keyBy('nama');
            return view('admin.lamaran.index', compact('karirList', 'karirs', 'kategori_title', 'kategoriMeta'));
        }

        // Level 1: Tampilkan Kategori Utama
        $kategoriList = Karir::select('kategori')
            ->selectRaw('COUNT(id) as total_posisi')
            ->selectRaw('SUM((SELECT COUNT(*) FROM lamaran_karirs WHERE lamaran_karirs.karir_id = karirs.id)) as total_pelamar')
            ->selectRaw('SUM((SELECT COUNT(*) FROM lamaran_karirs WHERE lamaran_karirs.karir_id = karirs.id AND lamaran_karirs.status = \'pending\')) as pelamar_baru')
            ->groupBy('kategori')
            ->get();

        $kategoriMeta = \App\Models\KarirKategori::whereIn('nama', $kategoriList->pluck('kategori'))->get()->keyBy('nama');

        return view('admin.lamaran.index', compact('kategoriList', 'karirs', 'kategoriMeta'));
    }

    public function show(LamaranKarir $lamaran)
    {
        $lamaran->load('karir');
        return view('admin.lamaran.show', compact('lamaran'));
    }

    public function updateStatus(Request $request, LamaranKarir $lamaran)
    {
        $request->validate(['status' => 'required|in:pending,review,shortlist,interview,diterima,ditolak', 'catatan' => 'nullable|string']);
        $lamaran->update(['status' => $request->status, 'catatan' => $request->catatan]);
        return back()->with('success', 'Status lamaran diperbarui.');
    }

    public function destroy(LamaranKarir $lamaran)
    {
        $lamaran->delete();
        return back()->with('success', 'Lamaran dihapus.');
    }
}
