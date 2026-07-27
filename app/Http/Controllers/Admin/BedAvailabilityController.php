<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BedAvailability;
use Illuminate\Http\Request;

class BedAvailabilityController extends Controller
{
    public function index()
    {
        $beds = BedAvailability::orderBy('urutan')->get();
        return view('admin.bed_availability.index', compact('beds'));
    }

    public function create()
    {
        return view('admin.bed_availability.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kelas' => 'required|string|max:255',
            'nama_ruangan' => 'nullable|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'terisi' => 'nullable|integer|min:0|lte:kapasitas',
            'urutan' => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['urutan'] = $data['urutan'] ?? 0;

        BedAvailability::create($data);

        return redirect()->route('admin.bed-availability.index')->with('success', 'Data tempat tidur berhasil ditambahkan.');
    }

    public function edit(BedAvailability $bedAvailability)
    {
        return view('admin.bed_availability.edit', compact('bedAvailability'));
    }

    public function update(Request $request, BedAvailability $bedAvailability)
    {
        $data = $request->validate([
            'kelas' => 'required|string|max:255',
            'nama_ruangan' => 'nullable|string|max:255',
            'kapasitas' => 'required|integer|min:0',
            'terisi' => 'nullable|integer|min:0|lte:kapasitas',
            'urutan' => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['urutan'] = $data['urutan'] ?? $bedAvailability->urutan;

        $bedAvailability->update($data);

        return redirect()->route('admin.bed-availability.index')->with('success', 'Data tempat tidur berhasil diperbarui.');
    }

    public function destroy(BedAvailability $bedAvailability)
    {
        $bedAvailability->delete();
        return redirect()->route('admin.bed-availability.index')->with('success', 'Data tempat tidur berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $index => $id) {
            BedAvailability::where('id', $id)->update(['urutan' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
