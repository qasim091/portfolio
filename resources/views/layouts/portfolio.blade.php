<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Alex Morgan - Full Stack Developer, 3D Enthusiast, and UI/UX Designer. View my portfolio of innovative web applications and creative projects.">

        <title>@yield('title', 'Alex Morgan - Portfolio')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Lucide Icons CDN -->
        <script src="https://unpkg.com/lucide@latest"></script>

        <!-- Alpine.js for dark mode -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Google reCAPTCHA -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-background text-foreground">
        <div class="relative min-h-screen overflow-x-hidden">
            @include('components.header')

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            @include('components.footer')
        </div>

        <!-- Initialize Lucide Icons -->
        <script>
            lucide.createIcons();
        </script>

        @stack('scripts')
    </body>
</html>
