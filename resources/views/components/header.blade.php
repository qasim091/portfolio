@php
    $isHomePage = request()->routeIs('home');
@endphp

<header x-data="{ isScrolled: false, mobileMenuOpen: false }"
        @scroll.window="isScrolled = window.scrollY > 20"
        :class="{ 'bg-card/80 backdrop-blur-lg border-b border-border/50 shadow-lg': isScrolled, 'bg-transparent': !isScrolled }"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center font-bold text-primary-foreground shadow-glow">
                    AM
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Alex Morgan
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-1">
                @if($isHomePage)
                    <a href="#hero" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Home</a>
                    <a href="#projects" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Projects</a>
                    <a href="#about" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">About</a>
                    <a href="#contact" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Contact</a>
                @else
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Home</a>
                    <a href="{{ route('projects.index') }}" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">All Projects</a>
                @endif

                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode" class="p-2 rounded-md text-foreground hover:text-primary transition-colors">
                    <i x-show="!darkMode" data-lucide="sun" class="w-5 h-5"></i>
                    <i x-show="darkMode" data-lucide="moon" class="w-5 h-5"></i>
                </button>
            </nav>

            <!-- Mobile Menu Button & Theme Toggle -->
            <div class="flex items-center space-x-2 md:hidden">
                <button @click="darkMode = !darkMode" class="p-2 rounded-md text-foreground hover:text-primary transition-colors">
                    <i x-show="!darkMode" data-lucide="sun" class="w-5 h-5"></i>
                    <i x-show="darkMode" data-lucide="moon" class="w-5 h-5"></i>
                </button>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md text-foreground hover:text-primary transition-colors">
                    <i x-show="!mobileMenuOpen" data-lucide="menu" class="w-6 h-6"></i>
                    <i x-show="mobileMenuOpen" data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-card/95 backdrop-blur-lg border-b border-border/50">
        <nav class="container mx-auto px-4 py-4 flex flex-col space-y-2">
            @if($isHomePage)
                <a href="#hero" @click="mobileMenuOpen = false" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Home</a>
                <a href="#projects" @click="mobileMenuOpen = false" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Projects</a>
                <a href="#about" @click="mobileMenuOpen = false" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">About</a>
                <a href="#contact" @click="mobileMenuOpen = false" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Contact</a>
            @else
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">Home</a>
                <a href="{{ route('projects.index') }}" class="px-4 py-2 rounded-md text-foreground hover:text-primary transition-colors">All Projects</a>
            @endif
        </nav>
    </div>
    <style>
                    @keyframes orbit {
                        from {
                            transform: rotate(0deg);
                        }

                        to {
                            transform: rotate(360deg);
                        }
                    }

                    .animate-orbit {
                        animation: orbit 12s linear infinite;
                        transform-origin: center;
                    }

                    /* Icon hover effects */
                    .tech-icon {
                        transition: transform 0.3s ease, filter 0.3s ease;
                        pointer-events: auto;
                    }

                    .tech-icon:hover {
                        filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.8));
                        transform: scale(1.3) translateY(-5px) rotate(5deg);
                        z-index: 20;
                    }

                    /* Optional smooth glow for image */
                    .shadow-glow-lg {
                        box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
                    }

                    /* Make orbit pause slightly when hovered */
                    .animate-orbit:hover {
                        animation-play-state: paused;
                    }
                </style>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });
</script>
@endpush
