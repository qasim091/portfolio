@extends('layouts.portfolio')

@section('title', 'All Projects - Alex Morgan')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-16 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-radial opacity-30"></div>
        <div class="container mx-auto relative z-10">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-primary via-secondary to-primary bg-clip-text text-transparent animate-fade-in">
                All Projects
            </h1>
            <p class="text-xl text-muted-foreground max-w-2xl">
                Explore my complete portfolio of innovative solutions and creative implementations
            </p>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="sticky top-16 z-40 bg-background/80 backdrop-blur-lg border-b border-border/50 py-6 px-4">
        <div class="container mx-auto">
            <form method="GET" action="{{ route('projects.index') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1 relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground"></i>
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Search projects..."
                           class="w-full pl-10 pr-10 py-3 bg-card/50 border border-border/50 rounded-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
                    @if($search)
                        <a href="{{ route('projects.index') }}"
                           class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>

                <!-- Category Filter -->
                <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0">
                    <a href="{{ route('projects.index', ['category' => 'All', 'search' => $search]) }}"
                       class="px-4 py-2 text-sm whitespace-nowrap rounded-md transition-all {{ $category === 'All' ? 'bg-primary text-primary-foreground shadow-glow' : 'bg-card border border-border/50 hover:border-primary/50' }}">
                        All
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('projects.index', ['category' => $cat->id, 'search' => $search]) }}"
                           class="px-4 py-2 text-sm whitespace-nowrap rounded-md transition-all {{ $category == $cat->id ? 'bg-primary text-primary-foreground shadow-glow' : 'bg-card border border-border/50 hover:border-primary/50' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </form>

            <!-- Results Count -->
            <p class="text-sm text-muted-foreground mt-4">
                {{ $projects->total() }} {{ Str::plural('project', $projects->total()) }} found
            </p>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            @if($projects->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="group relative bg-card rounded-lg border border-border/50 overflow-hidden hover:border-primary/50 transition-all duration-300 hover:shadow-glow animate-fade-in">
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ $project->images[0] }}"
                                     alt="{{ $project->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 text-xs bg-primary/10 text-primary rounded-md">{{ $project->category_name }}</span>
                                    @if($project->is_featured)
                                        <span class="px-2 py-1 text-xs bg-secondary/10 text-secondary rounded-md">Featured</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-foreground group-hover:text-primary transition-colors">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-muted-foreground line-clamp-2">{{ $project->description }}</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(array_slice($project->tech, 0, 4) as $tech)
                                        <span class="px-2 py-1 text-xs bg-muted text-muted-foreground rounded-md">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($project->tech) > 4)
                                        <span class="px-2 py-1 text-xs bg-muted text-muted-foreground rounded-md">+{{ count($project->tech) - 4 }}</span>
                                    @endif
                                </div>
                                <div class="flex gap-3 pt-2">
                                    <a href="{{ route('projects.show', $project->slug) }}"
                                       class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md transition-colors text-sm">
                                        View Details
                                        <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                                    </a>
                                    @if($project->github != '#')
                                        <a href="{{ $project->github }}"
                                           target="_blank"
                                           class="inline-flex items-center justify-center px-4 py-2 border border-border hover:border-primary hover:bg-primary/10 rounded-md transition-colors">
                                            <i data-lucide="github" class="w-4 h-4"></i>
                                        </a>
                                    @endif
                                    @if($project->live != '#')
                                        <a href="{{ $project->live }}"
                                           target="_blank"
                                           class="inline-flex items-center justify-center px-4 py-2 border border-border hover:border-primary hover:bg-primary/10 rounded-md transition-colors">
                                            <i data-lucide="external-link" class="w-4 h-4"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <i data-lucide="search-x" class="w-16 h-16 text-muted-foreground mx-auto mb-4"></i>
                    <p class="text-2xl text-muted-foreground mb-2">No projects found</p>
                    <p class="text-sm text-muted-foreground">
                        Try adjusting your search or filters
                    </p>
                    <a href="{{ route('projects.index') }}"
                       class="inline-flex items-center mt-6 px-6 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md shadow-glow transition-colors">
                        Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
