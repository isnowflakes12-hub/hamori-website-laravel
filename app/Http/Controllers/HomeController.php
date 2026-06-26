<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\LayananUnggulan;
use App\Models\Artikel;
use App\Models\Faq;
use App\Models\TempatTidur;
use App\Models\Promo;
use App\Models\Ulasan;
use App\Models\PrivacyPolicy;

class HomeController extends Controller
{
    public function index()
    {
        $banners         = Banner::where('is_active', true)->orderBy('urutan')->get();
        $layananUnggulan = LayananUnggulan::where('is_active', true)->orderBy('urutan')->get();
        $artikelTerbaru  = Artikel::where('is_published', true)
                                ->orderBy('published_at', 'desc')
                                ->take(3)->get();

        // Promo featured untuk popup & panel beranda
        $promoFeatured = Promo::where('is_featured', true)
                            ->where(function ($q) {
                                $q->whereNull('berlaku_sampai')
                                    ->orWhere('berlaku_sampai', '>=', now());
                            })
                            ->orderBy('urutan')
                            ->first();

        // Semua promo aktif untuk section promo
        $promoAktif = Promo::where('is_featured', true)
                        ->where(function ($q) {
                            $q->whereNull('berlaku_sampai')
                                ->orWhere('berlaku_sampai', '>=', now());
                        })
                        ->orderByDesc('is_featured')
                        ->orderBy('urutan')
                        ->take(6)->get();

        // ── Kritik & Saran (Menggantikan Ulasan) ──────────────────────
        $kritikSaranFeatured = \App\Models\KritikSaran::approved()
                                ->featured()
                                ->notExpired()
                                ->latest('approved_at')
                                ->take(10)
                                ->get();

        return view('pages.home', compact(
            'banners', 'layananUnggulan', 'artikelTerbaru',
            'promoFeatured', 'promoAktif',
            'kritikSaranFeatured'
        ));
    }

    public function tempatTidur()
    {
        $tempatTidur = TempatTidur::all()->groupBy('kelas');
        return view('pages.tempat-tidur', compact('tempatTidur'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.faq', compact('faqs'));
    }

    public function privacyPolicy()
    {
        $policies = PrivacyPolicy::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.privacy-policy', compact('policies'));
    }



    public function paketKesehatan()
    {
        return view('pages.paket-kesehatan');
    }
}
