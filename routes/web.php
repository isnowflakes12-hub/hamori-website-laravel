<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ArtikelController as PublicArtikelController;
use App\Http\Controllers\KarirController as PublicKarirController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PartnerController;

// ─── Admin namespace shortcut ───
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\LayananAdminController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\KategoriArtikelController;
use App\Http\Controllers\Admin\DokterAdminController;
use App\Http\Controllers\Admin\KarirController as AdminKarirController;
use App\Http\Controllers\Admin\LamaranController;

/* ======================================================
   PUBLIC ROUTES
   ====================================================== */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-rs', [ProfilController::class, 'index'])->name('profil');
Route::get('/layanan-unggulan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan-unggulan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::get('/fasilitas/read/{nama}', [FasilitasController::class, 'show'])->name('fasilitas.show');
Route::get('/jadwal-dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::get('/jadwal-dokter/{id}', [DokterController::class, 'show'])->name('dokter.show');
Route::get('/hamori-update', [PublicArtikelController::class, 'index'])->name('artikel.index');
Route::get('/hamori-update/read/{kategori}/{slug}', [PublicArtikelController::class, 'show'])->name('artikel.show');
Route::get('/hamori-update/kategori/{kategori}', [PublicArtikelController::class, 'byKategori'])->name('artikel.kategori');
Route::get('/info-tempat-tidur', [HomeController::class, 'tempatTidur'])->name('tempat-tidur');
Route::get('/karir', [PublicKarirController::class, 'index'])->name('karir.index');
Route::get('/karir/{id}', [PublicKarirController::class, 'show'])->name('karir.show');
Route::post('/karir/{id}/apply', [PublicKarirController::class, 'apply'])->name('karir.apply');
Route::get('/partner', [PartnerController::class, 'index'])->name('partner');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'send'])->name('kontak.send');
Route::get('/kritik-dan-saran', [KontakController::class, 'kritikSaran'])->name('kritik-saran');
Route::post('/kritik-dan-saran', [KontakController::class, 'sendKritik'])->name('kritik-saran.send');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/paket-kesehatan', [HomeController::class, 'paketKesehatan'])->name('paket-kesehatan');
Route::get('/comming-soon', fn() => view('pages.coming-soon'))->name('coming-soon');

/* ======================================================
   ADMIN ROUTES
   ====================================================== */
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    // Protected admin routes
    Route::middleware(['auth'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile',  [ProfileController::class, 'update'])->name('profile.update');

        // Marketing — Banner
        Route::resource('banner', BannerController::class)->except(['show']);
        Route::patch('banner/{banner}/toggle', [BannerController::class, 'toggleActive'])->name('banner.toggle');

        // Marketing — Artikel
        Route::resource('artikel', AdminArtikelController::class)->except(['show']);

        // Marketing — Layanan
        Route::resource('layanan', LayananAdminController::class)->except(['show']);

        // Marketing — Dokter
        Route::resource('dokter', DokterAdminController::class)->except(['show']);

        // SDM — Karir (lowongan)
        Route::resource('karir', AdminKarirController::class)->except(['show']);
        Route::patch('karir/{karir}/toggle', [AdminKarirController::class, 'toggleActive'])->name('karir.toggle');

        // SDM — Lamaran
        Route::get('/lamaran',              [LamaranController::class, 'index'])->name('lamaran.index');
        Route::get('/lamaran/{lamaran}',    [LamaranController::class, 'show'])->name('lamaran.show');
        Route::patch('/lamaran/{lamaran}/status', [LamaranController::class, 'updateStatus'])->name('lamaran.status');
        Route::delete('/lamaran/{lamaran}', [LamaranController::class, 'destroy'])->name('lamaran.destroy');

        // Marketing — Promo
        Route::resource('promo', PromoController::class)->except(['show']);
        Route::patch('promo/{promo}/toggle', [PromoController::class, 'toggleActive'])->name('promo.toggle');
        Route::patch('promo/{promo}/featured', [PromoController::class, 'toggleFeatured'])->name('promo.featured');

        // Marketing — Kategori Artikel
        Route::resource('kategori-artikel', KategoriArtikelController::class)->except(['show']);

        // Marketing — Layanan toggle
        Route::patch('layanan/{layanan}/toggle', [LayananAdminController::class, 'toggleActive'])->name('layanan.toggle');

        // Artikel toggle publish
        Route::patch('artikel/{artikel}/publish', [AdminArtikelController::class, 'togglePublish'])->name('artikel.publish');

        // Super Admin — Users
        Route::resource('users', UserController::class)->except(['show']);
        Route::patch('users/{user}/toggle', [UserController::class, 'toggleActive'])->name('users.toggle');
    });
});

// Public Promo page
Route::get('/promo', [\App\Http\Controllers\PromoPublicController::class, 'index'])->name('promo.index');
Route::get('/promo/{id}', [\App\Http\Controllers\PromoPublicController::class, 'show'])->name('promo.show');
 