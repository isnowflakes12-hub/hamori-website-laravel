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
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'subjek'  => 'required|string|max:255',
            'pesan'   => 'required|string',
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
            'nama'     => 'required|string|max:255',
            'email'    => 'nullable|email',
            'telepon'  => 'nullable|string|max:20',
            'kategori' => 'required|in:kritik,saran,pertanyaan',
            'pesan'    => 'required|string',
            'rating'   => 'nullable|integer|min:1|max:5',
        ]);

        KritikSaran::create($request->only(['nama', 'email', 'telepon', 'kategori', 'pesan', 'rating']));

        return redirect()->back()->with('success', 'Terima kasih atas masukan Anda!');
    }
}
