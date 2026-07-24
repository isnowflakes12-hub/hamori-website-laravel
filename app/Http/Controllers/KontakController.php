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
            'g-recaptcha-response' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.min' => 'Nama minimal 2 huruf.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'Nomor telepon harus diisi.',
            'subjek.required' => 'Subjek harus diisi.',
            'pesan.required' => 'Pesan harus diisi.',
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA wajib diisi.',
        ]);

        $recaptcha = new \ReCaptcha\ReCaptcha(config('services.recaptcha.secret_key'));
        $resp = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        if (!$resp->isSuccess()) {
            return back()->withErrors(['g-recaptcha-response' => 'Validasi reCAPTCHA gagal. Silakan coba lagi.'])->withInput();
        }

        Kontak::create($request->only(['nama', 'email', 'telepon', 'subjek', 'pesan']));

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }

    public function kritikSaran()
    {
        $polis = \App\Models\Poli::orderBy('nama')->get();
        return view('pages.kritik-saran', compact('polis'));
    }

    public function sendKritik(Request $request)
    {
        $request->validate([
            'responden' => 'required|in:pasien,pengunjung',
            'nama_poliklinik' => 'nullable|string|max:255',
            'nama'     => 'required|string|min:2|max:255',
            'email'    => 'nullable|email',
            'telepon'  => 'required|string|max:20',
            'kategori' => 'nullable|in:kritik,saran,pertanyaan',
            'pesan'    => 'required|string',
            'rating_kepuasan_rs'      => 'required|integer|min:1|max:5',
            'rating_alur_pelayanan'   => 'required|integer|min:1|max:5',
            'rating_fasilitas'        => 'required|integer|min:1|max:5',
            'rating_kesesuaian_biaya' => 'required|integer|min:1|max:5',
            'rating_pelayanan_dokter' => 'required|integer|min:1|max:5',
            'rating_pelayanan_perawat'=> 'required|integer|min:1|max:5',
            'rating_laboratorium'     => 'required|integer|min:1|max:5',
            'rating_radiologi'        => 'required|integer|min:1|max:5',
            'rating_fisioterapi'      => 'required|integer|min:1|max:5',
            'rating_farmasi'          => 'required|integer|min:1|max:5',
            'g-recaptcha-response'    => 'required',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.min' => 'Nama minimal 2 huruf.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'Nomor telepon harus diisi.',
            'kategori.required' => 'Kategori harus diisi.',
            'kategori.in' => 'Kategori tidak valid.',
            'pesan.required' => 'Pesan harus diisi.',
            'rating_kepuasan_rs.required'       => 'Penilaian Kepuasan RS harus diisi.',
            'rating_alur_pelayanan.required'    => 'Penilaian Alur Pelayanan harus diisi.',
            'rating_fasilitas.required'         => 'Penilaian Fasilitas harus diisi.',
            'rating_kesesuaian_biaya.required'  => 'Penilaian Kesesuaian Biaya harus diisi.',
            'rating_pelayanan_dokter.required'  => 'Penilaian Pelayanan Dokter harus diisi.',
            'rating_pelayanan_perawat.required' => 'Penilaian Pelayanan Perawat harus diisi.',
            'rating_laboratorium.required'      => 'Penilaian Laboratorium harus diisi.',
            'rating_radiologi.required'         => 'Penilaian Radiologi harus diisi.',
            'rating_fisioterapi.required'       => 'Penilaian Fisioterapi harus diisi.',
            'rating_farmasi.required'           => 'Penilaian Farmasi harus diisi.',
            'g-recaptcha-response.required'     => 'Verifikasi reCAPTCHA wajib diisi.',
        ]);

        $recaptcha = new \ReCaptcha\ReCaptcha(config('services.recaptcha.secret_key'));
        $resp = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        if (!$resp->isSuccess()) {
            return back()->withErrors(['g-recaptcha-response' => 'Validasi reCAPTCHA gagal. Silakan coba lagi.'])->withInput();
        }

        $data = $request->only([
            'nama', 'email', 'telepon', 'kategori', 'pesan', 'responden', 'nama_poliklinik',
            'rating_kepuasan_rs', 'rating_alur_pelayanan', 'rating_fasilitas',
            'rating_kesesuaian_biaya', 'rating_pelayanan_dokter', 'rating_pelayanan_perawat',
            'rating_laboratorium', 'rating_radiologi', 'rating_fisioterapi', 'rating_farmasi',
        ]);
        if (empty($data['kategori'])) {
            $data['kategori'] = 'saran';
        }
        KritikSaran::create($data);

        return redirect()->back()->with('success', 'Terima kasih atas masukan Anda!');
    }
}


