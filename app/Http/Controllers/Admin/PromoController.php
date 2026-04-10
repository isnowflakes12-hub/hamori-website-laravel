<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $q = Promo::query();
        if ($request->filled('search')) $q->where('judul', 'like', '%'.$request->search.'%');
        if ($request->filled('status')) {
            if ($request->status === 'aktif')    $q->where('is_active', true);
            if ($request->status === 'nonaktif') $q->where('is_active', false);
        }
        $promos = $q->orderBy('is_featured','desc')->orderBy('urutan')->latest()->paginate(12)->withQueryString();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.form', ['promo' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'harga_normal'  => 'nullable|string|max:50',
            'harga_promo'   => 'nullable|string|max:50',
            'diskon'        => 'nullable|string|max:20',
            'berlaku_mulai' => 'nullable|date',
            'berlaku_sampai'=> 'nullable|date|after_or_equal:berlaku_mulai',
        ]);

        $data = $request->only('judul','deskripsi','harga_normal','harga_promo','diskon',
                                'link_wa','link_daftar','berlaku_mulai','berlaku_sampai','urutan');
        $data['is_active']   = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured');

        // Benefits array dari textarea line-by-line
        if ($request->filled('benefit_text')) {
            $data['benefit'] = array_values(array_filter(
                array_map('trim', explode("\n", $request->benefit_text))
            ));
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('promos','public');
        }

        Promo::create($data);
        return redirect()->route('admin.promo.index')->with('success','Promo berhasil ditambahkan.');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promo.form', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'berlaku_sampai'=> 'nullable|date',
        ]);

        $data = $request->only('judul','deskripsi','harga_normal','harga_promo','diskon',
                                'link_wa','link_daftar','berlaku_mulai','berlaku_sampai','urutan');
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('benefit_text')) {
            $data['benefit'] = array_values(array_filter(
                array_map('trim', explode("\n", $request->benefit_text))
            ));
        } else {
            $data['benefit'] = [];
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('promos','public');
        }

        $promo->update($data);
        return redirect()->route('admin.promo.index')->with('success','Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return back()->with('success','Promo berhasil dihapus.');
    }

    public function toggleActive(Promo $promo)
    {
        $promo->update(['is_active' => !$promo->is_active]);
        return back()->with('success','Status promo diperbarui.');
    }

    public function toggleFeatured(Promo $promo)
    {
        $promo->update(['is_featured' => !$promo->is_featured]);
        return back()->with('success','Promo unggulan diperbarui.');
    }
}
