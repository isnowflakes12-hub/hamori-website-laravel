<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->paginate(15);
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.form', ['banner' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'nullable|string|max:255',
            'gambar'        => 'required|mimes:jpg,jpeg,png,webp,mp4,webm|max:51200',
            'urutan'        => 'nullable|integer|min:0',
        ]);

        $data = $request->only('judul', 'urutan');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['gambar']    = $request->file('gambar')->storeCompressed('banners', 'public');

        Banner::create($data);
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'judul'         => 'nullable|string|max:255',
            'gambar'        => 'nullable|mimes:jpg,jpeg,png,webp,mp4,webm|max:51200',
            'urutan'        => 'nullable|integer|min:0',
        ]);

        $data = $request->only('judul', 'urutan');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->storeCompressed('banners', 'public');
        }

        $banner->update($data);
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('success', 'Banner berhasil dihapus.');
    }

    public function toggleActive(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);
        return back()->with('success', 'Status banner diperbarui.');
    }
}
