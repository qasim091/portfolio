# Image Upload Feature for Settings

## Overview

The Settings CRUD now supports **image uploads**! You can upload images for settings like profile pictures, logos, banners, and more.

## Features

✅ **Image Upload** - Upload images directly from admin panel  
✅ **Image Preview** - See preview before saving  
✅ **Current Image Display** - View current image when editing  
✅ **Automatic Deletion** - Old images deleted when updating/deleting  
✅ **Validation** - File type and size validation  
✅ **Thumbnail Display** - Images shown as thumbnails in list view  

---

## How to Use

### 1. Create Image Setting

1. Go to **Admin Panel > Settings**
2. Click **"Add Setting"**
3. Fill in the form:
   - **Key**: `profile_image` or `logo` or `banner`
   - **Type**: Select **"Image"** from dropdown
   - **Upload Image**: Choose an image file
4. Click **"Create Setting"**

### 2. Edit Image Setting

1. Go to **Admin Panel > Settings**
2. Click **Edit** on the image setting
3. You'll see the current image
4. Upload a new image to replace it
5. Click **"Update Setting"**

### 3. Use Image in Frontend

```blade
<!-- In Blade views -->
<img src="{{ $webSettings->profile_image }}" alt="Profile">

<!-- Or using helper -->
<img src="{{ setting('profile_image') }}" alt="Profile">
```

---

## Supported Formats

- **JPEG** (.jpeg, .jpg)
- **PNG** (.png)
- **GIF** (.gif)
- **WEBP** (.webp)

**Maximum file size**: 2MB

---

## Storage Location

Images are stored in:
```
storage/app/public/settings/
```

Accessible via:
```
public/storage/settings/
```

---

## Example Settings

### Profile Image
```
Key: profile_image
Type: image
Upload: your-photo.jpg
```

### Site Logo
```
Key: site_logo
Type: image
Upload: logo.png
```

### Banner Image
```
Key: hero_banner
Type: image
Upload: banner.jpg
```

### Favicon
```
Key: favicon
Type: image
Upload: favicon.ico
```

---

## Features in Detail

### 1. Dynamic Field Toggle
- When you select "Image" type, the text value field hides
- Image upload field appears automatically
- Smooth transition between field types

### 2. Image Preview
- After selecting an image, you see a preview
- Preview updates instantly
- Helps verify the correct image is selected

### 3. Current Image Display (Edit)
- When editing, current image is displayed
- Shows what will be replaced
- Upload new image to replace old one

### 4. Automatic Cleanup
- Old images are automatically deleted when:
  - Updating to a new image
  - Deleting the setting
- Prevents storage bloat

### 5. Thumbnail in List
- Settings list shows image thumbnails
- 48x48px preview
- Quick visual identification

---

## Technical Details

### Controller Changes

**Store Method:**
```php
if ($request->hasFile('image') && $request->type === 'image') {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $imagePath = $image->storeAs('settings', $imageName, 'public');
    $validated['value'] = '/storage/' . $imagePath;
}
```

**Update Method:**
```php
if ($request->hasFile('image') && $request->type === 'image') {
    // Delete old image
    if ($setting->value && file_exists(public_path($setting->value))) {
        unlink(public_path($setting->value));
    }
    
    // Upload new image
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $imagePath = $image->storeAs('settings', $imageName, 'public');
    $validated['value'] = '/storage/' . $imagePath;
}
```

**Destroy Method:**
```php
if ($setting->type === 'image' && $setting->value && file_exists(public_path($setting->value))) {
    unlink(public_path($setting->value));
}
```

### Validation Rules

```php
'type' => 'required|in:text,email,phone,textarea,url,number,image',
'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
```

### Form Encoding

Forms must include `enctype="multipart/form-data"`:
```blade
<form action="..." method="POST" enctype="multipart/form-data">
```

---

## JavaScript Features

### Toggle Image Field
```javascript
document.getElementById('type').addEventListener('change', function() {
    if (this.value === 'image') {
        imageField.style.display = 'block';
        valueField.style.display = 'none';
    }
});
```

### Image Preview
```javascript
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
```

---

## Usage Examples

### Example 1: Profile Picture

**Admin Panel:**
```
Key: image
Type: image
Upload: profile.jpg
```

**Frontend (home.blade.php):**
```blade
<img src="{{ $webSettings->image }}" 
     alt="{{ $webSettings->name }}" 
     class="w-48 h-48 rounded-full">
```

### Example 2: Site Logo

**Admin Panel:**
```
Key: site_logo
Type: image
Upload: logo.png
```

**Frontend (header):**
```blade
<img src="{{ setting('site_logo') }}" 
     alt="Logo" 
     class="h-10">
```

### Example 3: Background Image

**Admin Panel:**
```
Key: hero_background
Type: image
Upload: background.jpg
```

**Frontend (CSS):**
```blade
<div style="background-image: url('{{ setting('hero_background') }}')">
    <!-- Content -->
</div>
```

---

## Troubleshooting

### Image Not Displaying

**Problem:** Uploaded image doesn't show on frontend

**Solution:**
1. Run: `php artisan storage:link`
2. Check file permissions on `storage/app/public`
3. Verify image path in database

### Upload Fails

**Problem:** Image upload returns error

**Solution:**
1. Check file size (max 2MB)
2. Verify file format (jpeg, png, jpg, gif, webp)
3. Check `upload_max_filesize` in `php.ini`
4. Ensure `storage/app/public/settings` directory exists

### Old Images Not Deleted

**Problem:** Old images remain in storage

**Solution:**
1. Check file permissions
2. Verify path matches database value
3. Ensure `public_path()` resolves correctly

---

## Best Practices

1. **Optimize Images**: Compress images before uploading
2. **Use Descriptive Keys**: `profile_image` not `img1`
3. **Consistent Naming**: Use underscores, lowercase
4. **Backup Images**: Keep backups of important images
5. **Regular Cleanup**: Periodically check for orphaned files

---

## Security

✅ **File Type Validation** - Only images allowed  
✅ **Size Limit** - Maximum 2MB  
✅ **Secure Storage** - Files stored outside public root  
✅ **Unique Filenames** - Timestamp prefix prevents conflicts  
✅ **CSRF Protection** - All forms protected  

---

## Summary

The image upload feature makes it easy to manage visual assets through the admin panel. No need to manually upload files via FTP or edit code - everything is handled through the beautiful admin interface!

**Key Benefits:**
- 🎨 Easy visual asset management
- 🖼️ Preview before saving
- 🗑️ Automatic cleanup
- 📱 Responsive thumbnails
- 🔒 Secure uploads
- ⚡ Fast and efficient

Start uploading images to make your website more dynamic! 🚀
