@extends('admin.layouts.app')

@section('title', 'SMTP Settings')
@section('page-title', 'SMTP Settings')

@section('header-actions')
    @if(!$smtpSetting)
        <a href="{{ route('admin.smtp-settings.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span class="font-medium">Configure SMTP</span>
        </a>
    @endif
@endsection

@section('content')
<div class="max-w-4xl">
    @if($smtpSetting)
        <div class="bg-card rounded-xl border border-border/50 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-foreground">Current SMTP Configuration</h3>
                <div class="flex gap-3">
                    <a href="{{ route('admin.smtp-settings.edit', $smtpSetting) }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                        <span class="font-medium">Edit Settings</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mail Mailer -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">Mail Mailer</label>
                    <p class="text-foreground">{{ $smtpSetting->mail_mailer }}</p>
                </div>

                <!-- Mail Host -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">Mail Host</label>
                    <p class="text-foreground">{{ $smtpSetting->mail_host }}</p>
                </div>

                <!-- Mail Port -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">Mail Port</label>
                    <p class="text-foreground">{{ $smtpSetting->mail_port }}</p>
                </div>

                <!-- Mail Username -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">Mail Username</label>
                    <p class="text-foreground">{{ $smtpSetting->mail_username }}</p>
                </div>

                <!-- Mail Password -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">Mail Password</label>
                    <p class="text-foreground">••••••••</p>
                </div>

                <!-- Mail Encryption -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">Mail Encryption</label>
                    <p class="text-foreground uppercase">{{ $smtpSetting->mail_encryption }}</p>
                </div>

                <!-- Mail From Address -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">From Address</label>
                    <p class="text-foreground">{{ $smtpSetting->mail_from_address }}</p>
                </div>

                <!-- Mail From Name -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-muted-foreground">From Name</label>
                    <p class="text-foreground">{{ $smtpSetting->mail_from_name }}</p>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="mt-6 pt-6 border-t border-border/50">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-muted-foreground mb-1">Created</p>
                        <p class="font-medium text-foreground">{{ $smtpSetting->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-muted-foreground mb-1">Last Updated</p>
                        <p class="font-medium text-foreground">{{ $smtpSetting->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-card rounded-xl border border-border/50 shadow-sm p-12 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="mail" class="w-8 h-8 text-primary"></i>
                </div>
                <h3 class="text-xl font-semibold text-foreground mb-2">No SMTP Settings Configured</h3>
                <p class="text-muted-foreground mb-6">Configure your SMTP settings to enable email functionality in your application.</p>
                <a href="{{ route('admin.smtp-settings.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span class="font-medium">Configure SMTP Now</span>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
