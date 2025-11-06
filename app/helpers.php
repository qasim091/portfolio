<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('web_settings')) {
    /**
     * Get all web settings as an object
     *
     * @return object
     */
    function web_settings()
    {
        static $webSettings = null;
        
        if ($webSettings === null) {
            $settings = Setting::all()->pluck('value', 'key')->toArray();
            
            $webSettings = (object) [
                'site_name' => $settings['site_name'] ?? 'My Portfolio',
                'site_tagline' => $settings['site_tagline'] ?? 'Full Stack Developer',
                'contact_email' => $settings['contact_email'] ?? '',
                'contact_phone' => $settings['contact_phone'] ?? '',
                'contact_address' => $settings['contact_address'] ?? '',
                'github_url' => $settings['github_url'] ?? '',
                'linkedin_url' => $settings['linkedin_url'] ?? '',
                'twitter_url' => $settings['twitter_url'] ?? '',
            ];
        }
        
        return $webSettings;
    }
}
