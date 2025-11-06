<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: window.innerWidth >= 1024 }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-muted/30 text-foreground">
    <div class="min-h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <aside x-show="sidebarOpen"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed lg:sticky inset-y-0 top-0 left-0 z-50 w-72 h-screen bg-card border-r border-border/50 shadow-2xl flex flex-col">

            <!-- Logo -->
            <div class="flex items-center justify-between h-20 px-6 border-b border-border/50 bg-gradient-to-r from-primary/5 to-secondary/5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center font-bold text-primary-foreground shadow-lg group-hover:shadow-glow transition-all duration-300 group-hover:scale-105">
                        AM
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        Admin Panel
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-md hover:bg-muted">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-5 py-6 space-y-2 overflow-y-auto custom-scrollbar">
                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-primary to-primary/90 text-primary-foreground shadow-lg shadow-primary/30' : 'hover:bg-muted/80 text-muted-foreground hover:text-foreground hover:shadow-md hover:translate-x-1' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-gradient-to-r from-primary to-primary/90 text-primary-foreground shadow-lg shadow-primary/30' : 'hover:bg-muted/80 text-muted-foreground hover:text-foreground hover:shadow-md hover:translate-x-1' }}">
                    <i data-lucide="folder" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    <span class="font-semibold">Categories</span>
                </a>

                <a href="{{ route('admin.projects.index') }}"
                   class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.projects.*') ? 'bg-gradient-to-r from-primary to-primary/90 text-primary-foreground shadow-lg shadow-primary/30' : 'hover:bg-muted/80 text-muted-foreground hover:text-foreground hover:shadow-md hover:translate-x-1' }}">
                    <i data-lucide="briefcase" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    <span class="font-semibold">Projects</span>
                </a>

                {{-- <a href="{{ route('admin.about.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.about.*') ? 'bg-primary text-primary-foreground shadow-glow' : 'hover:bg-muted text-muted-foreground hover:text-foreground' }}">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span class="font-medium">About Us</span>
                </a> --}}

                {{-- <a href="{{ route('admin.contact.messages') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.contact.*') ? 'bg-primary text-primary-foreground shadow-glow' : 'hover:bg-muted text-muted-foreground hover:text-foreground' }}">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                    <span class="font-medium">Contact</span>
                    @php
                        $unreadCount = \App\Models\ContactMessage::unread()->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="ml-auto px-2 py-0.5 text-xs bg-secondary text-secondary-foreground rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a> --}}

                <div class="pt-4 mt-4 border-t border-border/30">
                    <a href="{{ route('home') }}" target="_blank"
                       class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 hover:bg-gradient-to-r hover:from-secondary/10 hover:to-secondary/5 text-muted-foreground hover:text-secondary hover:shadow-md hover:translate-x-1">
                        <i data-lucide="external-link" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                        <span class="font-semibold">View Website</span>
                    </a>
                </div>
            </nav>

            <!-- User Section -->
            <div class="p-5 border-t border-border/50 bg-gradient-to-r from-muted/30 to-muted/10">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-medium text-muted-foreground">Theme</span>
                    <button @click="darkMode = !darkMode" class="p-2.5 rounded-lg hover:bg-muted transition-all duration-300 hover:scale-110 hover:shadow-md">
                        <i x-show="!darkMode" data-lucide="sun" class="w-4 h-4 text-yellow-500"></i>
                        <i x-show="darkMode" data-lucide="moon" class="w-4 h-4 text-blue-400"></i>
                    </button>
                </div>
                <div class="flex items-center justify-between p-4 bg-gradient-to-br from-muted/60 to-muted/40 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-sm font-bold text-primary-foreground shadow-lg ring-2 ring-background">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-muted-foreground truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg hover:bg-red-500/10 hover:text-red-500 transition-all duration-300 hover:scale-110" title="Logout">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-y-auto bg-gradient-to-br from-background via-muted/20 to-background">
            <!-- Top Bar -->
            <header class="sticky top-0 z-40 bg-card/95 backdrop-blur-xl border-b border-border/50 shadow-lg">
                <div class="max-w-[1400px] mx-auto flex items-center justify-between h-20 px-8">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2.5 rounded-xl hover:bg-muted transition-all duration-300 hover:scale-105 hover:shadow-md">
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-foreground to-foreground/70 bg-clip-text">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-xs text-muted-foreground mt-0.5">@yield('page-subtitle', 'Manage your content')</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        @yield('header-actions')
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-8">
                <div class="max-w-[1400px] mx-auto">
                @if(session('success'))
                    <div class="mb-8 p-5 bg-gradient-to-r from-green-500/10 to-green-600/10 border-l-4 border-green-500 text-green-600 dark:text-green-400 rounded-xl shadow-lg flex items-center gap-4 animate-fade-in hover:shadow-xl transition-shadow">
                        <div class="p-2 bg-green-500/20 rounded-lg">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 p-5 bg-gradient-to-r from-red-500/10 to-red-600/10 border-l-4 border-red-500 text-red-600 dark:text-red-400 rounded-xl shadow-lg flex items-center gap-4 animate-fade-in hover:shadow-xl transition-shadow">
                        <div class="p-2 bg-red-500/20 rounded-lg">
                            <i data-lucide="alert-circle" class="w-5 h-5"></i>
                        </div>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-6 px-8 border-t border-border/50 bg-card/50 backdrop-blur-sm">
                <div class="max-w-[1400px] mx-auto">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
                        <p class="font-medium">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        <div class="flex items-center gap-2">
                            <span>Built with</span>
                            <span class="text-red-500">❤</span>
                            <span>using Laravel & TailwindCSS</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen && window.innerWidth < 1024"
         @click="sidebarOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 lg:hidden z-40"></div>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // Reinitialize icons after Alpine updates
        document.addEventListener('alpine:initialized', () => {
            setInterval(() => {
                lucide.createIcons();
            }, 1000);
        });
    </script>

    @stack('scripts')
</body>
</html>
