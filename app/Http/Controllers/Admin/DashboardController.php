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
use App\Models\AdminMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $stats = [];

        // ── Ambil semua route_name yang bisa diakses user ini dari admin_menus ──
        // Ini mencakup menu induk maupun sub-menu (children)
        try {
            $accessibleRoutes = AdminMenu::where('is_active', true)
                ->where(function ($q) use ($user) {
                    $q->whereJsonContains('roles', $user->role);
                })
                ->whereNotNull('route_name')
                ->pluck('route_name')
                ->toArray();
        } catch (\Exception $e) {
            // Fallback jika tabel belum ada
            $accessibleRoutes = [];
        }

        // Helper: apakah user punya akses ke route tertentu?
        $can = fn(string $route) => in_array($route, $accessibleRoutes) || $user->isSuperAdmin();

        // ── Stats Marketing ──
        if ($can('admin.banner.index'))          $stats['banners']  = Banner::count();
        if ($can('admin.promo.index'))           $stats['promos']   = Promo::count();
        if ($can('admin.artikel.index'))         $stats['artikels'] = Artikel::count();
        if ($can('admin.layanan.index'))         $stats['layanans'] = LayananUnggulan::count();
        if ($can('admin.kritik-saran.index'))    $stats['kritiks']  = KritikSaran::where('status', 'pending')->count();

        // ── Stats yang mungkin diserahkan ke marketing via admin_menus ──
        if ($can('admin.dokter.index'))          $stats['dokters']   = Dokter::count();
        if ($can('admin.fasilitas.index'))       $stats['fasilitas'] = Fasilitas::count();
        if ($can('admin.kontak.index'))          $stats['kontaks']   = Kontak::where('is_read', false)->count();

        // ── Stats SDM ──
        if ($can('admin.karir.index'))           $stats['karirs']   = Karir::where('is_active', true)->count();
        if ($can('admin.lamaran.index'))         $stats['lamarans'] = LamaranKarir::whereNull('status')->orWhere('status', 'pending')->count();

        // ── Stats Super Admin Only ──
        if ($user->isSuperAdmin())               $stats['users'] = User::count();

        // ── Tabel Recent ──
        $recentLamarans = $can('admin.lamaran.index')
            ? LamaranKarir::with('karir')->latest()->take(5)->get()
            : collect();

        $recentKontaks = $can('admin.kontak.index')
            ? Kontak::latest()->take(5)->get()
            : collect();

        $recentKritikSarans = $can('admin.kritik-saran.index')
            ? KritikSaran::latest()->take(5)->get()
            : collect();

        // ── Rating Analytics (berdasarkan akses Kritik & Saran) ──
        $ratingAnalytics = null;
        if ($can('admin.kritik-saran.index')) {

            $driver = DB::getDriverName();

            $castType = $driver === 'pgsql' ? 'NUMERIC' : 'REAL';

            // Rata-rata per indikator
            $indikators = [
                'rating_kepuasan_rs'      => 'Kepuasan RS',
                'rating_alur_pelayanan'   => 'Alur Pelayanan',
                'rating_fasilitas'        => 'Fasilitas',
                'rating_kesesuaian_biaya' => 'Kesesuaian Biaya',
                'rating_pelayanan_dokter' => 'Pelayanan Dokter',
                'rating_pelayanan_perawat'=> 'Pelayanan Perawat',
                'rating_laboratorium'     => 'Laboratorium',
                'rating_radiologi'        => 'Radiologi',
                'rating_fisioterapi'      => 'Fisioterapi',
                'rating_farmasi'          => 'Farmasi',
            ];

            $avgPerIndikator = [];
            $totalResponden  = KritikSaran::count();

            foreach ($indikators as $col => $label) {
                $avg = KritikSaran::whereNotNull($col)->avg($col);
                $avgPerIndikator[] = [
                    'label' => $label,
                    'col'   => $col,
                    'avg'   => $avg ? round($avg, 2) : 0,
                    'total' => KritikSaran::whereNotNull($col)->count(),
                ];
            }

            // Rata-rata keseluruhan dari semua indikator
            $allAvgs = array_filter(array_column($avgPerIndikator, 'avg'));
            $avgKeseluruhan = count($allAvgs) ? round(array_sum($allAvgs) / count($allAvgs), 2) : 0;

            // Distribusi per kategori
            $ratingPerKategori = KritikSaran::select('kategori', DB::raw('COUNT(*) as total'))
                ->groupBy('kategori')
                ->get();

            // Responden per jenis
            $respondenStats = KritikSaran::select('responden', DB::raw('COUNT(*) as total'))
                ->groupBy('responden')
                ->get();

            // Masukan per bulan (12 bulan terakhir)
            $dateFmt = fn(string $format, string $col): string => match ($driver) {
                'pgsql'  => "TO_CHAR($col, '$format')",
                'mysql'  => "DATE_FORMAT($col, '$format')",
                default  => "strftime('$format', $col)",
            };
            $fmtBulan = match ($driver) { 'pgsql' => 'YYYY-MM', 'mysql' => '%Y-%m', default => '%Y-%m' };

            $masukanPerBulan = KritikSaran::where('created_at', '>=', now()->subMonths(11)->startOfMonth())
                ->select(
                    DB::raw($dateFmt($fmtBulan, 'created_at') . ' as bulan'),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            $ratingAnalytics = [
                'avg_per_indikator'  => $avgPerIndikator,
                'avg_keseluruhan'    => $avgKeseluruhan,
                'total_responden'    => $totalResponden,
                'per_kategori'       => $ratingPerKategori,
                'responden_stats'    => $respondenStats,
                'masukan_per_bulan'  => $masukanPerBulan,
            ];
        }

        return view('admin.dashboard.index', compact(
            'stats', 'recentLamarans', 'recentKontaks', 'recentKritikSarans', 'ratingAnalytics'
        ));
    }
}
