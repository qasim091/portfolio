@extends('layouts.portfolio')

@section('title', $project->title . ' - Alex Morgan')

@section('content')
    <!-- Project Header -->
    <section class="relative pt-32 pb-16 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-radial opacity-30"></div>
        <div class="container mx-auto relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('projects.index') }}" 
                       class="inline-flex items-center text-muted-foreground hover:text-primary transition-colors">
                        <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                        Back to Projects
                    </a>
                    <span class="text-muted-foreground">/</span>
                    <span class="px-3 py-1 text-sm bg-primary/10 text-primary rounded-md">{{ $project->category_name }}</span>
                    @if($project->is_featured)
                        <span class="px-3 py-1 text-sm bg-secondary/10 text-secondary rounded-md">Featured</span>
                    @endif
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                    {{ $project->title }}
                </h1>
                <p class="text-xl text-muted-foreground mb-8">
                    {{ $project->description }}
                </p>

                <div class="flex flex-wrap gap-4">
                    @if($project->github != '#')
                        <a href="{{ $project->github }}" 
                           target="_blank"
                           class="inline-flex items-center px-6 py-3 bg-card border border-border hover:border-primary hover:bg-primary/10 rounded-md transition-colors">
                            <i data-lucide="github" class="mr-2 w-5 h-5"></i>
                            View Code
                        </a>
                    @endif
                    @if($project->live != '#')
                        <a href="{{ $project->live }}" 
                           target="_blank"
                           class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md shadow-glow transition-colors">
                            <i data-lucide="external-link" class="mr-2 w-5 h-5"></i>
                            Live Demo
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Project Images Gallery -->
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <div class="max-w-6xl mx-auto">
                <div x-data="{ activeImage: 0 }" class="space-y-6">
                    <!-- Main Image -->
                    <div class="relative aspect-video rounded-lg overflow-hidden border border-border shadow-2xl">
                        @foreach($project->images as $index => $image)
                            <img x-show="activeImage === {{ $index }}" 
                                 src="{{ $image }}" 
                                 alt="{{ $project->title }} - Image {{ $index + 1 }}" 
                                 class="w-full h-full object-cover"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100">
                        @endforeach
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($project->images as $index => $image)
                            <button @click="activeImage = {{ $index }}" 
                                    :class="{ 'border-primary ring-2 ring-primary': activeImage === {{ $index }} }"
                                    class="relative aspect-video rounded-lg overflow-hidden border-2 border-border hover:border-primary/50 transition-all cursor-pointer">
                                <img src="{{ $image }}" 
                                     alt="Thumbnail {{ $index + 1 }}" 
                                     class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Details -->
    <section class="py-16 px-4 bg-card/30">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-3 gap-8 mb-12">
                    <!-- Tech Stack -->
                    <div class="md:col-span-2">
                        <h2 class="text-2xl font-bold mb-4">About This Project</h2>
                        <p class="text-muted-foreground text-lg leading-relaxed mb-6">
                            {{ $project->long_description }}
                        </p>
                    </div>

                    <!-- Tech Stack Sidebar -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Tech Stack</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tech as $tech)
                                <span class="px-3 py-2 bg-primary/10 text-primary rounded-md text-sm">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($project->features)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold mb-6">Key Features</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($project->features as $feature)
                                <div class="flex items-start gap-3 p-4 bg-card rounded-lg border border-border">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center mt-0.5">
                                        <i data-lucide="check" class="w-4 h-4 text-primary"></i>
                                    </div>
                                    <span class="text-foreground">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($project->challenges)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold mb-4">Challenges</h2>
                        <div class="p-6 bg-card rounded-lg border border-border border-l-4 border-l-secondary">
                            <p class="text-muted-foreground leading-relaxed">{{ $project->challenges }}</p>
                        </div>
                    </div>
                @endif

                @if($project->outcome)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold mb-4">Outcome</h2>
                        <div class="p-6 bg-card rounded-lg border border-border border-l-4 border-l-primary">
                            <p class="text-muted-foreground leading-relaxed">{{ $project->outcome }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Projects -->
    @if($relatedProjects->count() > 0)
        <section class="py-16 px-4">
            <div class="container mx-auto">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold mb-8 text-center">Related Projects</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($relatedProjects as $related)
                            <div class="group relative bg-card rounded-lg border border-border/50 overflow-hidden hover:border-primary/50 transition-all duration-300 hover:shadow-glow">
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ $related->images[0] }}" 
                                         alt="{{ $related->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="p-6 space-y-4">
                                    <h3 class="text-xl font-bold text-foreground group-hover:text-primary transition-colors">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-muted-foreground line-clamp-2">{{ $related->description }}</p>
                                    <a href="{{ route('projects.show', $related->slug) }}" 
                                       class="inline-flex items-center text-sm text-primary hover:text-secondary transition-colors">
                                        View Details
                                        <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 px-4 bg-gradient-to-r from-primary/10 to-secondary/10">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Interested in working together?</h2>
            <p class="text-muted-foreground mb-8">Let's create something amazing</p>
            <a href="{{ route('home') }}#contact" 
               class="inline-flex items-center px-8 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md shadow-glow transition-colors">
                <i data-lucide="mail" class="mr-2 w-5 h-5"></i>
                Get In Touch
            </a>
        </div>
    </section>
@endsection
