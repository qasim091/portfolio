# Web Settings - Quick Reference Card

## 🚀 Quick Start

### In Controllers
```php
use App\Models\Setting;

// Get single setting
$value = setting('site_name', 'Default');

// Get all settings
$webSettings = web_settings();

// Using Setting model
$email = Setting::get('contact_email');
```

### In Blade Views
```blade
<!-- Automatically available everywhere -->
{{ $webSettings->site_name }}
{{ $webSettings->contact_email }}

<!-- Or as array -->
{{ $settings['site_name'] }}

<!-- Using helper -->
{{ setting('site_name') }}
```

## 📋 Available Settings

```php
$webSettings->site_name         // "Alex Morgan"
$webSettings->site_tagline      // "Full Stack Developer"
$webSettings->contact_email     // "alex@example.com"
$webSettings->contact_phone     // "+1 (234) 567-890"
$webSettings->contact_address   // "123 Tech Street..."
$webSettings->github_url        // GitHub URL
$webSettings->linkedin_url      // LinkedIn URL
$webSettings->twitter_url       // Twitter URL
```

## 🔧 Common Patterns

### Controller Pattern
```php
class YourController extends Controller
{
    protected function getWebSettings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return [
            'site_name' => $settings['site_name'] ?? 'Default',
            // ... other settings
        ];
    }

    public function index()
    {
        $webSettings = $this->getWebSettings();
        return view('your-view', compact('webSettings'));
    }
}
```

### View Pattern
```blade
<!-- Footer with social links -->
@if(!empty($webSettings->github_url))
    <a href="{{ $webSettings->github_url }}">GitHub</a>
@endif

<!-- Email link -->
<a href="mailto:{{ $webSettings->contact_email }}">
    {{ $webSettings->contact_email }}
</a>

<!-- Page title -->
<title>{{ $webSettings->site_name }} - {{ $webSettings->site_tagline }}</title>
```

## ➕ Add New Setting

### Via Code
```php
Setting::set('new_key', 'value', 'text');
```

### Via Seeder
```php
// database/seeders/SettingSeeder.php
['key' => 'new_key', 'value' => 'value', 'type' => 'text']
```

### Update Provider (for global access)
```php
// app/Providers/SettingsServiceProvider.php
$webSettings = (object) [
    // ... existing
    'new_key' => $settings['new_key'] ?? 'default',
];
```

## 📦 Files Modified

✅ `app/Providers/SettingsServiceProvider.php` - Global sharing  
✅ `app/helpers.php` - Helper functions  
✅ `app/Http/Controllers/HomeController.php` - Example usage  
✅ `resources/views/components/footer.blade.php` - Dynamic footer  
✅ `composer.json` - Autoload helpers  

## 🎯 Key Features

- ✅ **Global Access**: Available in all views automatically
- ✅ **Helper Functions**: `setting()` and `web_settings()`
- ✅ **Type-Safe**: Settings have types (text, email, phone, etc.)
- ✅ **Default Values**: Fallback values prevent errors
- ✅ **Database-Driven**: Easy to update without code changes

## 📚 Full Documentation

See `WEB_SETTINGS_USAGE.md` for complete documentation with examples.
