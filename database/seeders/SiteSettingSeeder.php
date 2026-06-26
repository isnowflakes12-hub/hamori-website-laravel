<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── Social Media ──
            ['key' => 'social_instagram',  'value' => 'https://www.instagram.com/rshamori/',  'type' => 'url', 'group' => 'social'],
            ['key' => 'social_youtube',    'value' => 'https://www.youtube.com/@rshamori',     'type' => 'url', 'group' => 'social'],
            ['key' => 'social_facebook',   'value' => 'https://web.facebook.com/rshamori',     'type' => 'url', 'group' => 'social'],
            ['key' => 'social_tiktok',     'value' => 'https://www.tiktok.com/@rshamori',      'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter',    'value' => 'https://twitter.com/RSHamori',          'type' => 'url', 'group' => 'social'],

            // ── Phone Numbers ──
            ['key' => 'phone_call_center', 'value' => '1500816',         'type' => 'text', 'group' => 'phone'],
            ['key' => 'phone_general',     'value' => '02604250888',     'type' => 'text', 'group' => 'phone'],
            ['key' => 'phone_igd',         'value' => '02604250999',     'type' => 'text', 'group' => 'phone'],
            ['key' => 'phone_whatsapp',    'value' => '628888905555',    'type' => 'text', 'group' => 'phone'],
            ['key' => 'link_wa_appointment','value' => 'https://wa.link/1uk9rl', 'type' => 'url', 'group' => 'phone'],

            // ── Address & Maps ──
            ['key' => 'address',           'value' => 'Jalan Raya Pagaden-Subang, Ds. Jabong Kec. Pagaden Kab. Subang Jawa Barat 41251', 'type' => 'textarea', 'group' => 'address'],
            ['key' => 'maps_embed_url',    'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.123456!2d107.123456!3d-6.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sRS+Hamori!5e0!3m2!1sid!2sid!4v1234567890', 'type' => 'textarea', 'group' => 'address'],
            ['key' => 'maps_link',         'value' => 'https://maps.google.com/?q=RS+Hamori+Subang', 'type' => 'url', 'group' => 'address'],

            // ── Logo & Branding ──
            ['key' => 'logo',              'value' => null, 'type' => 'image', 'group' => 'logo'],
            ['key' => 'logo_white',        'value' => null, 'type' => 'image', 'group' => 'logo'],
            ['key' => 'favicon',           'value' => null, 'type' => 'image', 'group' => 'logo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
