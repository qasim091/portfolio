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
    {{-- @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 px-4 py-3 rounded-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif --}}

    @php
        // Group settings by category
        $grouped = [
            'general' => [
                'title' => 'General Website Settings',
                'icon' => 'globe',
                'color' => 'blue',
                'keys' => ['site_name', 'site_tagline', 'meta_description']
            ],
            'profile' => [
                'title' => 'Profile & Documents',
                'icon' => 'user',
                'color' => 'purple',
                'keys' => ['name', 'image', 'resume_pdf', 'about_desc']
            ],
            'contact' => [
                'title' => 'Contact Information',
                'icon' => 'mail',
                'color' => 'green',
                'keys' => ['contact_email', 'whatsapp']
            ],
            'social' => [
                'title' => 'Social Media Links',
                'icon' => 'share-2',
                'color' => 'pink',
                'keys' => ['github_url', 'linkedin_url']
            ],
            'stats' => [
                'title' => 'Statistics & Metrics',
                'icon' => 'bar-chart',
                'color' => 'orange',
                'keys' => ['client', 'project', 'experience']
            ],
            'skills' => [
                'title' => 'Skills & Technologies',
                'icon' => 'code-2',
                'color' => 'indigo',
                'keys' => ['skills']
            ],
        ];
    @endphp

    <!-- Settings Groups -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($grouped as $groupKey => $group)
            @php
                $groupSettings = $settings->whereIn('key', $group['keys']);
            @endphp

            @if($groupSettings->count() > 0)
                <div class="bg-card rounded-xl border border-border/50 shadow-sm hover:shadow-md transition-all">
                    <!-- Card Header -->
                    <div class="p-6 border-b border-border/50">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-{{ $group['color'] }}-500/10 flex items-center justify-center">
                                <i data-lucide="{{ $group['icon'] }}" class="w-6 h-6 text-{{ $group['color'] }}-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-foreground">{{ $group['title'] }}</h3>
                                <p class="text-sm text-muted-foreground">{{ $groupSettings->count() }} setting(s)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 space-y-4">
                        @foreach($groupSettings as $setting)
                            <div class="group/item">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <label class="block text-sm font-medium text-foreground mb-2">
                                            {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                            <span class="ml-2 text-xs text-muted-foreground">({{ $setting->type }})</span>
                                        </label>

                                        @if($setting->type === 'image' && $setting->value)
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset($setting->value) }}" alt="{{ $setting->key }}"
                                                     class="h-20 w-20 object-cover rounded-lg border-2 border-border">
                                                <div class="text-sm text-muted-foreground">
                                                    <p class="font-medium text-foreground">Current Image</p>
                                                    <p class="text-xs">{{ basename($setting->value) }}</p>
                                                </div>
                                            </div>
                                        @elseif($setting->type === 'file' && $setting->value)
                                            <div class="flex items-center gap-3 p-3 bg-muted/30 rounded-lg">
                                                <i data-lucide="file" class="w-5 h-5 text-primary"></i>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-foreground">{{ basename($setting->value) }}</p>
                                                    <a href="{{ asset($setting->value) }}" download
                                                       class="text-xs text-primary hover:underline">
                                                        Download File
                                                    </a>
                                                </div>
                                            </div>
                                        @elseif($setting->type === 'json')
                                            @php
                                                $jsonData = json_decode($setting->value, true);
                                                $isSkills = !empty($jsonData) && isset($jsonData[0]['name']);
                                            @endphp
                                            @if($isSkills)
                                                <div class="text-sm text-muted-foreground">
                                                    <p class="font-medium text-foreground mb-1">{{ count($jsonData) }} Skills</p>
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach(array_slice($jsonData, 0, 3) as $skill)
                                                            <span class="px-2 py-1 bg-primary/10 text-primary rounded text-xs">
                                                                {{ $skill['name'] }}
                                                            </span>
                                                        @endforeach
                                                        @if(count($jsonData) > 3)
                                                            <span class="px-2 py-1 bg-muted text-muted-foreground rounded text-xs">
                                                                +{{ count($jsonData) - 3 }} more
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-sm text-muted-foreground">{{ count($jsonData) }} items</p>
                                            @endif
                                        @elseif($setting->type === 'textarea')
                                            <p class="text-sm text-foreground line-clamp-2">{{ $setting->value }}</p>
                                        @else
                                            <p class="text-sm text-foreground font-medium">{{ $setting->value ?: '-' }}</p>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.settings.edit', $setting) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg transition-all border border-blue-500/20 hover:border-blue-500/40">
                                            <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                            <span class="text-xs font-medium">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.settings.destroy', $setting) }}"
                                              method="POST"
                                              class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    onclick="showDeleteModal(this.closest('form'), '{{ ucwords(str_replace('_', ' ', $setting->key)) }}')"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-600 dark:text-red-400 rounded-lg transition-all border border-red-500/20 hover:border-red-500/40">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                <span class="text-xs font-medium">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Other Settings (Not in groups) -->
    @php
        $allGroupedKeys = collect($grouped)->pluck('keys')->flatten()->toArray();
        $otherSettings = $settings->whereNotIn('key', $allGroupedKeys);
    @endphp

    @if($otherSettings->count() > 0)
        <div class="bg-card rounded-xl border border-border/50 shadow-sm">
            <div class="p-6 border-b border-border/50">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-gray-500/10 flex items-center justify-center">
                        <i data-lucide="settings" class="w-6 h-6 text-gray-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-foreground">Other Settings</h3>
                        <p class="text-sm text-muted-foreground">{{ $otherSettings->count() }} setting(s)</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                @foreach($otherSettings as $setting)
                    <div class="group/item">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-medium text-foreground mb-2">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                    <span class="ml-2 text-xs text-muted-foreground">({{ $setting->type }})</span>
                                </label>
                                <p class="text-sm text-foreground">{{ $setting->value ?: '-' }}</p>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.settings.edit', $setting) }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-500/10 hover:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-lg transition-all border border-blue-500/20 hover:border-blue-500/40">
                                    <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                    <span class="text-xs font-medium">Edit</span>
                                </a>
                                <form action="{{ route('admin.settings.destroy', $setting) }}"
                                      method="POST"
                                      class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="showDeleteModal(this.closest('form'), '{{ ucwords(str_replace('_', ' ', $setting->key)) }}')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-600 dark:text-red-400 rounded-lg transition-all border border-red-500/20 hover:border-red-500/40">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        <span class="text-xs font-medium">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @include('admin.components.delete-modal', [
        'title' => 'Delete Setting',
        'message' => 'Are you sure you want to delete this setting?',
        'warning' => 'All data associated with this setting will be permanently removed.',
        'buttonText' => 'Delete Setting'
    ])
</div>

@endsection
