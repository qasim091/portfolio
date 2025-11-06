@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('header-actions')
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.categories.show', $category) }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="eye" class="w-4 h-4"></i>
            <span class="font-medium">View</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span class="font-medium">Back</span>
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-border/50">
            <h3 class="text-lg font-semibold">Edit Category</h3>
            <p class="text-sm text-muted-foreground mt-1">Update category information</p>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-foreground mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $category->name) }}"
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
                       value="{{ old('slug', $category->slug) }}"
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
                          placeholder="Describe what this category is about...">{{ old('description', $category->description) }}</textarea>
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
                       value="{{ old('order', $category->order ?? 0) }}"
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
            <div class="flex items-center justify-between pt-6 border-t border-border/50">
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                      onsubmit="return confirm('Are you sure? This action cannot be undone and will fail if there are projects assigned to this category.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500/10 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-500/20 transition-all">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span class="font-medium">Delete Category</span>
                    </button>
                </form>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="px-4 py-2.5 text-foreground hover:bg-muted rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span class="font-medium">Update Category</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Category Info -->
    <div class="mt-6 bg-muted/30 rounded-xl border border-border/50 p-4">
        <h4 class="font-medium text-sm text-foreground mb-3">Category Information</h4>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-muted-foreground">Created:</span>
                <span class="ml-2 text-foreground">{{ $category->created_at->format('M d, Y h:i A') }}</span>
            </div>
            <div>
                <span class="text-muted-foreground">Last Updated:</span>
                <span class="ml-2 text-foreground">{{ $category->updated_at->format('M d, Y h:i A') }}</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate slug from name if manually changing name
    document.getElementById('name').addEventListener('input', function(e) {
        const slug = document.getElementById('slug');
        if (slug.dataset.manuallyEdited !== 'true') {
            slug.value = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });

    document.getElementById('slug').addEventListener('input', function(e) {
        e.target.dataset.manuallyEdited = 'true';
    });
</script>
@endpush
@endsection
