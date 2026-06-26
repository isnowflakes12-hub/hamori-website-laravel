<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('site_settings')->delete();
        
        \DB::table('site_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'social_instagram',
                'value' => 'https://www.instagram.com/rshamori/',
                'type' => 'url',
                'group' => 'social',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'social_youtube',
                'value' => 'https://www.youtube.com/@rshamori',
                'type' => 'url',
                'group' => 'social',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'social_facebook',
                'value' => 'https://web.facebook.com/rshamori',
                'type' => 'url',
                'group' => 'social',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'social_tiktok',
                'value' => 'https://www.tiktok.com/@rshamori',
                'type' => 'url',
                'group' => 'social',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/RSHamori',
                'type' => 'url',
                'group' => 'social',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'phone_call_center',
                'value' => '1500816',
                'type' => 'text',
                'group' => 'phone',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'phone_general',
                'value' => '02604250888',
                'type' => 'text',
                'group' => 'phone',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'phone_igd',
                'value' => '02604250999',
                'type' => 'text',
                'group' => 'phone',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'phone_whatsapp',
                'value' => '6281111121705',
                'type' => 'text',
                'group' => 'phone',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-22 07:55:32',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'link_wa_appointment',
                'value' => 'https://wa.link/1uk9rl',
                'type' => 'url',
                'group' => 'phone',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'address',
                'value' => 'Jalan Raya Pagaden-Subang, Ds. Jabong Kec. Pagaden Kab. Subang Jawa Barat 41251',
                'type' => 'textarea',
                'group' => 'address',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-21 05:34:16',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'maps_embed_url',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.952647421076!2d107.7912886!3d-6.527665099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b9e5735393f%3A0x939a69f7b4c86392!2sRumah%20Sakit%20HAMORI!5e0!3m2!1sen!2sid!4v1782114819565!5m2!1sen!2s',
                'type' => 'textarea',
                'group' => 'address',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-22 07:55:32',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'maps_link',
                'value' => 'https://maps.app.goo.gl/oTbjEGX69Q17WoPf9',
                'type' => 'url',
                'group' => 'address',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-22 07:55:32',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'logo',
                'value' => 'settings/Xqa90aum66ybwHhYdJDBL48gslycI9xBMxaQP1w4.png',
                'type' => 'image',
                'group' => 'logo',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-26 03:42:33',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'logo_white',
                'value' => 'settings/VE9COf9dpow7FTIavqWSwrvT91PlUfNqEGkp7K56.png',
                'type' => 'image',
                'group' => 'logo',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-26 03:42:33',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'favicon',
                'value' => 'settings/Eq15gX3Mxjkv9jeeaD32jDH1RH8eLA5TWjnHBO6j.png',
                'type' => 'image',
                'group' => 'logo',
                'created_at' => '2026-06-21 05:34:16',
                'updated_at' => '2026-06-22 07:55:32',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'link_google_play',
                'value' => 'https://play.google.com/store/apps/details?id=com.terakorp.hamori&pcampaignid=web_share',
                'type' => 'text',
                'group' => 'general',
                'created_at' => '2026-06-26 03:38:52',
                'updated_at' => '2026-06-26 03:38:52',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'link_app_store',
                'value' => 'https://apps.apple.com/id/app/rs-hamori/id6751556718',
                'type' => 'text',
                'group' => 'general',
                'created_at' => '2026-06-26 03:38:52',
                'updated_at' => '2026-06-26 03:38:52',
            ),
        ));
        
        
    }
}