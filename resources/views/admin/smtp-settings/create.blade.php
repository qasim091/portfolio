@extends('admin.layouts.app')

@section('title', 'Configure SMTP')
@section('page-title', 'Configure SMTP Settings')

@section('header-actions')
    <a href="{{ route('admin.smtp-settings.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span class="font-medium">Back</span>
    </a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-card rounded-xl border border-border/50 shadow-sm p-6">
        <form action="{{ route('admin.smtp-settings.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Mail Mailer -->
            <div>
                <label for="mail_mailer" class="block text-sm font-semibold text-foreground mb-2">
                    Mail Mailer <span class="text-red-500">*</span>
                </label>
                <select id="mail_mailer" 
                        name="mail_mailer" 
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_mailer') border-red-500 @enderror"
                        required>
                    <option value="smtp" {{ old('mail_mailer', 'smtp') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                </select>
                @error('mail_mailer')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail Host -->
            <div>
                <label for="mail_host" class="block text-sm font-semibold text-foreground mb-2">
                    Mail Host <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="mail_host" 
                       name="mail_host" 
                       value="{{ old('mail_host') }}"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_host') border-red-500 @enderror"
                       placeholder="e.g., smtp.gmail.com"
                       required>
                <p class="mt-1 text-sm text-muted-foreground">SMTP server hostname</p>
                @error('mail_host')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail Port -->
            <div>
                <label for="mail_port" class="block text-sm font-semibold text-foreground mb-2">
                    Mail Port <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       id="mail_port" 
                       name="mail_port" 
                       value="{{ old('mail_port', 587) }}"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_port') border-red-500 @enderror"
                       placeholder="587"
                       required>
                <p class="mt-1 text-sm text-muted-foreground">Common ports: 587 (TLS), 465 (SSL), 25</p>
                @error('mail_port')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail Username -->
            <div>
                <label for="mail_username" class="block text-sm font-semibold text-foreground mb-2">
                    Mail Username <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="mail_username" 
                       name="mail_username" 
                       value="{{ old('mail_username') }}"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_username') border-red-500 @enderror"
                       placeholder="your-email@example.com"
                       required>
                @error('mail_username')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail Password -->
            <div>
                <label for="mail_password" class="block text-sm font-semibold text-foreground mb-2">
                    Mail Password <span class="text-red-500">*</span>
                </label>
                <input type="password" 
                       id="mail_password" 
                       name="mail_password" 
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_password') border-red-500 @enderror"
                       placeholder="••••••••"
                       required>
                <p class="mt-1 text-sm text-muted-foreground">Your SMTP password or app-specific password</p>
                @error('mail_password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail Encryption -->
            <div>
                <label for="mail_encryption" class="block text-sm font-semibold text-foreground mb-2">
                    Mail Encryption <span class="text-red-500">*</span>
                </label>
                <select id="mail_encryption" 
                        name="mail_encryption" 
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_encryption') border-red-500 @enderror"
                        required>
                    <option value="tls" {{ old('mail_encryption', 'tls') === 'tls' ? 'selected' : '' }}>TLS</option>
                    <option value="ssl" {{ old('mail_encryption') === 'ssl' ? 'selected' : '' }}>SSL</option>
                </select>
                <p class="mt-1 text-sm text-muted-foreground">Use TLS for port 587, SSL for port 465</p>
                @error('mail_encryption')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail From Address -->
            <div>
                <label for="mail_from_address" class="block text-sm font-semibold text-foreground mb-2">
                    From Address <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="mail_from_address" 
                       name="mail_from_address" 
                       value="{{ old('mail_from_address') }}"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_from_address') border-red-500 @enderror"
                       placeholder="noreply@example.com"
                       required>
                <p class="mt-1 text-sm text-muted-foreground">Email address that will appear as sender</p>
                @error('mail_from_address')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mail From Name -->
            <div>
                <label for="mail_from_name" class="block text-sm font-semibold text-foreground mb-2">
                    From Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="mail_from_name" 
                       name="mail_from_name" 
                       value="{{ old('mail_from_name') }}"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('mail_from_name') border-red-500 @enderror"
                       placeholder="Your Company Name"
                       required>
                <p class="mt-1 text-sm text-muted-foreground">Name that will appear as sender</p>
                @error('mail_from_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                <div class="flex gap-3">
                    <i data-lucide="info" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5"></i>
                    <div class="text-sm text-foreground">
                        <p class="font-semibold mb-1">Important Notes:</p>
                        <ul class="list-disc list-inside space-y-1 text-muted-foreground">
                            <li>These settings will be saved to your database and .env file</li>
                            <li>For Gmail, use an app-specific password instead of your regular password</li>
                            <li>Make sure your SMTP provider allows connections from your server</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-border/50">
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span class="font-medium">Save Settings</span>
                </button>
                <a href="{{ route('admin.smtp-settings.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
                    <span class="font-medium">Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
