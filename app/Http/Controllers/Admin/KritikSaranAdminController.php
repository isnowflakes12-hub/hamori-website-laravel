<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranAdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = KritikSaran::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $kritikSaran = $query->latest()->paginate(15);

        // Stats
        $stats = [
            'total'    => KritikSaran::count(),
            'pending'  => KritikSaran::pending()->count(),
            'approved' => KritikSaran::approved()->count(),
            'rejected' => KritikSaran::rejected()->count(),
            'featured' => KritikSaran::featured()->count(),
        ];

        return view('admin.kritik-saran.index', compact('kritikSaran', 'status', 'stats'));
    }

    public function show(KritikSaran $kritik_saran)
    {
        if (!$kritik_saran->is_read) {
            $kritik_saran->update(['is_read' => true]);
        }
        return view('admin.kritik-saran.show', compact('kritik_saran'));
    }

    public function updateStatus(Request $request, KritikSaran $kritik_saran)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $data = ['status' => $request->status, 'is_read' => true];
        
        if ($request->status === 'approved' && $kritik_saran->status !== 'approved') {
            $data['approved_at'] = now();
        }

        $kritik_saran->update($data);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function toggleFeatured(KritikSaran $kritik_saran)
    {
        if ($kritik_saran->status !== 'approved') {
            return back()->with('error', 'Hanya kritik/saran yang sudah disetujui yang bisa ditampilkan di beranda.');
        }

        $newStatus = !$kritik_saran->is_featured;

        // Auto-refresh approved_at if making featured to ensure it displays for another 3 months
        $data = ['is_featured' => $newStatus];
        if ($newStatus) {
            $data['approved_at'] = now();
        }

        $kritik_saran->update($data);

        return back()->with('success', 'Status featured berhasil diperbarui.');
    }

    public function destroy(KritikSaran $kritik_saran)
    {
        $kritik_saran->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
