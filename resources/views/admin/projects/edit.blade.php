@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('header-actions')
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.projects.show', $project) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="eye" class="w-4 h-4"></i>
            <span class="font-medium">View</span>
        </a>
        <a href="{{ route('admin.projects.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span class="font-medium">Back</span>
        </a>
    </div>
@endsection

@section('content')
<form action="{{ route('admin.projects.update', $project) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Basic Information</h3>
                    <p class="text-sm text-muted-foreground mt-1">Essential project details</p>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-foreground mb-2">
                            Project Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $project->title) }}"
                               class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                               required
                               autofocus>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-foreground mb-2">
                            Slug (URL)
                        </label>
                        <input type="text"
                               name="slug"
                               id="slug"
                               value="{{ old('slug', $project->slug) }}"
                               class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('slug') border-red-500 @enderror">
                        <p class="mt-2 text-sm text-muted-foreground">Leave empty to auto-generate</p>
                        @error('slug')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-foreground mb-2">
                            Short Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror"
                                  required>{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Long Description -->
                    <div>
                        <label for="long_description" class="block text-sm font-medium text-foreground mb-2">
                            Detailed Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="long_description"
                                  id="long_description"
                                  rows="8"
                                  class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('long_description') border-red-500 @enderror"
                                  required>{{ old('long_description', $project->long_description) }}</textarea>
                        @error('long_description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Technologies & Features -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Technologies & Features</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Technologies -->
                    <div>
                        <label for="tech_input" class="block text-sm font-medium text-foreground mb-2">
                            Technologies <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2 mb-2">
                            <input type="text"
                                   id="tech_input"
                                   class="flex-1 px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="e.g., React, Laravel, TailwindCSS">
                            <button type="button"
                                    onclick="addTech()"
                                    class="px-4 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                                Add
                            </button>
                        </div>
                        <div id="tech_tags" class="flex flex-wrap gap-2 min-h-[40px] p-3 bg-muted/30 rounded-lg"></div>
                        <input type="hidden" name="tech[]" id="tech_hidden">
                        @error('tech')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Features -->
                    <div>
                        <label for="features_input" class="block text-sm font-medium text-foreground mb-2">
                            Key Features
                        </label>
                        <div class="flex gap-2 mb-2">
                            <input type="text"
                                   id="features_input"
                                   class="flex-1 px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="e.g., Real-time chat, User authentication">
                            <button type="button"
                                    onclick="addFeature()"
                                    class="px-4 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                                Add
                            </button>
                        </div>
                        <div id="features_tags" class="flex flex-wrap gap-2 min-h-[40px] p-3 bg-muted/30 rounded-lg"></div>
                        <input type="hidden" name="features[]" id="features_hidden">
                    </div>
                </div>
            </div>

            <!-- Media & Links -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Media & Links</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Images -->
                    <div>
                        <label for="images_input" class="block text-sm font-medium text-foreground mb-2">
                            Image URLs <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2 mb-2">
                            <input type="url"
                                   id="images_input"
                                   class="flex-1 px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="https://example.com/image.jpg">
                            <button type="button"
                                    onclick="addImage()"
                                    class="px-4 py-2.5 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                                Add
                            </button>
                        </div>
                        <div id="images_preview" class="grid grid-cols-3 gap-2"></div>
                        <input type="hidden" name="images[]" id="images_hidden">
                        @error('images')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- GitHub Link -->
                    <div>
                        <label for="github" class="block text-sm font-medium text-foreground mb-2">
                            GitHub Repository
                        </label>
                        <input type="url"
                               name="github"
                               id="github"
                               value="{{ old('github', $project->github) }}"
                               class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('github') border-red-500 @enderror"
                               placeholder="https://github.com/username/repo">
                        @error('github')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Live Link -->
                    <div>
                        <label for="live" class="block text-sm font-medium text-foreground mb-2">
                            Live Demo URL
                        </label>
                        <input type="url"
                               name="live"
                               id="live"
                               value="{{ old('live', $project->live) }}"
                               class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('live') border-red-500 @enderror"
                               placeholder="https://example.com">
                        @error('live')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Additional Details</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Challenges -->
                    <div>
                        <label for="challenges" class="block text-sm font-medium text-foreground mb-2">
                            Challenges Faced
                        </label>
                        <textarea name="challenges"
                                  id="challenges"
                                  rows="4"
                                  class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                  placeholder="Describe any challenges you encountered...">{{ old('challenges', $project->challenges) }}</textarea>
                    </div>

                    <!-- Outcome -->
                    <div>
                        <label for="outcome" class="block text-sm font-medium text-foreground mb-2">
                            Project Outcome
                        </label>
                        <textarea name="outcome"
                                  id="outcome"
                                  rows="4"
                                  class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                  placeholder="Describe the results and impact...">{{ old('outcome', $project->outcome) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-card rounded-xl border border-red-500/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-red-500/50 bg-red-500/5">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Danger Zone</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="font-medium text-foreground mb-1">Delete this project</h4>
                            <p class="text-sm text-muted-foreground">
                                Once you delete a project, there is no going back. Please be certain.
                            </p>
                        </div>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                              onsubmit="return confirm('Are you absolutely sure? This action cannot be undone!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                <span class="font-medium">Delete Project</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Publish Settings -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-border/50">
                    <h3 class="text-lg font-semibold">Settings</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-foreground mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id"
                                id="category_id"
                                class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('category_id') border-red-500 @enderror"
                                required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-foreground mb-2">
                            Display Order
                        </label>
                        <input type="number"
                               name="order"
                               id="order"
                               value="{{ old('order', $project->order ?? 0) }}"
                               min="0"
                               class="w-full px-4 py-2.5 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <p class="mt-2 text-sm text-muted-foreground">Lower numbers appear first</p>
                    </div>

                    <!-- Featured Toggle -->
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox"
                                   name="is_featured"
                                   id="is_featured"
                                   value="1"
                                   {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 rounded border-border text-primary focus:ring-2 focus:ring-primary">
                            <div>
                                <span class="text-sm font-medium text-foreground">Featured Project</span>
                                <p class="text-xs text-muted-foreground">Show on homepage</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Metadata -->
            <div class="bg-muted/30 rounded-xl border border-border/50 p-4">
                <h4 class="font-medium text-sm text-foreground mb-3">Project Information</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-muted-foreground">Created:</span>
                        <span class="text-foreground">{{ $project->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-muted-foreground">Updated:</span>
                        <span class="text-foreground">{{ $project->updated_at->format('M d, Y') }}</span>
                    </div>
                    @if($project->slug)
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Slug:</span>
                            <code class="text-xs bg-muted px-2 py-0.5 rounded">{{ $project->slug }}</code>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-card rounded-xl border border-border/50 shadow-sm overflow-hidden p-6">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow font-medium">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}"
                   class="mt-3 w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all font-medium">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    let techArray = @json($project->tech ?? []);
    let featuresArray = @json($project->features ?? []);
    let imagesArray = @json($project->images ?? []);

    // Initialize displays
    updateTechDisplay();
    updateFeaturesDisplay();
    updateImagesDisplay();

    // Auto-generate slug
    document.getElementById('title').addEventListener('input', function(e) {
        const slug = document.getElementById('slug');
        if (!slug.dataset.manuallyEdited) {
            slug.value = e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manuallyEdited = 'true';
    });

    // Tech management
    function addTech() {
        const input = document.getElementById('tech_input');
        const value = input.value.trim();
        if (value && !techArray.includes(value)) {
            techArray.push(value);
            updateTechDisplay();
            input.value = '';
        }
    }

    function removeTech(index) {
        techArray.splice(index, 1);
        updateTechDisplay();
    }

    function updateTechDisplay() {
        const container = document.getElementById('tech_tags');
        container.innerHTML = techArray.map((tech, index) =>
            `<span class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 text-primary rounded-lg text-sm">
                ${tech}
                <button type="button" onclick="removeTech(${index})" class="hover:text-primary/80">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </span>`
        ).join('');
        updateTechHidden();
        lucide.createIcons();
    }

    function updateTechHidden() {
        const container = document.getElementById('tech_hidden');
        container.parentElement.querySelectorAll('input[name="tech[]"]').forEach(el => el.remove());
        techArray.forEach(tech => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'tech[]';
            input.value = tech;
            container.parentElement.appendChild(input);
        });
    }

    // Features management
    function addFeature() {
        const input = document.getElementById('features_input');
        const value = input.value.trim();
        if (value && !featuresArray.includes(value)) {
            featuresArray.push(value);
            updateFeaturesDisplay();
            input.value = '';
        }
    }

    function removeFeature(index) {
        featuresArray.splice(index, 1);
        updateFeaturesDisplay();
    }

    function updateFeaturesDisplay() {
        const container = document.getElementById('features_tags');
        container.innerHTML = featuresArray.map((feature, index) =>
            `<span class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/10 text-secondary rounded-lg text-sm">
                ${feature}
                <button type="button" onclick="removeFeature(${index})" class="hover:text-secondary/80">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </span>`
        ).join('');
        updateFeaturesHidden();
        lucide.createIcons();
    }

    function updateFeaturesHidden() {
        const container = document.getElementById('features_hidden');
        container.parentElement.querySelectorAll('input[name="features[]"]').forEach(el => el.remove());
        featuresArray.forEach(feature => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'features[]';
            input.value = feature;
            container.parentElement.appendChild(input);
        });
    }

    // Images management
    function addImage() {
        const input = document.getElementById('images_input');
        const value = input.value.trim();
        if (value && !imagesArray.includes(value)) {
            imagesArray.push(value);
            updateImagesDisplay();
            input.value = '';
        }
    }

    function removeImage(index) {
        imagesArray.splice(index, 1);
        updateImagesDisplay();
    }

    function updateImagesDisplay() {
        const container = document.getElementById('images_preview');
        container.innerHTML = imagesArray.map((image, index) =>
            `<div class="relative group">
                <img src="${image}" alt="Preview" class="w-full h-24 object-cover rounded-lg">
                <button type="button" onclick="removeImage(${index})"
                        class="absolute top-1 right-1 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>`
        ).join('');
        updateImagesHidden();
        lucide.createIcons();
    }

    function updateImagesHidden() {
        const container = document.getElementById('images_hidden');
        container.parentElement.querySelectorAll('input[name="images[]"]').forEach(el => el.remove());
        imagesArray.forEach(image => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'images[]';
            input.value = image;
            container.parentElement.appendChild(input);
        });
    }

    // Enter key handlers
    document.getElementById('tech_input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTech();
        }
    });

    document.getElementById('features_input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addFeature();
        }
    });

    document.getElementById('images_input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addImage();
        }
    });
</script>
@endpush
@endsection
