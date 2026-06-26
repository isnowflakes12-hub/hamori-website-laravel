<?php


use App\Models\SiteSetting;

if (!function_exists('setting')) {
    /**
     * Get a site setting value by key.
     *
     * @param  string       $key
     * @param  string|null  $default
     * @return string|null
     */
    function setting(string $key, ?string $default = null): ?string
    {
        return SiteSetting::get($key, $default);
    }
}
