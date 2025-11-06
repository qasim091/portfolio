@extends('admin.layouts.app')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('header-actions')
    <a href="{{ route('admin.categories.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span class="font-medium">Back to Categories</span>
    </a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-border/50">
            <h3 class="text-lg font-semibold">Category Information</h3>
            <p class="text-sm text-muted-foreground mt-1">Create a new category to organize your projects</p>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-foreground mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                       placeholder="e.g., Web Development, Mobile Apps, Design"
                       required
                       autofocus>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-muted-foreground">The name of your category as it will appear on your site</p>
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-medium text-foreground mb-2">
                    Slug (URL-friendly name)
                </label>
                <input type="text" 
                       name="slug" 
                       id="slug" 
                       value="{{ old('slug') }}"
                       class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('slug') border-red-500 @enderror"
                       placeholder="e.g., web-development">
                @error('slug')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-muted-foreground">Leave empty to auto-generate from the name</p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-foreground mb-2">
                    Description
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('description') border-red-500 @enderror"
                          placeholder="Describe what this category is about...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-muted-foreground">Optional description to help visitors understand this category</p>
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-foreground mb-2">
                    Display Order
                </label>
                <input type="number" 
                       name="order" 
                       id="order" 
                       value="{{ old('order', 0) }}"
                       min="0"
                       class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('order') border-red-500 @enderror"
                       placeholder="0">
                @error('order')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-muted-foreground">Lower numbers appear first (default: 0)</p>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-border/50">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-4 py-2.5 text-foreground hover:bg-muted rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span class="font-medium">Create Category</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function(e) {
        const slug = document.getElementById('slug');
        if (!slug.value || slug.dataset.autoGenerated !== 'false') {
            slug.value = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slug.dataset.autoGenerated = 'true';
        }
    });

    document.getElementById('slug').addEventListener('input', function(e) {
        e.target.dataset.autoGenerated = 'false';
    });
</script>
@endpush
@endsection
