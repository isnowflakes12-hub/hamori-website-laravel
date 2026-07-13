<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::orderBy('tahun', 'desc')->paginate(10);
        return view('admin.milestone.index', compact('milestones'));
    }

    public function create()
    {
        return view('admin.milestone.form', ['milestone' => new Milestone()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'     => 'required|integer|min:1900|max:'.(date('Y')+5),
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'galeri.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->except(['gambar', 'galeri']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('milestone', 'public');
        }

        $galeri = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('milestone/galeri', 'public');
            }
        }
        $data['galeri'] = count($galeri) > 0 ? $galeri : null;

        Milestone::create($data);

        return redirect()->route('admin.milestone.index')->with('success', 'Milestone berhasil ditambahkan.');
    }

    public function edit(Milestone $milestone)
    {
        return view('admin.milestone.form', compact('milestone'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $request->validate([
            'tahun'     => 'required|integer|min:1900|max:'.(date('Y')+5),
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'galeri.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->except(['gambar', 'galeri', 'delete_galeri']);

        if ($request->hasFile('gambar')) {
            if ($milestone->gambar) {
                Storage::disk('public')->delete($milestone->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('milestone', 'public');
        }

        // Handle galeri: remove flagged images, add new ones
        $galeri = is_array($milestone->galeri) ? $milestone->galeri : [];

        if ($request->delete_galeri) {
            foreach ($request->delete_galeri as $path) {
                Storage::disk('public')->delete($path);
            }
            $galeri = array_values(array_diff($galeri, $request->delete_galeri));
        }

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('milestone/galeri', 'public');
            }
        }

        $data['galeri'] = count($galeri) > 0 ? $galeri : null;

        $milestone->update($data);

        return redirect()->route('admin.milestone.index')->with('success', 'Milestone berhasil diperbarui.');
    }

    public function destroy(Milestone $milestone)
    {
        if ($milestone->gambar) {
            Storage::disk('public')->delete($milestone->gambar);
        }
        if (is_array($milestone->galeri)) {
            foreach ($milestone->galeri as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $milestone->delete();
        return back()->with('success', 'Milestone berhasil dihapus.');
    }
}
