<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        \Illuminate\Http\UploadedFile::macro('storeCompressed', function ($path, $disk = 'public') {
            return \App\Helpers\ImageHelper::compressAndStore($this, $path, $disk);
        });

        // Inject dynamic Fasilitas Navbar data into every page
        View::composer('layouts.app', function ($view) {
            try {
                $navbarKategoriFasilitas = \App\Models\KategoriFasilitas::with(['fasilitas' => function ($q) {
                    $q->where('tampil_di_navbar', true)
                      ->where('is_active', true)
                      ->orderBy('nama');
                }])
                ->where('is_active', true)
                ->orderBy('urutan')
                ->get()
                ->filter(fn($kat) => $kat->fasilitas->isNotEmpty());

                $view->with('navbarKategoriFasilitas', $navbarKategoriFasilitas);
            } catch (\Exception $e) {
                // Jika tabel belum ada (saat migrasi), abaikan error
                $view->with('navbarKategoriFasilitas', collect());
            }
        });
    }
}
