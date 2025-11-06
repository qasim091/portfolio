@extends('admin.layouts.app')

@section('title', 'Create Setting')
@section('page-title', 'Create New Setting')

@section('header-actions')
    <a href="{{ route('admin.settings.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span class="font-medium">Back to Settings</span>
    </a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-card rounded-xl border border-border/50 shadow-sm p-6">
        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Key -->
            <div>
                <label for="key" class="block text-sm font-semibold text-foreground mb-2">
                    Setting Key <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="key" 
                       name="key" 
                       value="{{ old('key') }}"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('key') border-red-500 @enderror"
                       placeholder="e.g., site_name, contact_email"
                       required>
                <p class="mt-1 text-sm text-muted-foreground">Use lowercase with underscores (e.g., site_name, contact_email)</p>
                @error('key')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Value -->
            <div>
                <label for="value" class="block text-sm font-semibold text-foreground mb-2">
                    Value
                </label>
                <textarea id="value" 
                          name="value" 
                          rows="4"
                          class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('value') border-red-500 @enderror"
                          placeholder="Enter the setting value">{{ old('value') }}</textarea>
                <p class="mt-1 text-sm text-muted-foreground">The value for this setting</p>
                @error('value')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-semibold text-foreground mb-2">
                    Type <span class="text-red-500">*</span>
                </label>
                <select id="type" 
                        name="type" 
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('type') border-red-500 @enderror"
                        required>
                    <option value="">Select Type</option>
                    <option value="text" {{ old('type') === 'text' ? 'selected' : '' }}>Text</option>
                    <option value="email" {{ old('type') === 'email' ? 'selected' : '' }}>Email</option>
                    <option value="phone" {{ old('type') === 'phone' ? 'selected' : '' }}>Phone</option>
                    <option value="url" {{ old('type') === 'url' ? 'selected' : '' }}>URL</option>
                    <option value="textarea" {{ old('type') === 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="number" {{ old('type') === 'number' ? 'selected' : '' }}>Number</option>
                    <option value="image" {{ old('type') === 'image' ? 'selected' : '' }}>Image</option>
                </select>
                <p class="mt-1 text-sm text-muted-foreground">The data type of this setting</p>
                @error('type')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload (shown only when type is image) -->
            <div id="imageUploadField" style="display: none;">
                <label for="image" class="block text-sm font-semibold text-foreground mb-2">
                    Upload Image <span class="text-red-500">*</span>
                </label>
                <input type="file" 
                       id="image" 
                       name="image" 
                       accept="image/*"
                       class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('image') border-red-500 @enderror">
                <p class="mt-1 text-sm text-muted-foreground">Allowed formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4" style="display: none;">
                    <p class="text-sm font-semibold text-foreground mb-2">Preview:</p>
                    <img id="previewImg" src="" alt="Preview" class="max-w-xs rounded-lg border border-border">
                </div>
            </div>

            <!-- Common Settings Examples -->
            <div class="bg-muted/50 rounded-lg p-4 border border-border/50">
                <p class="text-sm font-semibold text-foreground mb-2">Common Settings Examples:</p>
                <ul class="text-sm text-muted-foreground space-y-1">
                    <li>• <code class="px-1 py-0.5 bg-background rounded">site_name</code> - Website name (text)</li>
                    <li>• <code class="px-1 py-0.5 bg-background rounded">site_tagline</code> - Website tagline (text)</li>
                    <li>• <code class="px-1 py-0.5 bg-background rounded">contact_email</code> - Contact email (email)</li>
                    <li>• <code class="px-1 py-0.5 bg-background rounded">contact_phone</code> - Contact phone (phone)</li>
                    <li>• <code class="px-1 py-0.5 bg-background rounded">github_url</code> - GitHub URL (url)</li>
                    <li>• <code class="px-1 py-0.5 bg-background rounded">linkedin_url</code> - LinkedIn URL (url)</li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-border/50">
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span class="font-medium">Create Setting</span>
                </button>
                <a href="{{ route('admin.settings.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
                    <span class="font-medium">Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Toggle image upload field based on type selection
    document.getElementById('type').addEventListener('change', function() {
        const imageField = document.getElementById('imageUploadField');
        const valueField = document.querySelector('[name="value"]').closest('div');
        
        if (this.value === 'image') {
            imageField.style.display = 'block';
            valueField.style.display = 'none';
        } else {
            imageField.style.display = 'none';
            valueField.style.display = 'block';
        }
    });

    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Check on page load (for validation errors)
    window.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        if (typeSelect.value === 'image') {
            document.getElementById('imageUploadField').style.display = 'block';
            document.querySelector('[name="value"]').closest('div').style.display = 'none';
        }
    });
</script>
@endpush
@endsection
