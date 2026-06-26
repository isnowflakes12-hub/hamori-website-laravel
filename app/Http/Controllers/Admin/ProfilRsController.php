<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilRs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilRsController extends Controller
{
    public function edit()
    {
        $profil = ProfilRs::first();
        if (!$profil) {
            $profil = ProfilRs::create([
                'deskripsi' => 'Kami adalah Member of "JIH" Group...',
                'visi' => 'Menjadi Rumah Sakit Unggul...',
                'misi' => "Menyediakan pelayanan kesehatan...\nMengembangkan sumber daya manusia...",
            ]);
        }
        return view('admin.profil-rs.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'total_dokter' => 'nullable|string|max:50',
            'total_bed' => 'nullable|string|max:50',
            'pusat_unggulan' => 'nullable|string|max:50',
            'kars_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $profil = ProfilRs::first();

        $data = $request->only([
            'deskripsi', 'visi', 'misi', 
            'total_dokter', 'total_bed', 'pusat_unggulan'
        ]);

        if ($request->hasFile('kars_logo')) {
            if ($profil->kars_logo) {
                Storage::disk('public')->delete($profil->kars_logo);
            }
            $data['kars_logo'] = $request->file('kars_logo')->store('profil', 'public');
        }

        if ($request->hasFile('gambar_utama')) {
            if ($profil->gambar_utama) {
                Storage::disk('public')->delete($profil->gambar_utama);
            }
            $data['gambar_utama'] = $request->file('gambar_utama')->store('profil', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.profil-rs.edit')->with('success', 'Profil RS berhasil diperbarui.');
    }
}
