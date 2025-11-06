<!-- Header Component -->
<header class="sticky top-0 z-40 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="max-w-6xl mx-auto flex items-center justify-between h-16 px-6">
        <!-- Left Section: Menu Toggle & Page Title -->
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Toggle -->
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 lg:hidden">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            <!-- Page Title & Subtitle -->
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                    @yield('page-title', 'Dashboard')
                </h1>
                @if(View::hasSection('page-subtitle'))
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @yield('page-subtitle')
                    </p>
                @endif
            </div>
        </div>

        <!-- Right Section: User Info & Actions -->
        <div class="flex items-center gap-3">
            <!-- Header Actions (Dynamic per page) -->
            @yield('header-actions')

            <!-- User Info (Desktop) -->
            <div class="hidden md:flex items-center gap-3 px-3 py-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-xs font-bold text-white shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
                </div>
            </div>

            <!-- Logout Button (Desktop) -->
            <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                @csrf
                <button type="submit" 
                        class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200" 
                        title="Logout">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </button>
            </form>
        </div>
    </div>
</header>
