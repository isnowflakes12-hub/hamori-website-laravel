<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananUnggulan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = LayananUnggulan::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.layanan-index', compact('layanans'));
    }

    public function show($slug)
    {
        $layanan = LayananUnggulan::where('slug', $slug)
        ->where('is_active', 1)
        ->firstOrFail();

        $related = LayananUnggulan::where('id', '!=', $layanan->id)
        ->where('is_active', 1)
        ->take(3)
        ->get();

        $others = LayananUnggulan::where('slug', '!=', $slug)->where('is_active', true)->get();
        return view('pages.layanan-detail', compact('layanan', 'others'));
    }
    
}
