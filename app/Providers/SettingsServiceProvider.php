<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share settings with all views
        try {
            $settings = Setting::all()->pluck('value', 'key')->toArray();
            
            // Get image and ensure it has proper URL
            $image = $settings['image'] ?? '/img/qasim.jpg';
            // If image starts with / (local path), use asset() helper
            if (str_starts_with($image, '/')) {
                $image = asset($image);
            }
            
            // Create a settings object for easy access
            $webSettings = (object) [
                'site_name' => $settings['site_name'] ?? 'My Portfolio',
                'name' => $settings['name'] ?? 'User',
                'image' => $image,
                'site_tagline' => $settings['site_tagline'] ?? 'Full Stack Developer',
                'contact_email' => $settings['contact_email'] ?? '',
                'whatsapp' => $settings['whatsapp'] ?? '',
                'contact_phone' => $settings['contact_phone'] ?? '',
                'contact_address' => $settings['contact_address'] ?? '',
                'github_url' => $settings['github_url'] ?? '',
                'linkedin_url' => $settings['linkedin_url'] ?? '',
                'twitter_url' => $settings['twitter_url'] ?? '',
            ];
            
            View::share('webSettings', $webSettings);
            View::share('settings', $settings);
        } catch (\Exception $e) {
            // Handle case when settings table doesn't exist yet (during migration)
            View::share('webSettings', (object) []);
            View::share('settings', []);
        }
    }
}
