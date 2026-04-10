<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function show($nama)
    {
        $fasilitas = Fasilitas::where('nama', $nama)->firstOrFail();
        $groups = Fasilitas::select('kategori')->distinct()->get()->pluck('kategori');
        return view('pages.fasilitas-detail', compact('fasilitas', 'groups'));
    }
}
