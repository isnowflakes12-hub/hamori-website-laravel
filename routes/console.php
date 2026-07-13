<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\Artikel;

Artisan::command('migrate:categories', function () {
    $artikels = Artikel::all();
    foreach ($artikels as $a) {
        if ($a->kategori_id) {
            $a->kategoris()->syncWithoutDetaching([$a->kategori_id]);
        }
    }
    $this->info('Categories migrated successfully.');
});

// Jadwalkan sync Teramedik setiap malam jam 12
use Illuminate\Support\Facades\Schedule;
Schedule::command('teramedik:sync')->dailyAt('00:00');
