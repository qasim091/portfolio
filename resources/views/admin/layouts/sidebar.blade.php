<!-- Sidebar Component -->
<aside x-show="sidebarOpen"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed inset-y-0 left-0 z-50 h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-lg flex flex-col"
       style="width: 280px;">

    <!-- Logo Section -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary/5 to-secondary/5">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center font-bold text-white shadow-md group-hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                AM
            </div>
            <span class="text-lg font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Admin Panel
            </span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Categories -->
        <a href="{{ route('admin.categories.index') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-primary text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
            <i data-lucide="folder" class="w-5 h-5 flex-shrink-0"></i>
            <span class="font-medium">Categories</span>
        </a>

        <!-- Projects -->
        <a href="{{ route('admin.projects.index') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.projects.*') ? 'bg-primary text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
            <i data-lucide="briefcase" class="w-5 h-5 flex-shrink-0"></i>
            <span class="font-medium">Projects</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('admin.settings.index') }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
            <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
            <span class="font-medium">Settings</span>
        </a>

        <!-- Divider -->
        <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-700">
            <!-- View Website -->
            <a href="{{ route('home') }}" target="_blank"
               class="group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white">
                <i data-lucide="external-link" class="w-5 h-5 flex-shrink-0"></i>
                <span class="font-medium">View Website</span>
            </a>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-750">
        <!-- Theme Toggle -->
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Theme</span>
            <button @click="darkMode = !darkMode" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                <i x-show="!darkMode" data-lucide="sun" class="w-4 h-4 text-yellow-500"></i>
                <i x-show="darkMode" data-lucide="moon" class="w-4 h-4 text-blue-400"></i>
            </button>
        </div>

        <!-- User Info Card -->
        <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-sm font-bold text-white shadow-sm flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="overflow-hidden flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200" title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
