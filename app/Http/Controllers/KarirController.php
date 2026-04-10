<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karir;

class KarirController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = ['Perawat', 'Penunjang Medis', 'Pelayanan Medis', 'Non Perawat'];
        $aktifKategori = $request->get('kategori', 'Semua');

        // Hitung per kategori
        $counts = [];
        $counts['Semua'] = Karir::where('is_active', true)->count();
        foreach ($kategoriList as $kat) {
            $counts[$kat] = Karir::where('is_active', true)->where('kategori', $kat)->count();
        }

        $query = Karir::where('is_active', true);
        if ($aktifKategori !== 'Semua') {
            $query->where('kategori', $aktifKategori);
        }
        if ($request->filled('search')) {
            $query->where('posisi', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $karirs = $query->latest()->paginate(9)->withQueryString();

        return view('pages.karir-index', compact('karirs', 'aktifKategori', 'counts'));
    }

    public function show($id)
    {
        $karir   = Karir::where('is_active', true)->findOrFail($id);
        $related = Karir::where('is_active', true)
                        ->where('kategori', $karir->kategori)
                        ->where('id', '!=', $karir->id)
                        ->take(3)->get();
        return view('pages.karir-detail', compact('karir', 'related'));
    }

    public function apply(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);

        $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|email',
            'telepon'      => 'required|string|max:20',
            'cv'           => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|string',
        ]);

        $cvPath = $request->file('cv')->store('karir/cv', 'public');

        \App\Models\LamaranKarir::create([
            'karir_id'     => $karir->id,
            'nama'         => $request->nama,
            'email'        => $request->email,
            'telepon'      => $request->telepon,
            'cv'           => $cvPath,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim! Tim HR kami akan menghubungi Anda dalam 3–5 hari kerja.');
    }
}
