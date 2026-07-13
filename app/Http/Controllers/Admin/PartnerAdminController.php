<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'ilike', "%{$search}%")
                  ->orWhere('kategori', 'ilike', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $partners = $query->orderBy('nama')->paginate(12)->withQueryString();

        $stats = [
            'total'  => Partner::count(),
            'active' => Partner::where('is_active', true)->count(),
            'hidden' => Partner::where('is_active', false)->count(),
        ];

        return view('admin.partner.index', compact('partners', 'stats'));
    }

    public function create()
    {
        return view('admin.partner.form', ['partner' => new Partner()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'nullable|string|max:255',
            'website'   => 'nullable|url|max:255',
            'logo'      => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['nama', 'kategori', 'website']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->storeCompressed('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('admin.partner.index')->with('success', 'Partner/Mitra berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partner.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'nullable|string|max:255',
            'website'   => 'nullable|url|max:255',
            'logo'      => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['nama', 'kategori', 'website']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->boolean('hapus_logo') && $partner->logo) {
            Storage::disk('public')->delete($partner->logo);
            $data['logo'] = null;
        }

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->storeCompressed('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partner.index')->with('success', 'Data Partner/Mitra berhasil diperbarui.');
    }

    public function toggle(Partner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);
        return back()->with('success', 'Status Partner berhasil diubah.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();

        return redirect()->route('admin.partner.index')->with('success', 'Partner/Mitra berhasil dihapus.');
    }
}
