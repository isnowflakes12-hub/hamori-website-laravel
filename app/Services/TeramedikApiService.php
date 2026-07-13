<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TeramedikApiService
{
    protected $baseUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        // Using hardcoded fallback for development based on provided login.txt
        $this->baseUrl = config('services.teramedik.base_url', 'https://v3-api-webservice-dev.teramobile.app');
        $this->username = config('services.teramedik.username', 'Rshamori_dev');
        $this->password = config('services.teramedik.password', 'Rshamoridev81HsR0');
    }

    /**
     * Dapatkan Bearer Token (di-cache 20 jam agar tidak berulang-ulang login)
     */
    public function getToken()
    {
        return Cache::remember('teramedik_api_token', now()->addHours(20), function () {
            // Using asForm() just in case the API doesn't accept JSON payload for login
            $response = Http::asForm()->post("{$this->baseUrl}/api/v1/login", [
                'username' => $this->username,
                'password' => $this->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['token'])) {
                    return $data['token'];
                } else if (isset($data['access_token'])) {
                    return $data['access_token'];
                }
            }

            // Jika gagal login, jangan simpan di cache
            Cache::forget('teramedik_api_token');
            throw new \Exception("Gagal login ke Teramedik API: " . $response->body());
        });
    }

    /**
     * Tarik data Poliklinik, Dokter, dan Jadwalnya
     */
    public function getSpecialistDoctorsSchedule()
    {
        $token = $this->getToken();
        $rsid = config('services.teramedik.rsid', 316);
        
        // Pass rsid in JSON body as required by Teramedik multi-tenant API
        $response = Http::withToken($token)
            ->acceptJson()
            ->withBody(json_encode(['rsid' => $rsid, 'group' => true]), 'application/json')
            ->get("{$this->baseUrl}/api/v1/SpecialistDoctorsSchedule");
            
        if ($response->successful()) {
            return $response->json();
        }
        
        throw new \Exception("Gagal mengambil data jadwal dari Teramedik: " . $response->body());
    }
}
