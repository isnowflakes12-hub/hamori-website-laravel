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
            'tahun' => 'required|integer|min:1900|max:'.(date('Y')+5),
            'judul' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('milestone', 'public');
        }

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
            'tahun' => 'required|integer|min:1900|max:'.(date('Y')+5),
            'judul' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($milestone->gambar) {
                Storage::disk('public')->delete($milestone->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('milestone', 'public');
        }

        $milestone->update($data);

        return redirect()->route('admin.milestone.index')->with('success', 'Milestone berhasil diperbarui.');
    }

    public function destroy(Milestone $milestone)
    {
        if ($milestone->gambar) {
            Storage::disk('public')->delete($milestone->gambar);
        }
        $milestone->delete();
        return back()->with('success', 'Milestone berhasil dihapus.');
    }
}
