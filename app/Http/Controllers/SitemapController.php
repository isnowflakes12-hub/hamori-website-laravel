<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karir;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Halaman Utama Statis
        $urls[] = ['url' => route('home'), 'lastmod' => now()->format('Y-m-d'), 'changefreq' => 'daily', 'priority' => '1.0'];
        $urls[] = ['url' => route('profil'), 'lastmod' => now()->format('Y-m-d'), 'changefreq' => 'weekly', 'priority' => '0.8'];
        $urls[] = ['url' => route('layanan.index'), 'lastmod' => now()->format('Y-m-d'), 'changefreq' => 'weekly', 'priority' => '0.8'];
        $urls[] = ['url' => route('dokter.index'), 'lastmod' => now()->format('Y-m-d'), 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['url' => route('karir.index'), 'lastmod' => now()->format('Y-m-d'), 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['url' => route('promo.index'), 'lastmod' => now()->format('Y-m-d'), 'changefreq' => 'daily', 'priority' => '0.8'];

        // Halaman Karir Dinamis
        $karirs = Karir::where('is_active', true)->get();
        foreach ($karirs as $k) {
            $urls[] = [
                'url' => route('karir.show', $k->slug),
                'lastmod' => $k->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        $content = view('sitemap', compact('urls'))->render();
        return response($content)->header('Content-Type', 'text/xml');
    }
}
