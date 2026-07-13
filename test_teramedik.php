<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Http;

$login = Http::asForm()->post('https://v3-api-webservice-dev.teramobile.app/api/v1/login', [
    'username' => 'Rshamori_dev',
    'password' => 'Rshamoridev81HsR0'
])->json();
$token = $login['token'] ?? null;

$response2 = Http::withToken($token)->acceptJson()->get('https://v3-api-webservice-dev.teramobile.app/api/v1/SpecialistDoctorsSchedule', ['rsid' => 316]);
echo "Specialist (query): " . $response2->status() . " -> " . $response2->body() . "\n";

$response3 = Http::withToken($token)->acceptJson()->withBody(json_encode(['rsid' => 316, 'group' => true]), 'application/json')->get('https://v3-api-webservice-dev.teramobile.app/api/v1/SpecialistDoctorsSchedule');
echo "Specialist (body): " . $response3->status() . " -> " . $response3->body() . "\n";
