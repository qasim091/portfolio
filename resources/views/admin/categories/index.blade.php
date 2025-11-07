@extends('admin.layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('header-actions')
    <a href="{{ route('admin.categories.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span class="font-medium">Add Category</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Total Categories</p>
                    <p class="text-3xl font-bold">{{ $categories->total() }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center">
                    <i data-lucide="folder" class="w-6 h-6 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Total Projects</p>
                    <p class="text-3xl font-bold">{{ $categories->sum('projects_count') }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-secondary/10 flex items-center justify-center">
                    <i data-lucide="briefcase" class="w-6 h-6 text-secondary"></i>
                </div>
            </div>
        </div>

        <div class="bg-card rounded-xl p-6 border border-border/50 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground mb-1">Avg Projects/Category</p>
                    <p class="text-3xl font-bold">{{ $categories->total() > 0 ? number_format($categories->sum('projects_count') / $categories->total(), 1) : '0' }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-accent/10 flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-6 h-6 text-accent"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Order
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Slug
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Projects
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Created
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary font-semibold text-sm">
                                    {{ $category->order ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <p class="font-semibold text-foreground">{{ $category->name }}</p>
                                        @if($category->description)
                                            <p class="text-sm text-muted-foreground mt-1">{{ Str::limit($category->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <code class="px-2 py-1 bg-muted rounded text-sm text-muted-foreground">
                                    {{ $category->slug }}
                                </code>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $category->projects_count > 0 ? 'bg-green-500/10 text-green-600 dark:text-green-400' : 'bg-gray-500/10 text-gray-600 dark:text-gray-400' }}">
                                    <i data-lucide="briefcase" class="w-3 h-3"></i>
                                    {{ $category->projects_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                {{ $category->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.show', $category) }}" 
                                       class="p-2 rounded-lg hover:bg-muted transition-colors" 
                                       title="View">
                                        <i data-lucide="eye" class="w-4 h-4 text-muted-foreground"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="p-2 rounded-lg hover:bg-muted transition-colors" 
                                       title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4 text-muted-foreground"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" 
                                          method="POST" 
                                          class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="showDeleteModal(this.closest('form'), '{{ $category->name }}')"
                                                class="p-2 rounded-lg hover:bg-red-500/10 transition-colors" 
                                                title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-600 dark:text-red-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-muted/50 flex items-center justify-center mb-4">
                                        <i data-lucide="folder-x" class="w-8 h-8 text-muted-foreground"></i>
                                    </div>
                                    <p class="text-muted-foreground mb-2">No categories found</p>
                                    <a href="{{ route('admin.categories.create') }}" 
                                       class="text-primary hover:text-primary/80 font-medium">
                                        Create your first category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-border/50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    @include('admin.components.delete-modal', [
        'title' => 'Delete Category',
        'message' => 'Are you sure you want to delete this category?',
        'warning' => 'All projects in this category will remain but will be uncategorized.',
        'buttonText' => 'Delete Category'
    ])
</div>
@endsection
