@extends('admin.layouts.app')

@section('title', 'View Project')
@section('page-title', $project->title)

@section('header-actions')
    <div class="flex items-center gap-2">
        @if($project->slug)
            <a href="{{ route('projects.show', $project->slug) }}"
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/90 transition-all">
                <i data-lucide="external-link" class="w-4 h-4"></i>
                <span class="font-medium">View Live</span>
            </a>
        @endif
        <a href="{{ route('admin.projects.edit', $project) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
            <i data-lucide="edit" class="w-4 h-4"></i>
            <span class="font-medium">Edit</span>
        </a>
        <a href="{{ route('admin.projects.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span class="font-medium">Back</span>
        </a>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Project Header -->
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-border/50 bg-gradient-to-r from-primary/5 to-secondary/5">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h2 class="text-2xl font-bold text-foreground">{{ $project->title }}</h2>
                        @if($project->is_featured)
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 rounded-lg text-sm font-medium">
                                <i data-lucide="star" class="w-4 h-4"></i>
                                Featured
                            </span>
                        @endif
                    </div>
                    <p class="text-muted-foreground">{{ $project->description }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Category -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Category</p>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-lg text-sm font-medium">
                    <i data-lucide="folder" class="w-4 h-4"></i>
                    {{ $project->category_name }}
                </span>
            </div>

            <!-- Order -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Display Order</p>
                <p class="text-foreground font-medium">{{ $project->order ?? 0 }}</p>
            </div>

            <!-- Created -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Created</p>
                <p class="text-foreground font-medium">{{ $project->created_at->format('M d, Y') }}</p>
                <p class="text-xs text-muted-foreground">{{ $project->created_at->diffForHumans() }}</p>
            </div>

            <!-- Updated -->
            <div>
                <p class="text-sm text-muted-foreground mb-2">Last Updated</p>
                <p class="text-foreground font-medium">{{ $project->updated_at->format('M d, Y') }}</p>
                <p class="text-xs text-muted-foreground">{{ $project->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Images Gallery -->
            @if($project->images && count($project->images) > 0)
                <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-border/50">
                        <h3 class="text-lg font-semibold">Project Gallery</h3>
                        <p class="text-sm text-muted-foreground mt-1">{{ count($project->images) }} image(s)</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($project->images as $image)
                                <div class="relative group">
                                    <img src="{{ $image }}"
                                         alt="{{ $project->title }}"
                                         class="w-full h-48 object-cover rounded-lg border border-border/50">
                                    <a href="{{ $image }}"
                                       target="_blank"
                                       class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                        <i data-lucide="maximize-2" class="w-8 h-8 text-white"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Detailed Description -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Detailed Description</h3>
                </div>
                <div class="p-6">
                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        <p class="text-foreground whitespace-pre-wrap">{{ $project->long_description }}</p>
                    </div>
                </div>
            </div>

            <!-- Key Features -->
            @if($project->features && count($project->features) > 0)
                <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-border/50">
                        <h3 class="text-lg font-semibold">Key Features</h3>
                        <p class="text-sm text-muted-foreground mt-1">{{ count($project->features) }} feature(s)</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @foreach($project->features as $feature)
                                <li class="flex items-start gap-3">
                                    <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-4 h-4 text-primary"></i>
                                    </div>
                                    <span class="text-foreground">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Challenges -->
            @if($project->challenges)
                <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-border/50">
                        <h3 class="text-lg font-semibold">Challenges Faced</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-foreground whitespace-pre-wrap">{{ $project->challenges }}</p>
                    </div>
                </div>
            @endif

            <!-- Outcome -->
            @if($project->outcome)
                <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-border/50">
                        <h3 class="text-lg font-semibold">Project Outcome</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-foreground whitespace-pre-wrap">{{ $project->outcome }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Technologies -->
            @if($project->tech && count($project->tech) > 0)
                <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-border/50">
                        <h3 class="text-lg font-semibold flex items-center gap-2">
                            <i data-lucide="code" class="w-5 h-5"></i>
                            Technologies
                        </h3>
                        <p class="text-sm text-muted-foreground mt-1">{{ count($project->tech) }} technologies</p>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tech as $tech)
                                <span class="inline-flex items-center px-3 py-1.5 bg-primary/10 text-primary rounded-lg text-sm font-medium">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Links -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold flex items-center gap-2">
                        <i data-lucide="link" class="w-5 h-5"></i>
                        Project Links
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    @if($project->live)
                        <a href="{{ $project->live }}"
                           target="_blank"
                           class="flex items-center gap-3 p-3 bg-green-500/10 hover:bg-green-500/20 rounded-lg transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center">
                                <i data-lucide="globe" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-foreground">Live Demo</p>
                                <p class="text-xs text-muted-foreground truncate">{{ $project->live }}</p>
                            </div>
                            <i data-lucide="external-link" class="w-4 h-4 text-muted-foreground group-hover:text-foreground"></i>
                        </a>
                    @endif

                    @if($project->github)
                        <a href="{{ $project->github }}"
                           target="_blank"
                           class="flex items-center gap-3 p-3 bg-gray-500/10 hover:bg-gray-500/20 rounded-lg transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-gray-500/20 flex items-center justify-center">
                                <i data-lucide="github" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-foreground">GitHub Repository</p>
                                <p class="text-xs text-muted-foreground truncate">{{ $project->github }}</p>
                            </div>
                            <i data-lucide="external-link" class="w-4 h-4 text-muted-foreground group-hover:text-foreground"></i>
                        </a>
                    @endif

                    @if(!$project->live && !$project->github)
                        <div class="text-center py-6">
                            <div class="w-12 h-12 rounded-full bg-muted/50 flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="link-2-off" class="w-6 h-6 text-muted-foreground"></i>
                            </div>
                            <p class="text-sm text-muted-foreground">No links available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Slug Info -->
            @if($project->slug)
                <div class="bg-muted/30 rounded-xl border border-border/50 p-4">
                    <h4 class="font-medium text-sm text-foreground mb-2">URL Slug</h4>
                    <code class="px-3 py-2 bg-muted rounded-lg text-sm text-foreground block break-all">
                        {{ $project->slug }}
                    </code>
                    <p class="text-xs text-muted-foreground mt-2">
                        Used in the project URL
                    </p>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.projects.edit', $project) }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                        <span class="font-medium">Edit Project</span>
                    </a>

                    @if($project->slug)
                        <a href="{{ route('projects.show', $project->slug) }}"
                           target="_blank"
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/90 transition-all">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                            <span class="font-medium">View on Site</span>
                        </a>
                    @endif

                    <form action="{{ route('admin.projects.destroy', $project) }}"
                          method="POST"
                          onsubmit="return confirm('Are you absolutely sure? This action cannot be undone!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500/10 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-500/20 transition-all">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            <span class="font-medium">Delete Project</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
