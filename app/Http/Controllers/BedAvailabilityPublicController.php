<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BedAvailability;

class BedAvailabilityPublicController extends Controller
{
    public function index()
    {
        $beds = BedAvailability::where('is_active', true)
                               ->orderBy('urutan')
                               ->get();
                               
        return view('pages.info-tempat-tidur', compact('beds'));
    }
}
