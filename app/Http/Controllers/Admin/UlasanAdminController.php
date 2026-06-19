<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanAdminController extends Controller
{
    /**
     * Daftar semua ulasan + filter
     */
    public function index(Request $request)
    {
        $query = Ulasan::withTrashed()->latest();

        if ($request->filled('status')) {
            match($request->status) {
                'approved' => $query->approved(),
                'pending'  => $query->where('is_approved', false)->whereNull('deleted_at'),
                'featured' => $query->featured()->approved(),
                'trash'    => $query->onlyTrashed(),
                default    => null,
            };
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->q.'%')
                  ->orWhere('ulasan', 'like', '%'.$request->q.'%');
            });
        }

        $ulasans = $query->paginate(20)->withQueryString();

        $stats = [
            'total'    => Ulasan::count(),
            'pending'  => Ulasan::where('is_approved', false)->count(),
            'approved' => Ulasan::approved()->count(),
            'featured' => Ulasan::approved()->featured()->count(),
        ];

        return view('admin.ulasan.index', compact('ulasans', 'stats'));
    }

    /**
     * Approve ulasan
     */
    public function approve(Ulasan $ulasan)
    {
        $ulasan->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Ulasan berhasil disetujui.');
    }

    /**
     * Toggle featured
     */
    public function toggleFeatured(Ulasan $ulasan)
    {
        // Max 6 featured
        if (!$ulasan->is_featured && Ulasan::approved()->featured()->count() >= 6) {
            return back()->with('error', 'Maksimal 6 ulasan unggulan. Hapus salah satu dulu.');
        }
        $ulasan->update(['is_featured' => !$ulasan->is_featured]);
        return back()->with('success', $ulasan->is_featured ? 'Ditambahkan ke unggulan.' : 'Dihapus dari unggulan.');
    }

    public function edit(Ulasan $ulasan)
    {
        return view('admin.ulasan.form', compact('ulasan'));
    }

    public function update(Request $request, Ulasan $ulasan)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'email'       => 'nullable|email|max:150',
            'whatsapp'       => 'nullable|string|max:20',
            'rating'      => 'required|integer|min:1|max:5',
            'kategori'    => 'required|in:umum,rawat_inap,rawat_jalan,igd,mcu',
            'ulasan'      => 'required|string|min:5|max:1000',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'sumber' => 'in:website,whatsapp,manual,google',
        ]);

        $validated['is_approved'] = $request->boolean('is_approved', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['sumber']      = $request->input('sumber', $ulasan->sumber);
        if ($validated['is_approved'] && !$ulasan->approved_at) {
            $validated['approved_at'] = now();
        } elseif (!$validated['is_approved']) {
            $validated['approved_at'] = null;
        }

        $ulasan->update($validated);
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    /**
     * Reject / soft delete
     */
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return back()->with('success', 'Ulasan dihapus.');
    }

    /**
     * Restore dari trash
     */
    public function restore($id)
    {
        Ulasan::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Ulasan dipulihkan.');
    }

    /**
     * Bulk action
     */
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,featured,delete,restore',
            'ids'    => 'required|array',
            'ids.*'  => 'integer',
        ]);

        switch ($request->action) {

            case 'approve':

                Ulasan::whereIn('id', $request->ids)
                    ->update([
                        'is_approved' => true,
                        'approved_at' => now(),
                    ]);

            break;

            case 'featured':

                // Batasi maksimal 6 featured
                $currentFeatured = Ulasan::approved()
                    ->featured()
                    ->count();

                $requested = count($request->ids);

                if (($currentFeatured + $requested) > 6) {
                    return back()->with(
                        'error',
                        'Maksimal 6 ulasan unggulan.'
                    );
                }

                Ulasan::whereIn('id', $request->ids)
                    ->update([
                        'is_featured' => true
                    ]);

            break;

            case 'delete':

                Ulasan::whereIn('id', $request->ids)
                    ->delete();

            break;

            case 'restore':

                Ulasan::onlyTrashed()
                    ->whereIn('id', $request->ids)
                    ->restore();

            break;
        }

        return back()->with(
            'success',
            'Aksi berhasil diterapkan ke ' . count($request->ids) . ' ulasan.'
        );
    }

    /**
     * Tambah ulasan manual oleh admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'email'       => 'nullable|email|max:150',
            'no_hp'       => 'nullable|string|max:20',
            'rating'      => 'required|integer|min:1|max:5',
            'kategori'    => 'required|in:umum,rawat_inap,rawat_jalan,igd,mcu',
            'ulasan'      => 'required|string|min:5|max:1000',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'sumber'      => 'in:website,whatsapp,manual,google',
        ]);

        $validated['is_approved'] = $request->boolean('is_approved', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['sumber']      = $request->input('sumber', 'manual');
        if ($validated['is_approved']) {
            $validated['approved_at'] = now();
        }

        Ulasan::create($validated);
        return back()->with('success', 'Ulasan berhasil ditambahkan.');
    }
    public function form()
    {
        return view('admin.ulasan.form')->with('ulasan', null);
    }
}