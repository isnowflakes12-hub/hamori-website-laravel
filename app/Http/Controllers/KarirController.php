<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karir;
use App\Models\KarirKategori;
use App\Models\KarirTipe;

class KarirController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = KarirKategori::where('is_active', true)->orderBy('urutan')->get();
        $tipes = KarirTipe::where('is_active', true)->orderBy('nama')->get();

        $aktifKategori = $request->get('kategori', 'Semua');

        // Hitung per kategori
        $counts = [];
        $counts['Semua'] = Karir::where('is_active', true)->count();
        foreach ($kategoris as $kat) {
            $counts[$kat->nama] = Karir::where('is_active', true)->where('kategori', $kat->nama)->count();
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

        return view('pages.karir-index', compact('karirs', 'aktifKategori', 'counts', 'kategoris', 'tipes'));
    }

    public function show($id)
    {
        $karir   = Karir::where('is_active', true)->findOrFail($id);
        $related = Karir::where('is_active', true)
                        ->where('kategori', $karir->kategori)
                        ->where('id', '!=', $karir->id)
                        ->take(3)->get();
        $kategoris = KarirKategori::where('is_active', true)->get();
        $tipes = KarirTipe::where('is_active', true)->get();
        return view('pages.karir-detail', compact('karir', 'related', 'kategoris', 'tipes'));
    }

    public function apply(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);

        $request->validate([
            'nama'                => 'required|string|max:200',
            'email'               => 'required|email:rfc,dns',
            'telepon'             => ['required', 'string', 'regex:/^(\+62|62|0)8[0-9]{7,13}$/'],
            'cv'                  => 'required|file|mimes:pdf|max:5120',
            'cover_letter'        => 'nullable|string|max:5000',
            'g-recaptcha-response'=> 'required',
        ], [
            'nama.required'                => 'Nama lengkap wajib diisi.',
            'nama.max'                     => 'Nama lengkap maksimal 200 karakter.',
            'email.required'               => 'Email wajib diisi.',
            'email.email'                  => 'Format email tidak valid.',
            'telepon.required'             => 'Nomor WhatsApp wajib diisi.',
            'telepon.regex'                => 'Format nomor tidak valid. Gunakan format 08xxx atau +628xxx.',
            'cv.required'                  => 'File CV wajib diupload.',
            'cv.mimes'                     => 'CV hanya boleh dalam format PDF.',
            'cv.max'                       => 'Ukuran CV maksimal 5 MB.',
            'g-recaptcha-response.required'=> 'Verifikasi reCAPTCHA wajib dilakukan.',
        ]);

        // Verifikasi reCAPTCHA
        $recaptcha = new \ReCaptcha\ReCaptcha(config('services.recaptcha.secret_key'));
        $resp = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        if (!$resp->isSuccess()) {
            return back()->withErrors(['g-recaptcha-response' => 'Validasi reCAPTCHA gagal. Silakan coba lagi.'])->withInput();
        }

        $cvPath = $request->file('cv')->store('karir/cv', 'public');

        \App\Models\LamaranKarir::create([
            'karir_id'     => $karir->id,
            'nama'         => $request->nama,
            'email'        => $request->email,
            'telepon'      => $request->telepon,
            'cv'           => $cvPath,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->back()->with('success', true);
    }
}
