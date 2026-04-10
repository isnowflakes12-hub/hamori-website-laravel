<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Artikel;
use App\Models\Karir;
use App\Models\LamaranKarir;
use App\Models\Kontak;
use App\Models\Dokter;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $stats = [];

        if ($user->isSuperAdmin() || $user->isAdminMarketing()) {
            $stats['banners']  = Banner::count();
            $stats['artikels'] = Artikel::count();
            $stats['dokters']  = Dokter::count();
            $stats['kontaks']  = Kontak::where('is_read', false)->count();
        }
        if ($user->isSuperAdmin() || $user->isAdminSdm()) {
            $stats['karirs']   = Karir::where('is_active', true)->count();
            $stats['lamarans'] = LamaranKarir::whereNull('status')->orWhere('status', 'pending')->count();
        }
        if ($user->isSuperAdmin()) {
            $stats['users']    = User::count();
        }

        $recentLamarans = ($user->isSuperAdmin() || $user->isAdminSdm())
            ? LamaranKarir::with('karir')->latest()->take(5)->get()
            : collect();

        $recentKontaks = ($user->isSuperAdmin() || $user->isAdminMarketing())
            ? Kontak::latest()->take(5)->get()
            : collect();

        return view('admin.dashboard.index', compact('stats', 'recentLamarans', 'recentKontaks'));
    }
}
