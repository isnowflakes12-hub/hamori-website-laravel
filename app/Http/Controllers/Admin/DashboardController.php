<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Artikel;
use App\Models\Karir;
use App\Models\LamaranKarir;
use App\Models\Kontak;
use App\Models\KritikSaran;
use App\Models\Dokter;
use App\Models\Promo;
use App\Models\LayananUnggulan;
use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $stats = [];

        if ($user->isSuperAdmin() || $user->isAdminMarketing()) {
            $stats['banners']  = Banner::count();
            $stats['promos']   = Promo::count();
            $stats['artikels'] = Artikel::count();
            $stats['layanans'] = LayananUnggulan::count();
            $stats['kritiks']  = KritikSaran::where('status', 'pending')->count();
        }
        if ($user->isSuperAdmin()) {
            $stats['dokters']   = Dokter::count();
            $stats['fasilitas'] = Fasilitas::count();
            $stats['kontaks']   = Kontak::where('is_read', false)->count();
        }
        if ($user->isSuperAdmin() || $user->isAdminSdm()) {
            $stats['karirs']   = Karir::where('is_active', true)->count();
            $stats['lamarans'] = LamaranKarir::whereNull('status')->orWhere('status', 'pending')->count();
        }
        if ($user->isSuperAdmin()) {
            $stats['users'] = User::count();
        }

        $recentLamarans = ($user->isSuperAdmin() || $user->isAdminSdm())
            ? LamaranKarir::with('karir')->latest()->take(5)->get()
            : collect();

        $recentKontaks = $user->isSuperAdmin()
            ? Kontak::latest()->take(5)->get()
            : collect();

        $recentKritikSarans = ($user->isSuperAdmin() || $user->isAdminMarketing())
            ? KritikSaran::latest()->take(5)->get()
            : collect();

        // ── Rating Analytics (untuk Super Admin & Marketing) ──
        $ratingAnalytics = null;
        if ($user->isSuperAdmin() || $user->isAdminMarketing()) {

            // Rating per hari (7 hari terakhir)
            $ratingPerHari = KritikSaran::whereNotNull('rating')
                ->where('created_at', '>=', now()->subDays(6)->startOfDay())
                ->select(
                    DB::raw("strftime('%Y-%m-%d', created_at) as tanggal"),
                    DB::raw('ROUND(AVG(CAST(rating AS REAL)), 1) as avg_rating'),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            // Rating per bulan (12 bulan terakhir)
            $ratingPerBulan = KritikSaran::whereNotNull('rating')
                ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
                ->select(
                    DB::raw("strftime('%Y-%m', created_at) as bulan"),
                    DB::raw('ROUND(AVG(CAST(rating AS REAL)), 1) as avg_rating'),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            // Rating per tahun (5 tahun terakhir)
            $ratingPerTahun = KritikSaran::whereNotNull('rating')
                ->where('created_at', '>=', now()->subYears(4)->startOfYear())
                ->select(
                    DB::raw("strftime('%Y', created_at) as tahun"),
                    DB::raw('ROUND(AVG(CAST(rating AS REAL)), 1) as avg_rating'),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get();

            // Distribusi per kategori
            $ratingPerKategori = KritikSaran::select('kategori', DB::raw('COUNT(*) as total'))
                ->groupBy('kategori')
                ->get();

            // Distribusi bintang rating 1-5
            $distribusiRating = KritikSaran::whereNotNull('rating')
                ->select('rating', DB::raw('COUNT(*) as total'))
                ->groupBy('rating')
                ->orderBy('rating')
                ->get();

            // Rata-rata rating keseluruhan
            $avgRatingKeseluruhan = KritikSaran::whereNotNull('rating')->avg('rating');

            $ratingAnalytics = [
                'per_hari'          => $ratingPerHari,
                'per_bulan'         => $ratingPerBulan,
                'per_tahun'         => $ratingPerTahun,
                'per_kategori'      => $ratingPerKategori,
                'distribusi_rating' => $distribusiRating,
                'avg_keseluruhan'   => round($avgRatingKeseluruhan ?? 0, 1),
                'total_responden'   => KritikSaran::whereNotNull('rating')->count(),
            ];
        }

        return view('admin.dashboard.index', compact(
            'stats', 'recentLamarans', 'recentKontaks', 'recentKritikSarans', 'ratingAnalytics'
        ));
    }
}
