@extends('admin.layouts.app')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')

@section('header-actions')
    <a href="{{ route('admin.settings.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span class="font-medium">Add Setting</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 px-4 py-3 rounded-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Total Settings</p>
                    <p class="text-3xl font-bold">{{ $settings->total() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                    <i data-lucide="settings" class="w-6 h-6 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Contact Settings</p>
                    <p class="text-3xl font-bold">{{ $settings->filter(fn($s) => str_contains($s->key, 'contact'))->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-secondary/10 flex items-center justify-center">
                    <i data-lucide="mail" class="w-6 h-6 text-secondary"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Social Links</p>
                    <p class="text-3xl font-bold">{{ $settings->filter(fn($s) => str_contains($s->key, 'url'))->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                    <i data-lucide="share-2" class="w-6 h-6 text-accent"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Table -->
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Key
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Value
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Updated
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse($settings as $setting)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <code class="px-2 py-1 bg-muted rounded text-sm font-mono text-foreground">
                                        {{ $setting->key }}
                                    </code>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($setting->type === 'image' && $setting->value)
                                    <img src="{{ $setting->value }}" alt="{{ $setting->key }}" class="h-12 w-12 object-cover rounded border border-border">
                                @else
                                    <p class="text-sm text-foreground max-w-md truncate" title="{{ $setting->value }}">
                                        {{ $setting->value ?: '-' }}
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $setting->type === 'email' ? 'bg-blue-500/10 text-blue-600 dark:text-blue-400' : '' }}
                                    {{ $setting->type === 'phone' ? 'bg-green-500/10 text-green-600 dark:text-green-400' : '' }}
                                    {{ $setting->type === 'url' ? 'bg-purple-500/10 text-purple-600 dark:text-purple-400' : '' }}
                                    {{ $setting->type === 'text' ? 'bg-gray-500/10 text-gray-600 dark:text-gray-400' : '' }}
                                    {{ $setting->type === 'textarea' ? 'bg-orange-500/10 text-orange-600 dark:text-orange-400' : '' }}
                                    {{ $setting->type === 'number' ? 'bg-pink-500/10 text-pink-600 dark:text-pink-400' : '' }}
                                    {{ $setting->type === 'image' ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : '' }}">
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
                                    @elseif($setting->type === 'image')
                                        <i data-lucide="image" class="w-3 h-3"></i>
                                    @else
                                        <i data-lucide="type" class="w-3 h-3"></i>
                                    @endif
                                    {{ ucfirst($setting->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                {{ $setting->updated_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.settings.edit', $setting) }}" 
                                       class="p-2 rounded-lg hover:bg-muted transition-colors" 
                                       title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4 text-muted-foreground"></i>
                                    </a>
                                    <form action="{{ route('admin.settings.destroy', $setting) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this setting?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg hover:bg-red-500/10 transition-colors" 
                                                title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-600 dark:text-red-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-muted/50 flex items-center justify-center mb-4">
                                        <i data-lucide="settings" class="w-8 h-8 text-muted-foreground"></i>
                                    </div>
                                    <p class="text-muted-foreground mb-2">No settings found</p>
                                    <a href="{{ route('admin.settings.create') }}" 
                                       class="text-primary hover:text-primary/80 font-medium">
                                        Create your first setting
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($settings->hasPages())
            <div class="px-6 py-4 border-t border-border/50">
                {{ $settings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
