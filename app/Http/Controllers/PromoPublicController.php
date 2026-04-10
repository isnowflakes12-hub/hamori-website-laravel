<?php
namespace App\Http\Controllers;

use App\Models\Promo;

class PromoPublicController extends Controller
{
    public function index()
    {
        $promos = Promo::where('is_active', true)
                       ->where(function($q) {
                           $q->whereNull('berlaku_sampai')
                             ->orWhere('berlaku_sampai', '>=', now());
                       })
                       ->orderBy('is_featured','desc')
                       ->orderBy('urutan')
                       ->get();

        return view('pages.promo', compact('promos'));
    }

    public function show($id)
    {
        $promo = Promo::where('is_active', true)->findOrFail($id);
        return view('pages.promo-detail', compact('promo'));
    }
}
