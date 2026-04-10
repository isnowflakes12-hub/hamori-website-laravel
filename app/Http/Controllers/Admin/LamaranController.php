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
        $q = LamaranKarir::with('karir');
        if ($request->filled('karir_id')) $q->where('karir_id', $request->karir_id);
        if ($request->filled('status'))   $q->where('status', $request->status);
        if ($request->filled('search'))   $q->where('nama', 'like', '%'.$request->search.'%');
        $lamarans = $q->latest()->paginate(20)->withQueryString();
        $karirs   = Karir::orderBy('posisi')->get();
        return view('admin.lamaran.index', compact('lamarans', 'karirs'));
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
