# Admin Panel Layout Structure

## 📁 File Organization

```
resources/views/admin/layouts/
├── app.blade.php      # Main layout file
├── sidebar.blade.php  # Sidebar component
├── header.blade.php   # Header component
└── README.md         # This file
```

## 🎯 How to Use

### In Your Admin Views

```blade
@extends('admin.layouts.app')

@section('title', 'Page Title')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Manage your content')

@section('header-actions')
    <!-- Optional: Add buttons or actions in header -->
    <a href="#" class="btn">Action Button</a>
@endsection

@section('content')
    <!-- Your page content here -->
@endsection
```

## 📐 Layout Structure

### 1. **app.blade.php** - Main Layout
- Contains the HTML structure
- Includes Alpine.js for interactivity
- Dark mode support
- Mobile responsive
- Includes sidebar and header components
- Content area with max-width centering

### 2. **sidebar.blade.php** - Navigation Sidebar
- **Width:** 288px (w-72)
- **Position:** Fixed on desktop, collapsible on mobile
- **Features:**
  - Logo with hover animation
  - Navigation menu with active states
  - Theme toggle (light/dark)
  - User profile card
  - Logout button
  - Custom scrollbar

### 3. **header.blade.php** - Top Header Bar
- **Height:** 80px (h-20)
- **Position:** Sticky at top
- **Features:**
  - Mobile menu toggle
  - Page title & subtitle
  - Dynamic header actions
  - User info display
  - Quick logout button

## 🎨 Design Features

### Sidebar
- Full height (100vh)
- Fixed position on desktop
- Smooth slide animation on mobile
- Gradient logo background
- Active menu item with primary gradient
- Hover effects with translate and shadow
- Custom themed scrollbar

### Header
- Backdrop blur for modern glass effect
- Centered content (max-width: 1400px)
- Responsive user info display
- Dynamic action buttons per page

### Content Area
- **Desktop:** `margin-left: 288px` (sidebar width)
- **Max Width:** 1400px (centered)
- **Padding:** 32px (p-8)
- **Background:** Subtle gradient
- Fully responsive

## 📱 Responsive Behavior

### Desktop (≥1024px)
- Sidebar visible and fixed
- Content has left margin for sidebar
- Full header with user info

### Tablet/Mobile (<1024px)
- Sidebar collapses (hidden by default)
- Toggle button to show/hide sidebar
- Content takes full width
- Compact header
- Overlay when sidebar is open

## 🎭 Theme Support

Both light and dark modes are supported via Alpine.js:
- Theme preference stored in localStorage
- Smooth transitions between themes
- Consistent colors across components

## 🔧 Customization

### To Change Sidebar Width
1. Update `w-72` class in `sidebar.blade.php`
2. Update `lg:ml-72` class in `app.blade.php`

### To Add New Menu Item
Add to `sidebar.blade.php`:
```blade
<a href="{{ route('your.route') }}"
   class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300 {{ request()->routeIs('your.route.*') ? 'bg-gradient-to-r from-primary to-primary/90 text-primary-foreground shadow-lg shadow-primary/30' : 'hover:bg-muted/80 text-muted-foreground hover:text-foreground hover:shadow-md hover:translate-x-1' }}">
    <i data-lucide="icon-name" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
    <span class="font-semibold">Menu Item</span>
</a>
```

### To Change Max Content Width
Update `max-w-[1400px]` class in:
- `app.blade.php` (main content)
- `header.blade.php` (header container)

## ✅ Benefits of This Structure

1. **Modularity:** Separate files for different components
2. **Reusability:** Components can be included anywhere
3. **Maintainability:** Easy to update individual parts
4. **Consistency:** Shared layout across all admin pages
5. **Scalability:** Easy to add new sections or components

## 🚀 Tech Stack

- **Framework:** Laravel 11
- **Styling:** TailwindCSS
- **Icons:** Lucide Icons
- **Interactivity:** Alpine.js
- **Responsive:** Mobile-first approach

## 📝 Notes

- The old `layouts/admin.blade.php` is no longer used
- All admin views have been updated to use `admin.layouts.app`
- Custom scrollbar styles are in `resources/css/app.css`
- Dark mode is persistent via localStorage
