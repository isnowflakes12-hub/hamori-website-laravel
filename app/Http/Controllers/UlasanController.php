<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Submit ulasan dari publik (frontend form)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'nullable|email|max:150',
            'whatsapp'    => 'nullable|string|max:20',
            'rating'   => 'required|integer|min:1|max:5',
            'kategori' => 'required|in:umum,rawat_inap,rawat_jalan,igd,mcu',
            'ulasan'   => 'required|string|min:10|max:1000',
        ], [
            'nama.required'    => 'Nama wajib diisi.',
            'rating.required'  => 'Pilih rating bintang.',
            'kategori.required'=> 'Pilih kategori layanan.',
            'ulasan.required'  => 'Ulasan wajib diisi.',
            'ulasan.min'       => 'Ulasan minimal 10 karakter.',
        ]);

        $validated['sumber']      = 'website';
        $validated['is_approved'] = false; // harus diapprove admin dulu

        Ulasan::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Terima kasih! Ulasan Anda sedang direview.']);
        }

        return back()->with('success_ulasan', 'Terima kasih! Ulasan Anda sedang direview oleh tim kami.');
    }
}