<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class SmtpSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smtpSetting = SmtpSetting::first();
        return view('admin.smtp-settings.index', compact('smtpSetting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if settings already exist
        if (SmtpSetting::exists()) {
            return redirect()->route('admin.smtp-settings.index')
                ->with('info', 'SMTP settings already exist. Please edit the existing settings.');
        }
        return view('admin.smtp-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'required|in:tls,ssl',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        $smtpSetting = SmtpSetting::create($validated);
        
        // Update .env and config
        $this->updateEnvAndConfig($validated);

        return redirect()->route('admin.smtp-settings.index')
            ->with('success', 'SMTP settings created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SmtpSetting $smtpSetting)
    {
        return view('admin.smtp-settings.show', compact('smtpSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SmtpSetting $smtpSetting)
    {
        return view('admin.smtp-settings.edit', compact('smtpSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SmtpSetting $smtpSetting)
    {
        $validated = $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'required|in:tls,ssl',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        // If password is empty, keep the old one
        if (empty($validated['mail_password'])) {
            unset($validated['mail_password']);
        }

        $smtpSetting->update($validated);
        
        // Update .env and config
        $this->updateEnvAndConfig($smtpSetting->fresh()->toArray());

        return redirect()->route('admin.smtp-settings.index')
            ->with('success', 'SMTP settings updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SmtpSetting $smtpSetting)
    {
        $smtpSetting->delete();
        return redirect()->route('admin.smtp-settings.index')
            ->with('success', 'SMTP settings deleted successfully!');
    }

    /**
     * Update .env file and config
     */
    private function updateEnvAndConfig(array $data)
    {
        $envPath = base_path('.env');
        
        if (file_exists($envPath)) {
            $envContent = file_get_contents($envPath);
            
            $envVariables = [
                'MAIL_MAILER' => $data['mail_mailer'],
                'MAIL_HOST' => $data['mail_host'],
                'MAIL_PORT' => $data['mail_port'],
                'MAIL_USERNAME' => $data['mail_username'],
                'MAIL_PASSWORD' => $data['mail_password'],
                'MAIL_ENCRYPTION' => $data['mail_encryption'],
                'MAIL_FROM_ADDRESS' => $data['mail_from_address'],
                'MAIL_FROM_NAME' => '"' . $data['mail_from_name'] . '"',
            ];
            
            foreach ($envVariables as $key => $value) {
                // Escape special characters in value
                $escapedValue = $this->escapeEnvValue($value);
                
                // Check if key exists in .env
                if (preg_match("/^{$key}=.*/m", $envContent)) {
                    // Update existing key
                    $envContent = preg_replace(
                        "/^{$key}=.*/m",
                        "{$key}={$escapedValue}",
                        $envContent
                    );
                } else {
                    // Add new key
                    $envContent .= "\n{$key}={$escapedValue}";
                }
            }
            
            file_put_contents($envPath, $envContent);
        }
        
        // Update runtime config
        Config::set('mail.mailers.smtp.host', $data['mail_host']);
        Config::set('mail.mailers.smtp.port', $data['mail_port']);
        Config::set('mail.mailers.smtp.username', $data['mail_username']);
        Config::set('mail.mailers.smtp.password', $data['mail_password']);
        Config::set('mail.mailers.smtp.encryption', $data['mail_encryption']);
        Config::set('mail.from.address', $data['mail_from_address']);
        Config::set('mail.from.name', $data['mail_from_name']);
        
        // Clear config cache
        Artisan::call('config:clear');
    }

    /**
     * Escape special characters for .env values
     */
    private function escapeEnvValue($value)
    {
        // If value contains spaces or special characters, wrap in quotes
        if (preg_match('/\s/', $value) && !preg_match('/^".*"$/', $value)) {
            return '"' . str_replace('"', '\\"', $value) . '"';
        }
        return $value;
    }
}
