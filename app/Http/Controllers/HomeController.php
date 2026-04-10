<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\LayananUnggulan;
use App\Models\Artikel;
use App\Models\Faq;
use App\Models\TempatTidur;
use App\Models\Promo;

class HomeController extends Controller
{
    public function index()
    {
        $banners         = Banner::where('is_active', true)->orderBy('urutan')->get();
        $layananUnggulan = LayananUnggulan::where('is_active', true)->orderBy('urutan')->get();
        $artikelTerbaru  = Artikel::where('is_published', true)
                                   ->orderBy('published_at', 'desc')
                                   ->take(3)->get();

        // Ambil promo featured untuk popup & panel beranda
        $promoFeatured   = Promo::where('is_active', true)
                                 ->where('is_featured', true)
                                 ->where(function($q) {
                                     $q->whereNull('berlaku_sampai')
                                       ->orWhere('berlaku_sampai', '>=', now());
                                 })
                                 ->orderBy('urutan')
                                 ->first();

        // Ambil semua promo aktif untuk halaman promo
        $promoAktif      = Promo::where('is_active', true)
                                 ->where(function($q) {
                                     $q->whereNull('berlaku_sampai')
                                       ->orWhere('berlaku_sampai', '>=', now());
                                 })
                                 ->orderBy('is_featured', 'desc')
                                 ->orderBy('urutan')
                                 ->take(6)->get();

        return view('pages.home', compact(
            'banners', 'layananUnggulan', 'artikelTerbaru',
            'promoFeatured', 'promoAktif'
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
        return view('pages.privacy-policy');
    }

    public function paketKesehatan()
    {
        return view('pages.paket-kesehatan');
    }
}
