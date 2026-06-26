<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\KritikSaran;

class KontakController extends Controller
{
    public function index()
    {
        return view('pages.kontak');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|min:2|max:255',
            'email'   => 'required|email',
            'telepon' => 'required|string|max:20',
            'subjek'  => 'required|string|max:255',
            'pesan'   => 'required|string',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.min' => 'Nama minimal 2 huruf.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'Nomor telepon harus diisi.',
            'subjek.required' => 'Subjek harus diisi.',
            'pesan.required' => 'Pesan harus diisi.',
        ]);

        Kontak::create($request->only(['nama', 'email', 'telepon', 'subjek', 'pesan']));

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }

    public function kritikSaran()
    {
        return view('pages.kritik-saran');
    }

    public function sendKritik(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|min:2|max:255',
            'email'    => 'required|email',
            'telepon'  => 'required|string|max:20',
            'kategori' => 'required|in:kritik,saran,pertanyaan',
            'pesan'    => 'required|string',
            'rating'   => 'required|integer|min:1|max:5',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.min' => 'Nama minimal 2 huruf.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'Nomor telepon harus diisi.',
            'kategori.required' => 'Kategori harus diisi.',
            'kategori.in' => 'Kategori tidak valid.',
            'pesan.required' => 'Pesan harus diisi.',
            'rating.required' => 'Penilaian harus diisi.',
        ]);

        KritikSaran::create($request->only(['nama', 'email', 'telepon', 'kategori', 'pesan', 'rating']));

        return redirect()->back()->with('success', 'Terima kasih atas masukan Anda!');
    }
}
