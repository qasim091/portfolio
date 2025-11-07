@extends('admin.layouts.app')

@section('title', 'View Setting')
@section('page-title', 'Setting Details')

@section('header-actions')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.settings.edit', $setting) }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
            <i data-lucide="edit" class="w-4 h-4"></i>
            <span class="font-medium">Edit Setting</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span class="font-medium">Back to Settings</span>
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 px-6 py-4 border-b border-border/50">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-foreground">{{ $setting->key }}</h3>
                    <p class="text-sm text-muted-foreground mt-1">Setting configuration details</p>
                </div>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold 
                    {{ $setting->type === 'email' ? 'bg-blue-500/10 text-blue-600 dark:text-blue-400' : '' }}
                    {{ $setting->type === 'phone' ? 'bg-green-500/10 text-green-600 dark:text-green-400' : '' }}
                    {{ $setting->type === 'url' ? 'bg-purple-500/10 text-purple-600 dark:text-purple-400' : '' }}
                    {{ $setting->type === 'text' ? 'bg-gray-500/10 text-gray-600 dark:text-gray-400' : '' }}
                    {{ $setting->type === 'textarea' ? 'bg-orange-500/10 text-orange-600 dark:text-orange-400' : '' }}
                    {{ $setting->type === 'number' ? 'bg-pink-500/10 text-pink-600 dark:text-pink-400' : '' }}">
                    @if($setting->type === 'email')
                        <i data-lucide="mail" class="w-3 h-3"></i>
                    @elseif($setting->type === 'phone')
                        <i data-lucide="phone" class="w-3 h-3"></i>
                    @elseif($setting->type === 'url')
                        <i data-lucide="link" class="w-3 h-3"></i>
                    @elseif($setting->type === 'textarea')
                        <i data-lucide="align-left" class="w-3 h-3"></i>
                    @elseif($setting->type === 'number')
                        <i data-lucide="hash" class="w-3 h-3"></i>
                    @else
                        <i data-lucide="type" class="w-3 h-3"></i>
                    @endif
                    {{ ucfirst($setting->type) }}
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Key -->
            <div>
                <label class="block text-sm font-semibold text-muted-foreground mb-2">Setting Key</label>
                <code class="block px-4 py-3 bg-muted rounded-lg text-sm font-mono text-foreground">
                    {{ $setting->key }}
                </code>
            </div>

            <!-- Value -->
            <div>
                <label class="block text-sm font-semibold text-muted-foreground mb-2">Value</label>
                <div class="px-4 py-3 bg-muted rounded-lg text-sm text-foreground">
                    @if($setting->value)
                        @if($setting->type === 'url')
                            <a href="{{ $setting->value }}" target="_blank" class="text-primary hover:underline flex items-center gap-2">
                                {{ $setting->value }}
                                <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        @elseif($setting->type === 'email')
                            <a href="mailto:{{ $setting->value }}" class="text-primary hover:underline">
                                {{ $setting->value }}
                            </a>
                        @elseif($setting->type === 'phone')
                            <a href="tel:{{ $setting->value }}" class="text-primary hover:underline">
                                {{ $setting->value }}
                            </a>
                        @else
                            {{ $setting->value }}
                        @endif
                    @else
                        <span class="text-muted-foreground italic">No value set</span>
                    @endif
                </div>
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-semibold text-muted-foreground mb-2">Type</label>
                <div class="px-4 py-3 bg-muted rounded-lg text-sm text-foreground">
                    {{ ucfirst($setting->type) }}
                </div>
            </div>

            <!-- Metadata -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-muted-foreground mb-2">Created At</label>
                    <div class="px-4 py-3 bg-muted rounded-lg text-sm text-foreground">
                        {{ $setting->created_at->format('M d, Y H:i:s') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-muted-foreground mb-2">Last Updated</label>
                    <div class="px-4 py-3 bg-muted rounded-lg text-sm text-foreground">
                        {{ $setting->updated_at->format('M d, Y H:i:s') }}
                    </div>
                </div>
            </div>

            <!-- Usage Example -->
            <div class="bg-muted/50 rounded-lg p-4 border border-border/50">
                <p class="text-sm font-semibold text-foreground mb-2">Usage in Code:</p>
                <div class="space-y-2">
                    <div>
                        <p class="text-xs text-muted-foreground mb-1">Helper Function:</p>
                        <code class="block px-3 py-2 bg-background rounded text-xs font-mono text-foreground">
                            setting('{{ $setting->key }}')
                        </code>
                    </div>
                    <div>
                        <p class="text-xs text-muted-foreground mb-1">In Blade:</p>
                        <code class="block px-3 py-2 bg-background rounded text-xs font-mono text-foreground">
                            {{ '{{ $webSettings->' . $setting->key . ' }}' }}
                        </code>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="px-6 py-4 bg-muted/50 border-t border-border/50 flex items-center justify-between">
            <form action="{{ route('admin.settings.destroy', $setting) }}" 
                  method="POST"
                  class="delete-form">
                @csrf
                @method('DELETE')
                <button type="button" 
                        onclick="showDeleteModal(this.closest('form'), '{{ ucwords(str_replace('_', ' ', $setting->key)) }}')"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/10 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-500/20 transition-all">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    <span class="font-medium">Delete Setting</span>
                </button>
            </form>
            <a href="{{ route('admin.settings.edit', $setting) }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                <i data-lucide="edit" class="w-4 h-4"></i>
                <span class="font-medium">Edit Setting</span>
            </a>
        </div>
    </div>

    @include('admin.components.delete-modal', [
        'title' => 'Delete Setting',
        'message' => 'Are you sure you want to delete this setting?',
        'warning' => 'This setting will be permanently removed from the system.',
        'buttonText' => 'Delete Setting'
    ])
</div>
@endsection
