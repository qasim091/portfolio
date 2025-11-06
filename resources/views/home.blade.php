@extends('layouts.portfolio')

@section('title', 'Qasim Mehmood - Full Stack Developer & UI/UX Designer')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
        <!-- Particle Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-radial opacity-30"></div>
        </div>

        <div class="container mx-auto px-4 z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Left: Resume Info -->
                <div class="flex-1 space-y-8 animate-fade-in">
                    <!-- Profile Image -->
                    <div class="space-y-4">
                        <h1 class="text-5xl md:text-7xl font-bold">
                            <span class="block text-foreground">Hi, I'm</span>
                            <span
                                class="block bg-gradient-to-r from-primary via-secondary to-primary bg-clip-text text-transparent">
                                {{ $webSettings->name }}
                            </span>
                        </h1>

                        <!-- Animated Role -->
                        <p class="text-2xl md:text-3xl text-primary font-light">
                            {{ $webSettings->site_tagline }}
                        </p>

                        <p class="text-lg text-muted-foreground max-w-xl">
                            {{ $webSettings->meta_description }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="#projects"
                            class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md shadow-glow transition-colors">
                            View Projects
                        </a>
                        <a href="{{ asset('storage/Qasim-Mehmood-CV.pdf') }}"
                            class="inline-flex items-center px-6 py-3 border border-primary/50 hover:bg-primary/10 rounded-md transition-colors">
                            <i data-lucide="file-text" class="mr-2 h-5 w-5"></i>
                            Download CV
                        </a>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ $webSettings->github_url }}"
                            class="w-12 h-12 rounded-full border border-primary/30 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                            <i data-lucide="github" class="w-5 h-5 text-primary"></i>
                        </a>
                        <a href="{{ $webSettings->linkedin_url }}"
                            class="w-12 h-12 rounded-full border border-primary/30 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                            <i data-lucide="linkedin" class="w-5 h-5 text-primary"></i>
                        </a>
                        <a href="mailto:{{ $webSettings->contact_email }}"
                            class="w-12 h-12 rounded-full border border-primary/30 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                            <i data-lucide="mail" class="w-5 h-5 text-primary"></i>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $webSettings->whatsapp) }}"
                            class="w-12 h-12 rounded-full border border-primary/30 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors"
                            target="_blank" rel="noopener noreferrer">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Visual -->
                <!-- Add this inside your hero or profile section -->
                <div class="flex-1 hidden lg:flex items-center justify-center animate-scale-in">
                    <div class="relative w-full max-w-md aspect-square">
                        <!-- Glowing background -->
                        <div
                            class="absolute inset-0 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 blur-3xl animate-glow-pulse">
                        </div>

                        <!-- Main circular frame -->
                        <div
                            class="relative w-full h-full rounded-full border-2 border-primary/30 flex items-center justify-center backdrop-blur-sm">

                            <!-- Profile Image -->
                            <img src="{{ $webSettings->image }}" alt="{{ $webSettings->name ?? 'Profile Image' }}"
                                class="w-48 h-48 rounded-full object-cover mx-auto border-4 border-primary shadow-glow-lg transition-transform hover:scale-105 duration-300 z-10">

                            <!-- Floating Tech Icons -->
                            <div
                                class="absolute inset-0 animate-orbit flex items-center justify-center pointer-events-none">
                                <!-- React -->
                                <div class="tech-icon absolute top-0 left-1/2 transform -translate-x-1/2">
                                    <i class="devicon-react-original colored text-4xl"></i>
                                </div>
                                <!-- Laravel -->
                                <div class="tech-icon absolute right-[15%] top-[20%]">
                                    <i class="devicon-laravel-plain colored text-4xl"></i>
                                </div>
                                <!-- JavaScript -->
                                <div class="tech-icon absolute right-0 top-1/2 transform -translate-y-1/2">
                                    <i class="devicon-javascript-plain colored text-4xl"></i>
                                </div>
                                <!-- Node.js -->
                                <div class="tech-icon absolute right-[15%] bottom-[20%]">
                                    <i class="devicon-nodejs-plain colored text-4xl"></i>
                                </div>
                                <!-- HTML5 -->
                                <div class="tech-icon absolute bottom-0 left-1/2 transform -translate-x-1/2">
                                    <i class="devicon-html5-plain colored text-4xl"></i>
                                </div>
                                <!-- CSS3 -->
                                <div class="tech-icon absolute left-[15%] bottom-[20%]">
                                    <i class="devicon-css3-plain colored text-4xl"></i>
                                </div>
                                <!-- PHP -->
                                <div class="tech-icon absolute left-0 top-1/2 transform -translate-y-1/2">
                                    <i class="devicon-php-plain colored text-4xl"></i>
                                </div>
                                <!-- MySQL -->
                                <div class="tech-icon absolute left-[15%] top-[20%]">
                                    <i class="devicon-mysql-plain colored text-4xl"></i>
                                </div>
                                <!-- TailwindCSS -->
                                <div class="tech-icon absolute top-[10%] left-[35%]">
                                    <i class="devicon-tailwindcss-original colored text-4xl"></i>
                                </div>
                                <!-- Git -->
                                <div class="tech-icon absolute top-[10%] right-[35%]">
                                    <i class="devicon-git-plain colored text-4xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 cursor-pointer group">
            <a href="#projects" class="flex flex-col items-center gap-2 animate-fade-in">
                <span class="text-sm text-muted-foreground">Scroll to explore</span>
                <i data-lucide="chevron-down"
                    class="w-6 h-6 text-primary group-hover:text-secondary transition-colors animate-bounce"></i>
            </a>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="relative z-20 py-20 bg-background shadow-2xl">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2
                    class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Featured Projects
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Explore my latest work and creative solutions
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    <div
                        class="group relative bg-card rounded-lg border border-border/50 overflow-hidden hover:border-primary/50 transition-all duration-300 hover:shadow-glow">
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ $project->images[0] }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-6 space-y-4">
                            <h3 class="text-xl font-bold text-foreground group-hover:text-primary transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-muted-foreground">{{ $project->description }}</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($project->tech as $tech)
                                    <span
                                        class="px-2 py-1 text-xs bg-primary/10 text-primary rounded-md">{{ $tech }}</span>
                                @endforeach
                            </div>
                            <div class="flex gap-2 pt-2">
                                <a href="{{ route('projects.show', $project->slug) }}"
                                    class="inline-flex items-center text-sm text-primary hover:text-secondary transition-colors">
                                    View Details
                                    <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md shadow-glow transition-colors">
                    View All Projects
                    <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="relative z-30 py-20 bg-background shadow-2xl">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2
                    class="text-4xl md:text-5xl font-bold mb-8 text-center bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    About Me
                </h2>

                <div class="space-y-6 text-lg text-muted-foreground">
                    <p>
                        {{ $webSettings->about_desc }}
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mt-12">
                    <div class="text-center p-6 bg-card rounded-lg border border-border/50">
                        <div class="text-4xl font-bold text-primary mb-2">{{$webSettings->project}}+</div>
                        <div class="text-muted-foreground">Projects Completed</div>
                    </div>
                    <div class="text-center p-6 bg-card rounded-lg border border-border/50">
                        <div class="text-4xl font-bold text-primary mb-2">{{$webSettings->client}}+</div>
                        <div class="text-muted-foreground">Happy Clients</div>
                    </div>
                    <div class="text-center p-6 bg-card rounded-lg border border-border/50">
                        <div class="text-4xl font-bold text-primary mb-2">{{$webSettings->experience}}+</div>
                        <div class="text-muted-foreground">Years Experience</div>
                    </div>
                </div>

                <div class="mt-12">
                    <h3 class="text-2xl font-bold mb-6 text-center">Skills & Technologies</h3>
                    <div class="flex flex-wrap gap-3 justify-center">
                    @foreach ($webSettings->skills as $skill)
                        <span class="px-4 py-2 bg-primary/10 text-primary rounded-lg border border-primary/20">
                            {{ $skill }}
                        </span>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="relative z-40 py-20 bg-background shadow-2xl">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <h2
                    class="text-4xl md:text-5xl font-bold mb-8 text-center bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Get In Touch
                </h2>

                <p class="text-lg text-muted-foreground text-center mb-12">
                    Have a project in mind? Let's work together to bring your ideas to life.
                </p>

                <form action="{{route('contact.send')}}" method="POST" class="space-y-6" id="contactForm">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 bg-card border border-border rounded-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 bg-card border border-border rounded-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                            class="w-full px-4 py-3 bg-card border border-border rounded-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required
                            class="w-full px-4 py-3 bg-card border border-border rounded-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors resize-none">{{ old('message') }}</textarea>
                    </div>
                    
                    <!-- reCAPTCHA -->
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    
                    <div class="text-center">
                        <button type="submit"
                            class="inline-flex items-center px-8 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-md shadow-glow transition-colors">
                            <i data-lucide="send" class="mr-2 w-5 h-5"></i>
                            Send Message
                        </button>
                    </div>
                </form>

                <div class="mt-12 flex justify-center gap-6">
                    <a href="mailto:alex@example.com"
                        class="flex items-center gap-2 text-muted-foreground hover:text-primary transition-colors">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                        alex@example.com
                    </a>
                    <a href="tel:+1234567890"
                        class="flex items-center gap-2 text-muted-foreground hover:text-primary transition-colors">
                        <i data-lucide="phone" class="w-5 h-5"></i>
                        +1 (234) 567-890
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-4 right-4 left-4 md:left-auto z-50 space-y-3 max-w-md md:max-w-md mx-auto md:mx-0"></div>

    <!-- Toast Notification Styles and Script -->
    <style>
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast {
            animation: slideInRight 0.3s ease-out;
        }

        .toast.removing {
            animation: slideOutRight 0.3s ease-in;
        }

        .toast-progress {
            animation: progressBar 5s linear;
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
    </style>

    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast relative bg-card border rounded-lg shadow-2xl overflow-hidden backdrop-blur-sm';
            
            // Set colors based on type
            let iconColor, borderColor, bgColor, icon;
            if (type === 'success') {
                iconColor = 'text-green-500';
                borderColor = 'border-green-500/50';
                bgColor = 'bg-green-500/10';
                icon = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`;
            } else {
                iconColor = 'text-red-500';
                borderColor = 'border-red-500/50';
                bgColor = 'bg-red-500/10';
                icon = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`;
            }
            
            toast.innerHTML = `
                <div class="flex items-start gap-3 p-4 ${borderColor} border-l-4">
                    <div class="${iconColor} flex-shrink-0 mt-0.5">
                        ${icon}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-foreground">${type === 'success' ? 'Success!' : 'Error!'}</p>
                        <p class="text-sm text-muted-foreground mt-1">${message}</p>
                    </div>
                    <button onclick="dismissToast(this)" class="flex-shrink-0 text-muted-foreground hover:text-foreground transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="h-1 ${bgColor}">
                    <div class="h-full ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} toast-progress"></div>
                </div>
            `;
            
            container.appendChild(toast);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                dismissToast(toast);
            }, 5000);
        }

        function dismissToast(element) {
            const toast = element.closest ? element.closest('.toast') : element;
            toast.classList.add('removing');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }

        // Show toast on page load if there's a session message
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif
            
            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
        });
    </script>
@endsection
