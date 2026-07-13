<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$polis = \App\Models\Poli::whereNotNull('teramedik_id')->where('is_active', true)->with(['dokters' => function ($q) {
    $q->whereNotNull('teramedik_id')->where('is_active', true);
}])->get();

echo "Polis dengan teramedik_id: " . count($polis) . "\n";
foreach ($polis as $poli) {
    echo "  [{$poli->id}] {$poli->nama} -> " . count($poli->dokters) . " dokter(s)\n";
}
