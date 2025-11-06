@extends('admin.layouts.app')

@section('title', 'Edit Setting')
@section('page-title', 'Edit Setting')

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
            <form action="{{ route('admin.settings.update', $setting) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Key -->
                <div>
                    <label for="key" class="block text-sm font-semibold text-foreground mb-2">
                        Setting Key <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="key" name="key" value="{{ old('key', $setting->key) }}"
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('key') border-red-500 @enderror"
                        placeholder="e.g., site_name, contact_email" required>
                    <p class="mt-1 text-sm text-muted-foreground">Use lowercase with underscores (e.g., site_name,
                        contact_email)</p>
                    @error('key')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Value -->
                <div>
                    <label for="value" class="block text-sm font-semibold text-foreground mb-2">
                        Value
                    </label>
                    <textarea id="value" name="value" rows="4"
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('value') border-red-500 @enderror"
                        placeholder="Enter the setting value">{{ old('value', $setting->value) }}</textarea>
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
                    <select id="type" name="type"
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('type') border-red-500 @enderror"
                        required>
                        <option value="">Select Type</option>
                        <option value="text" {{ old('type', $setting->type) === 'text' ? 'selected' : '' }}>Text</option>
                        <option value="email" {{ old('type', $setting->type) === 'email' ? 'selected' : '' }}>Email
                        </option>
                        <option value="phone" {{ old('type', $setting->type) === 'phone' ? 'selected' : '' }}>Phone
                        </option>
                        <option value="url" {{ old('type', $setting->type) === 'url' ? 'selected' : '' }}>URL</option>
                        <option value="textarea" {{ old('type', $setting->type) === 'textarea' ? 'selected' : '' }}>
                            Textarea</option>
                        <option value="number" {{ old('type', $setting->type) === 'number' ? 'selected' : '' }}>Number
                        </option>
                        <option value="image" {{ old('type', $setting->type) === 'image' ? 'selected' : '' }}>Image
                        </option>
                        <option value="file" {{ old('type', $setting->type) === 'file' ? 'selected' : '' }}>File
                        </option>
                        <option value="json" {{ old('type', $setting->type) === 'json' ? 'selected' : '' }}>JSON (Multiple Values)</option>
                    </select>
                    <p class="mt-1 text-sm text-muted-foreground">The data type of this setting</p>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- JSON Fields (shown only when type is json) -->
                <div id="jsonFields" style="display: {{ $setting->type === 'json' ? 'block' : 'none' }};">
                    <label class="block text-sm font-semibold text-foreground mb-2">
                        JSON Keys <span class="text-red-500">*</span>
                    </label>
                    <div id="jsonValuesContainer" class="space-y-3">
                        @if($setting->type === 'json' && $setting->value)
                            @php
                                $jsonData = json_decode($setting->value, true) ?? [];
                            @endphp
                            @foreach($jsonData as $key)
                                <!-- Existing JSON keys will be populated by JavaScript -->
                            @endforeach
                        @endif
                    </div>
                    <button type="button" 
                            id="addJsonValue"
                            class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span class="font-medium">Add Key</span>
                    </button>
                    <p class="mt-2 text-sm text-muted-foreground">Add multiple keys for this JSON setting</p>
                    @error('json_data')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload (shown only when type is image) -->
                <div id="imageUploadField" style="display: {{ $setting->type === 'image' ? 'block' : 'none' }};">
                    <!-- Current Image -->
                    @if ($setting->type === 'image' && $setting->value)
                        <div class="mb-4">
                            <p class="text-sm font-semibold text-foreground mb-2">Current Image:</p>
                            <img src="{{ $setting->value }}" alt="Current"
                                class="max-w-xs rounded-lg border border-border">
                        </div>
                    @endif

                    <label for="image" class="block text-sm font-semibold text-foreground mb-2">
                        Upload New Image
                    </label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('image') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-muted-foreground">Allowed formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4" style="display: none;">
                        <p class="text-sm font-semibold text-foreground mb-2">New Preview:</p>
                        <img id="previewImg" src="" alt="Preview" class="max-w-xs rounded-lg border border-border">
                    </div>
                </div>

                <!-- File Upload (shown only when type is file) -->
                <div id="fileField" style="display: {{ $setting->type === 'file' ? 'block' : 'none' }};">
                    <!-- Current File -->
                    @if ($setting->type === 'file' && $setting->value)
                        <div class="mb-4">
                            <p class="text-sm font-semibold text-foreground mb-2">Current File:</p>
                            <div class="flex items-center gap-3 p-3 bg-muted/50 rounded-lg border border-border">
                                <i data-lucide="file" class="w-5 h-5 text-primary"></i>
                                <a href="{{ asset($setting->value) }}" target="_blank" 
                                   class="text-sm text-primary hover:underline flex-1">
                                    {{ basename($setting->value) }}
                                </a>
                                <a href="{{ asset($setting->value) }}" download 
                                   class="text-sm text-muted-foreground hover:text-foreground">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                    <label for="file" class="block text-sm font-semibold text-foreground mb-2">
                        Upload New File
                    </label>
                    <input type="file" 
                           id="file" 
                           name="file" 
                           class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('file') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-muted-foreground">Upload any file (Max: 10MB). Leave empty to keep current file.</p>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    
                    <!-- File Info -->
                    <div id="fileInfo" class="mt-4" style="display: none;">
                        <p class="text-sm font-semibold text-foreground mb-2">Selected File:</p>
                        <div class="flex items-center gap-2 p-3 bg-muted/50 rounded-lg border border-border">
                            <i data-lucide="file" class="w-5 h-5 text-primary"></i>
                            <span id="fileName" class="text-sm text-foreground"></span>
                            <span id="fileSize" class="text-xs text-muted-foreground ml-auto"></span>
                        </div>
                    </div>
                </div>

                <!-- Setting Info -->
                <div class="bg-muted/50 rounded-lg p-4 border border-border/50">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-muted-foreground mb-1">Created</p>
                            <p class="font-medium text-foreground">{{ $setting->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-muted-foreground mb-1">Last Updated</p>
                            <p class="font-medium text-foreground">{{ $setting->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-all shadow-glow">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span class="font-medium">Update Setting</span>
                </button>

            </form>
            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-border/50">

                <a href="{{ route('admin.settings.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-all">
                    <span class="font-medium">Cancel</span>
                </a>
                <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="ml-auto"
                    onsubmit="return confirm('Are you sure you want to delete this setting?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-red-500/10 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-500/20 transition-all">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span class="font-medium">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let jsonValueIndex = 0;

            // Existing JSON data from server
            const existingJsonData = @json($setting->type === 'json' && $setting->value ? json_decode($setting->value, true) : []);

            // Toggle fields based on type selection
            document.getElementById('type').addEventListener('change', function() {
                const imageField = document.getElementById('imageUploadField');
                const fileField = document.getElementById('fileField');
                const jsonField = document.getElementById('jsonFields');
                const valueField = document.querySelector('[name="value"]').closest('div');

                // Hide all special fields first
                imageField.style.display = 'none';
                fileField.style.display = 'none';
                jsonField.style.display = 'none';
                valueField.style.display = 'block';

                if (this.value === 'image') {
                    imageField.style.display = 'block';
                    valueField.style.display = 'none';
                } else if (this.value === 'file') {
                    fileField.style.display = 'block';
                    valueField.style.display = 'none';
                } else if (this.value === 'json') {
                    jsonField.style.display = 'block';
                    valueField.style.display = 'none';
                    // Add initial field if none exist
                    if (document.querySelectorAll('.json-value-item').length === 0) {
                        addJsonValueField();
                    }
                }
            });

            // Function to add a new JSON key field
            function addJsonValueField(key = '') {
                const container = document.getElementById('jsonValuesContainer');
                const index = jsonValueIndex++;
                
                const fieldHtml = `
                    <div class="json-value-item flex gap-3 items-start" data-index="${index}">
                        <div class="flex-1">
                            <input type="text" 
                                   name="json_data[]" 
                                   value="${key}"
                                   class="w-full px-4 py-2 bg-background border border-border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                   placeholder="Enter key (e.g., facebook, twitter, instagram)"
                                   required>
                        </div>
                        <button type="button" 
                                class="remove-json-value px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all"
                                onclick="removeJsonValueField(this)">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                `;
                
                container.insertAdjacentHTML('beforeend', fieldHtml);
                
                // Re-initialize Lucide icons for the new button
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }

            // Function to remove a JSON key field
            function removeJsonValueField(button) {
                const item = button.closest('.json-value-item');
                const container = document.getElementById('jsonValuesContainer');
                
                // Keep at least one field
                if (container.querySelectorAll('.json-value-item').length > 1) {
                    item.remove();
                } else {
                    alert('At least one key is required for JSON type.');
                }
            }

            // Add JSON value button click handler
            document.getElementById('addJsonValue').addEventListener('click', function() {
                addJsonValueField();
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

            // File info display
            document.getElementById('file').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    document.getElementById('fileName').textContent = file.name;
                    document.getElementById('fileSize').textContent = formatFileSize(file.size);
                    document.getElementById('fileInfo').style.display = 'block';
                    
                    // Re-initialize Lucide icons
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                }
            });

            // Format file size helper
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
            }

            // Check on page load (for validation errors)
            window.addEventListener('DOMContentLoaded', function() {
                const typeSelect = document.getElementById('type');
                if (typeSelect.value === 'image') {
                    document.getElementById('imageUploadField').style.display = 'block';
                    const valueField = document.querySelector('[name="value"]').closest('div');
                    if (valueField) valueField.style.display = 'none';
                } else if (typeSelect.value === 'file') {
                    document.getElementById('fileField').style.display = 'block';
                    const valueField = document.querySelector('[name="value"]').closest('div');
                    if (valueField) valueField.style.display = 'none';
                } else if (typeSelect.value === 'json') {
                    document.getElementById('jsonFields').style.display = 'block';
                    const valueField = document.querySelector('[name="value"]').closest('div');
                    if (valueField) valueField.style.display = 'none';
                    
                    // Populate existing JSON data
                    if (Array.isArray(existingJsonData) && existingJsonData.length > 0) {
                        existingJsonData.forEach(key => {
                            addJsonValueField(key);
                        });
                    } else {
                        // Add at least one empty field
                        addJsonValueField();
                    }
                }
            });
        </script>
    @endpush
@endsection
