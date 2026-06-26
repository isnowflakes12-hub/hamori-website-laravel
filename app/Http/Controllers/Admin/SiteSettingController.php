<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.settings.general', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Social Media
            'social_instagram'   => 'nullable|url|max:500',
            'social_youtube'     => 'nullable|url|max:500',
            'social_facebook'    => 'nullable|url|max:500',
            'social_tiktok'      => 'nullable|url|max:500',
            'social_twitter'     => 'nullable|url|max:500',
            // Apps
            'link_google_play'   => 'nullable|url|max:500',
            'link_app_store'     => 'nullable|url|max:500',
            // Phone
            'phone_call_center'  => 'nullable|string|max:30',
            'phone_general'      => 'nullable|string|max:30',
            'phone_igd'          => 'nullable|string|max:30',
            'phone_whatsapp'     => 'nullable|string|max:30',
            'link_wa_appointment'=> 'nullable|url|max:500',
            // Address
            'address'            => 'nullable|string|max:1000',
            'maps_embed_url'     => 'nullable|string|max:2000',
            'maps_link'          => 'nullable|url|max:500',
            // Logo
            'logo'               => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'logo_white'         => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'favicon'            => 'nullable|image|mimes:ico,png,svg|max:1024',
        ]);

        // Text & URL settings
        $textKeys = [
            'social_instagram', 'social_youtube', 'social_facebook',
            'social_tiktok', 'social_twitter',
            'link_google_play', 'link_app_store',
            'phone_call_center', 'phone_general', 'phone_igd',
            'phone_whatsapp', 'link_wa_appointment',
            'address', 'maps_embed_url', 'maps_link',
        ];

        foreach ($textKeys as $key) {
            SiteSetting::set($key, $request->input($key));
        }

        // Image settings
        $imageKeys = ['logo', 'logo_white', 'favicon'];
        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('settings', 'public');
                SiteSetting::set($key, $path);
            }
        }

        SiteSetting::clearCache();

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
