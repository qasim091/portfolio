@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('header-actions')
    <a href="{{ route('admin.projects.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span class="font-medium">Add Project</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Total Projects</p>
                    <p class="text-3xl font-bold">{{ $projects->total() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                    <i data-lucide="briefcase" class="w-6 h-6 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Featured</p>
                    <p class="text-3xl font-bold">{{ $projects->where('is_featured', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-yellow-500/10 flex items-center justify-center">
                    <i data-lucide="star" class="w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Categories</p>
                    <p class="text-3xl font-bold">{{ $projects->pluck('category_id')->unique()->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-secondary/10 flex items-center justify-center">
                    <i data-lucide="folder" class="w-6 h-6 text-secondary"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">This Month</p>
                    <p class="text-3xl font-bold">{{ $projects->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                    <i data-lucide="calendar" class="w-6 h-6 text-accent"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Project</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Technologies</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Created</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-muted-foreground uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse($projects as $project)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary font-semibold text-sm">
                                    {{ $project->order ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    @if($project->images && count($project->images) > 0)
                                        <img src="{{ $project->images[0] }}" alt="{{ $project->title }}"
                                             class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-muted flex items-center justify-center">
                                            <i data-lucide="image" class="w-6 h-6 text-muted-foreground"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-foreground truncate">{{ $project->title }}</p>
                                        <p class="text-sm text-muted-foreground line-clamp-1">{{ $project->description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-600 dark:text-blue-400">
                                    <i data-lucide="folder" class="w-3 h-3"></i>
                                    {{ $project->category_name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @if($project->tech)
                                        @foreach(array_slice($project->tech, 0, 3) as $tech)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-muted text-muted-foreground">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                        @if(count($project->tech) > 3)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-muted text-muted-foreground">
                                                +{{ count($project->tech) - 3 }}
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    @if($project->is_featured)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-600 dark:text-yellow-400">
                                            <i data-lucide="star" class="w-3 h-3"></i>
                                            Featured
                                        </span>
                                    @endif
                                    @if($project->live)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-500/10 text-green-600 dark:text-green-400">
                                            <i data-lucide="globe" class="w-3 h-3"></i>
                                            Live
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                {{ $project->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($project->slug)
                                        <a href="{{ route('projects.show', $project->slug) }}"
                                           target="_blank"
                                           class="p-2 rounded-lg hover:bg-muted transition-colors"
                                           title="View on site">
                                            <i data-lucide="external-link" class="w-4 h-4 text-muted-foreground"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.projects.show', $project) }}"
                                       class="p-2 rounded-lg hover:bg-muted transition-colors"
                                       title="View">
                                        <i data-lucide="eye" class="w-4 h-4 text-muted-foreground"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                       class="p-2 rounded-lg hover:bg-muted transition-colors"
                                       title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4 text-muted-foreground"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-muted/50 flex items-center justify-center mb-4">
                                        <i data-lucide="briefcase" class="w-8 h-8 text-muted-foreground"></i>
                                    </div>
                                    <p class="text-muted-foreground mb-2">No projects found</p>
                                    <a href="{{ route('admin.projects.create') }}"
                                       class="text-primary hover:text-primary/80 font-medium">
                                        Create your first project
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
            <div class="px-6 py-4 border-t border-border/50">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
