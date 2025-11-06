@extends('admin.layouts.app')

@section('title', 'View Category')
@section('page-title', $category->name)

@section('header-actions')
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.categories.edit', $category) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
            <i data-lucide="edit" class="w-4 h-4"></i>
            <span class="font-medium">Edit</span>
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span class="font-medium">Back</span>
        </a>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Category Details Card -->
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-border/50 bg-gradient-to-r from-primary/5 to-secondary/5">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-foreground mb-2">{{ $category->name }}</h2>
                    @if($category->description)
                        <p class="text-muted-foreground">{{ $category->description }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/10 text-primary rounded-lg text-sm font-medium">
                        <i data-lucide="hash" class="w-4 h-4"></i>
                        Order: {{ $category->order ?? 0 }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Slug -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Slug</p>
                <code class="px-3 py-1.5 bg-muted rounded-lg text-sm text-foreground">{{ $category->slug }}</code>
            </div>

            <!-- Created Date -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Created</p>
                <p class="text-foreground font-medium">{{ $category->created_at->format('M d, Y') }}</p>
                <p class="text-xs text-muted-foreground">{{ $category->created_at->diffForHumans() }}</p>
            </div>

            <!-- Updated Date -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Last Updated</p>
                <p class="text-foreground font-medium">{{ $category->updated_at->format('M d, Y') }}</p>
                <p class="text-xs text-muted-foreground">{{ $category->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-border/50 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Projects in this Category</h3>
                <p class="text-sm text-muted-foreground mt-1">{{ $category->projects->count() }} project(s)</p>
            </div>
            <a href="{{ route('admin.projects.create') }}?category_id={{ $category->id }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span class="font-medium">Add Project</span>
            </a>
        </div>

        @if($category->projects->count() > 0)
            <div class="divide-y divide-border/50">
                @foreach($category->projects as $project)
                    <div class="p-6 hover:bg-muted/30 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="text-lg font-semibold text-foreground">{{ $project->title }}</h4>
                                    @if($project->is_featured)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 rounded text-xs font-medium">
                                            <i data-lucide="star" class="w-3 h-3"></i>
                                            Featured
                                        </span>
                                    @endif
                                </div>

                                @if($project->description)
                                    <p class="text-muted-foreground mb-3">{{ Str::limit($project->description, 150) }}</p>
                                @endif

                                <div class="flex items-center gap-4 text-sm">
                                    <span class="inline-flex items-center gap-1 text-muted-foreground">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                        {{ $project->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-muted-foreground">
                                        <i data-lucide="arrow-up-down" class="w-4 h-4"></i>
                                        Order: {{ $project->order ?? 0 }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 ml-4">
                                @if($project->slug)
                                    <a href="{{ route('projects.show', $project->slug) }}"
                                       target="_blank"
                                       class="p-2 rounded-lg hover:bg-muted transition-colors"
                                       title="View on site">
                                        <i data-lucide="external-link" class="w-4 h-4 text-muted-foreground"></i>
                                    </a>
                                @endif
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                   class="p-2 rounded-lg hover:bg-muted transition-colors"
                                   title="Edit project">
                                    <i data-lucide="edit" class="w-4 h-4 text-muted-foreground"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-muted/50 flex items-center justify-center mb-4">
                        <i data-lucide="briefcase" class="w-8 h-8 text-muted-foreground"></i>
                    </div>
                    <p class="text-muted-foreground mb-4">No projects in this category yet</p>
                    <a href="{{ route('admin.projects.create') }}?category_id={{ $category->id }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span class="font-medium">Add First Project</span>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Danger Zone -->
    <div class="bg-card rounded-xl border border-red-500/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-red-500/50 bg-red-500/5">
            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Danger Zone</h3>
            <p class="text-sm text-muted-foreground mt-1">Irreversible actions</p>
        </div>
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h4 class="font-medium text-foreground mb-1">Delete this category</h4>
                    <p class="text-sm text-muted-foreground">
                        @if($category->projects->count() > 0)
                            Cannot delete this category because it has {{ $category->projects->count() }} project(s).
                            Please reassign or delete those projects first.
                        @else
                            Once you delete a category, there is no going back. Please be certain.
                        @endif
                    </p>
                </div>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                      onsubmit="return confirm('Are you absolutely sure? This action cannot be undone!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                            @if($category->projects->count() > 0) disabled @endif>
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span class="font-medium">Delete Category</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
