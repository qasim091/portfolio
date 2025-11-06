# Web Settings & Global Variables Usage Guide

## Overview
This application includes a comprehensive web settings system that allows you to manage site-wide configuration values dynamically through the database.

## Available Settings

The following settings are available by default:

- `site_name` - Website name (e.g., "Alex Morgan")
- `site_tagline` - Website tagline (e.g., "Full Stack Developer & UI/UX Designer")
- `contact_email` - Contact email address
- `contact_phone` - Contact phone number
- `contact_address` - Physical address
- `github_url` - GitHub profile URL
- `linkedin_url` - LinkedIn profile URL
- `twitter_url` - Twitter profile URL

## Usage in Controllers

### Method 1: Using the Helper Function (Recommended)

```php
use App\Models\Setting;

class YourController extends Controller
{
    public function index()
    {
        // Get a single setting
        $siteName = setting('site_name', 'Default Name');
        
        // Get all settings as an object
        $webSettings = web_settings();
        
        return view('your-view', compact('webSettings'));
    }
}
```

### Method 2: Using the Setting Model

```php
use App\Models\Setting;

class YourController extends Controller
{
    public function index()
    {
        // Get a single setting
        $email = Setting::get('contact_email', 'default@example.com');
        
        // Get all settings
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        
        return view('your-view', compact('settings'));
    }
}
```

### Method 3: Using the getWebSettings() Method (HomeController Pattern)

```php
protected function getWebSettings()
{
    $settings = Setting::all()->pluck('value', 'key')->toArray();
    
    return [
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

public function index()
{
    $webSettings = $this->getWebSettings();
    return view('home', compact('webSettings'));
}
```

## Usage in Blade Views

### Global Access (Available in ALL Views)

Thanks to the `SettingsServiceProvider`, settings are automatically shared with all views:

```blade
<!-- Access as object -->
<h1>{{ $webSettings->site_name }}</h1>
<p>{{ $webSettings->site_tagline }}</p>

<a href="mailto:{{ $webSettings->contact_email }}">Contact Us</a>
<a href="{{ $webSettings->github_url }}" target="_blank">GitHub</a>

<!-- Access as array -->
<p>{{ $settings['contact_phone'] ?? 'N/A' }}</p>
```

### Using Helper Functions in Views

```blade
<!-- Get a single setting -->
<title>{{ setting('site_name', 'My Site') }}</title>

<!-- Get all settings -->
@php
    $ws = web_settings();
@endphp

<footer>
    <p>{{ $ws->contact_email }}</p>
</footer>
```

## Usage in Routes

```php
use Illuminate\Support\Facades\Route;

Route::get('/contact', function () {
    $email = setting('contact_email');
    $phone = setting('contact_phone');
    
    return view('contact', compact('email', 'phone'));
});
```

## Managing Settings

### Create or Update a Setting

```php
// Using the Setting model
Setting::set('new_setting_key', 'value', 'text');

// Or using updateOrCreate
Setting::updateOrCreate(
    ['key' => 'site_name'],
    ['value' => 'New Site Name', 'type' => 'text']
);
```

### Get a Setting

```php
// Using helper
$value = setting('site_name', 'Default Value');

// Using model
$value = Setting::get('site_name', 'Default Value');
```

### Delete a Setting

```php
Setting::where('key', 'old_setting')->delete();
```

## Example: Complete Controller Implementation

```php
<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected function getWebSettings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        
        return [
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

    public function index()
    {
        $projects = Project::featured()->take(6)->get();
        $webSettings = $this->getWebSettings();
        
        return view('home', compact('projects', 'webSettings'));
    }
}
```

## Example: Blade Template Usage

```blade
<!DOCTYPE html>
<html>
<head>
    <title>{{ $webSettings->site_name }} - {{ $webSettings->site_tagline }}</title>
</head>
<body>
    <header>
        <h1>{{ $webSettings->site_name }}</h1>
        <p>{{ $webSettings->site_tagline }}</p>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer>
        <div class="contact-info">
            <p>Email: <a href="mailto:{{ $webSettings->contact_email }}">{{ $webSettings->contact_email }}</a></p>
            <p>Phone: {{ $webSettings->contact_phone }}</p>
            <p>Address: {{ $webSettings->contact_address }}</p>
        </div>
        
        <div class="social-links">
            @if($webSettings->github_url)
                <a href="{{ $webSettings->github_url }}" target="_blank">GitHub</a>
            @endif
            
            @if($webSettings->linkedin_url)
                <a href="{{ $webSettings->linkedin_url }}" target="_blank">LinkedIn</a>
            @endif
            
            @if($webSettings->twitter_url)
                <a href="{{ $webSettings->twitter_url }}" target="_blank">Twitter</a>
            @endif
        </div>
    </footer>
</body>
</html>
```

## Adding New Settings

To add new settings to your application:

1. **Add to Database** (via seeder or manually):
```php
Setting::create([
    'key' => 'new_setting_name',
    'value' => 'setting value',
    'type' => 'text'
]);
```

2. **Update SettingsServiceProvider** (optional, for global access):
```php
$webSettings = (object) [
    // ... existing settings
    'new_setting_name' => $settings['new_setting_name'] ?? 'default value',
];
```

3. **Update getWebSettings() method** in controllers if needed.

## Notes

- Settings are cached in the `SettingsServiceProvider` for performance
- All settings are available globally in views via `$webSettings` and `$settings`
- Use helper functions for cleaner code: `setting()` and `web_settings()`
- Settings can be managed through an admin panel (to be implemented)
- Default values are provided for all settings to prevent errors
