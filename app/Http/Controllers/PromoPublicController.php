<?php
namespace App\Http\Controllers;

use App\Models\Promo;

class PromoPublicController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->get('search', '');
        $query = Promo::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $promos = $query->orderBy('is_featured', 'desc')
                        ->orderBy('urutan', 'asc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(6)
                        ->withQueryString();

        return view('pages.promo', compact('promos', 'search'));
    }
    

    public function detail(string $id)
    {
        // 1. Ambil data promo utama berdasarkan ID
        $promo = Promo::findOrFail($id);

        // 2. Ambil data promo terkait secara otomatis (kecuali promo yang sedang dibuka)
        // Ambil maksimal 3 data untuk disuplai ke variabel $related di Blade
        $related = Promo::where('id', '!=', $id)
                        ->where(function ($q) {
                            $q->whereNull('berlaku_sampai')
                              ->orWhere('berlaku_sampai', '>=', now());
                        })
                        ->inRandomOrder()
                        ->take(3)
                        ->get();

        return view('pages.promo-detail', compact('promo', 'related'));
    } 
}
