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

        public function export(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = KritikSaran::query();
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        $data = $query->latest()->get();

        $filename = "Kritik_Saran_RSHamori_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID', 'Tanggal', 'Nama', 'Email', 'Telepon', 'Responden', 'Poliklinik', 'Kategori', 'Pesan',
            'Kepuasan RS', 'Alur Pelayanan', 'Fasilitas', 'Kesesuaian Biaya',
            'Pelayanan Dokter', 'Pelayanan Perawat',
            'Laboratorium', 'Radiologi', 'Fisioterapi', 'Farmasi',
            'Status'
        ];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns, ';'); // Use semicolon for Excel ID locale
            
            foreach ($data as $row) {
                // Clean up newlines in message
                $pesan = str_replace(["\r\n", "\r", "\n"], ' ', $row->pesan);
                
                fputcsv($file, [
                    $row->id,
                    $row->created_at->format('Y-m-d H:i'),
                    $row->nama,
                    $row->email,
                    $row->telepon,
                    ucfirst($row->responden ?? ''),
                    $row->nama_poliklinik,
                    ucfirst($row->kategori ?? ''),
                    $pesan,
                    $row->rating_kepuasan_rs,
                    $row->rating_alur_pelayanan,
                    $row->rating_fasilitas,
                    $row->rating_kesesuaian_biaya,
                    $row->rating_pelayanan_dokter,
                    $row->rating_pelayanan_perawat,
                    $row->rating_laboratorium,
                    $row->rating_radiologi,
                    $row->rating_fisioterapi,
                    $row->rating_farmasi,
                    strtoupper($row->status)
                ], ';'); // Use semicolon
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(KritikSaran $kritik_saran)
    {
        $kritik_saran->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}


