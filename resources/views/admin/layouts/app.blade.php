<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: window.innerWidth >= 1024 }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
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
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-foreground">
    <div class="min-h-screen flex">
        <!-- Include Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content Wrapper -->
        <div class="main-content flex-1 flex flex-col min-h-screen" style="margin-left: 280px;">
            <!-- Include Header -->
            @include('admin.layouts.header')

            <!-- Page Content -->
            <main class="page-content flex-1 p-6 bg-gray-50 dark:bg-gray-900">
                <div class="max-w-6xl mx-auto">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-8 p-5 bg-gradient-to-r from-green-500/10 to-green-600/10 border-l-4 border-green-500 text-green-600 dark:text-green-400 rounded-xl shadow-lg flex items-center gap-4 animate-fade-in hover:shadow-xl transition-shadow">
                            <div class="p-2 bg-green-500/20 rounded-lg">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="mb-8 p-5 bg-gradient-to-r from-red-500/10 to-red-600/10 border-l-4 border-red-500 text-red-600 dark:text-red-400 rounded-xl shadow-lg flex items-center gap-4 animate-fade-in hover:shadow-xl transition-shadow">
                            <div class="p-2 bg-red-500/20 rounded-lg">
                                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                            </div>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Main Content -->
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 px-6 border-t border-border/50 bg-white dark:bg-gray-800">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
                        <p class="font-medium">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                     <div class="flex items-center gap-2 justify-center text-sm text-muted-foreground">
    <span>Developed & Designed by</span>
    <span class="text-foreground font-semibold">Qasim Mehmood</span>
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

    <!-- Mobile Responsive Styles -->
    <style>
        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>

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
