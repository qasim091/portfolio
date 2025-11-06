@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your admin panel')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-muted-foreground">Here's what's happening with your portfolio today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Categories -->
        <div class="stats-card">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <i data-lucide="folder" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
            </div>
            <h3 class="text-3xl font-bold mb-1 text-gray-900 dark:text-white">{{ $stats['total_categories'] }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Categories</p>
        </div>

        <!-- Total Projects -->
        <div class="stats-card">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                    <i data-lucide="briefcase" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Total</span>
            </div>
            <h3 class="text-3xl font-bold mb-1 text-gray-900 dark:text-white">{{ $stats['total_projects'] }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Projects</p>
        </div>

        <!-- Featured Projects -->
            {{-- <div class="bg-card rounded-lg border border-border p-6 hover:border-primary/50 transition-all hover:shadow-glow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-primary/10 rounded-lg">
                        <i data-lucide="star" class="w-6 h-6 text-primary"></i>
                    </div>
                    <span class="text-sm text-muted-foreground">Featured</span>
                </div>
                <h3 class="text-3xl font-bold mb-1">{{ $stats['featured_projects'] }}</h3>
                <p class="text-sm text-muted-foreground">Featured</p>
            </div> --}}

        <!-- Unread Messages -->
        {{-- <div class="bg-card rounded-lg border border-border p-6 hover:border-secondary/50 transition-all hover:shadow-glow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-secondary/10 rounded-lg">
                    <i data-lucide="mail" class="w-6 h-6 text-secondary"></i>
                </div>
                <span class="text-sm text-muted-foreground">Unread</span>
            </div>
            <h3 class="text-3xl font-bold mb-1">{{ $stats['unread_messages'] }}</h3>
            <p class="text-sm text-muted-foreground">Messages</p>
        </div> --}}
    </div>

    {{-- <div class="grid lg:grid-cols-2 gap-6">
        <!-- Recent Projects -->
        <div class="bg-card rounded-lg border border-border overflow-hidden">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <h3 class="text-lg font-bold">Recent Projects</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-sm text-primary hover:text-secondary transition-colors">
                    View All →
                </a>
            </div>
            <div class="divide-y divide-border">
                @forelse($recentProjects as $project)
                    <div class="p-4 hover:bg-muted/50 transition-colors">
                        <div class="flex items-start gap-3">
                            <img src="{{ $project->images[0] }}" alt="{{ $project->title }}" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium truncate">{{ $project->title }}</h4>
                                <p class="text-sm text-muted-foreground truncate">{{ $project->description }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="px-2 py-0.5 text-xs bg-primary/10 text-primary rounded">{{ $project->category }}</span>
                                    @if($project->is_featured)
                                        <span class="px-2 py-0.5 text-xs bg-secondary/10 text-secondary rounded">Featured</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 hover:bg-background rounded-md transition-colors">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-muted-foreground">
                        <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                        <p>No projects yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="bg-card rounded-lg border border-border overflow-hidden">
            <div class="p-6 border-b border-border flex items-center justify-between">
                <h3 class="text-lg font-bold">Recent Messages</h3>
                <a href="{{ route('admin.contact.messages') }}" class="text-sm text-primary hover:text-secondary transition-colors">
                    View All →
                </a>
            </div>
            <div class="divide-y divide-border">
                @forelse($recentMessages as $message)
                    <div class="p-4 hover:bg-muted/50 transition-colors {{ !$message->is_read ? 'bg-primary/5' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-sm font-bold text-primary-foreground flex-shrink-0">
                                {{ strtoupper(substr($message->name, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-medium truncate">{{ $message->name }}</h4>
                                    @if(!$message->is_read)
                                        <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                    @endif
                                </div>
                                <p class="text-sm text-muted-foreground truncate">{{ $message->subject }}</p>
                                <p class="text-xs text-muted-foreground mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-muted-foreground">
                        <i data-lucide="mail-open" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                        <p>No messages yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div> --}}

    <!-- Quick Actions -->
    <div class="mt-8">
        <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.projects.create') }}" class="admin-card text-center group hover:shadow-lg">
                <div class="p-6">
                    <div class="w-12 h-12 mx-auto mb-4 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="plus" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <p class="font-semibold text-gray-900 dark:text-white">Add Project</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Create a new project</p>
                </div>
            </a>

            <a href="{{ route('admin.categories.create') }}" class="admin-card text-center group hover:shadow-lg">
                <div class="p-6">
                    <div class="w-12 h-12 mx-auto mb-4 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="folder-plus" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <p class="font-semibold text-gray-900 dark:text-white">Add Category</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Create a new category</p>
                </div>
            </a>

            <a href="{{ route('home') }}" target="_blank" class="admin-card text-center group hover:shadow-lg">
                <div class="p-6">
                    <div class="w-12 h-12 mx-auto mb-4 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="external-link" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                    </div>
                    <p class="font-semibold text-gray-900 dark:text-white">View Site</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Visit your website</p>
                </div>
            </a>
        </div>
    </div>
@endsection
