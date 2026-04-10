<?php

namespace App\Http\Controllers;

use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::where('is_active', true)->orderBy('nama')->get()->groupBy('kategori');
        return view('pages.partner', compact('partners'));
    }
}
