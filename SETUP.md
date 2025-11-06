# Quick Setup Guide

## ⚡ Quick Start (5 Minutes)

### Step 1: Install Dependencies
```bash
cd c:\laragon\www\loveable-laravel
composer install
npm install
```

### Step 2: Database Setup
```bash
# Database will be created automatically with SQLite
php artisan migrate:fresh --seed
```

### Step 3: Build Assets
```bash
npm run build
```

### Step 4: Start Server
```bash
php artisan serve
```

🎉 **Done!** Visit http://localhost:8000

## 🔐 Create Admin Account

1. Visit: http://localhost:8000/register
2. Fill in:
   - Name: Admin
   - Email: admin@example.com
   - Password: password (or your choice)
3. Click Register
4. Navigate to: http://localhost:8000/admin/projects

## 📝 Default Credentials

There are **6 sample projects** already seeded in the database. You can:
- View them on the homepage
- Filter them on `/projects` page
- Edit them in admin panel at `/admin/projects`

## 🎨 Customization Checklist

### Personal Information
- [ ] Update name in `resources/views/home.blade.php` (line 74)
- [ ] Update email in `resources/views/home.blade.php` (line 324)
- [ ] Update phone in `resources/views/home.blade.php` (line 328)
- [ ] Update social links in `resources/views/home.blade.php` (lines 125-139)
- [ ] Change profile image URL (line 59)

### Branding
- [ ] Update logo initials in `resources/views/components/header.blade.php` (line 15)
- [ ] Update site name in `resources/views/components/header.blade.php` (line 18)
- [ ] Update footer text in `resources/views/components/footer.blade.php`
- [ ] Replace favicon in `public/favicon.ico`

### Colors (Optional)
- [ ] Edit CSS variables in `resources/css/app.css`
- [ ] Rebuild with `npm run build`

## 🚀 Production Deployment

### Pre-Deployment Checklist
```bash
# 1. Update environment
cp .env .env.backup
# Edit .env:
# - Set APP_ENV=production
# - Set APP_DEBUG=false
# - Update APP_URL to your domain
# - Configure database for MySQL

# 2. Optimize
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Set permissions
chmod -R 755 storage bootstrap/cache
```

### Deploy to cPanel/Shared Hosting
1. Create database in cPanel
2. Upload all files except `.env`
3. Create `.env` file with production settings
4. Point domain to `/public` directory
5. Run migrations via terminal or PHP script

### Deploy to VPS (Ubuntu/Nginx)
```bash
# Install requirements
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-mysql nginx composer

# Clone project
cd /var/www
git clone <your-repo>

# Setup
cd loveable-laravel
composer install --no-dev
npm install && npm run build
php artisan migrate --force
php artisan key:generate

# Configure Nginx
# Point root to /var/www/loveable-laravel/public
sudo systemctl restart nginx
```

## 📞 Common Issues

### "Vite manifest not found"
```bash
npm run build
```

### "Database not found"
```bash
php artisan migrate:fresh --seed
```

### "Class not found"
```bash
composer dump-autoload
```

### "Route not found"
```bash
php artisan route:clear
php artisan route:cache
```

### Icons not showing
- Icons use Lucide CDN
- Requires internet connection
- Check browser console for errors
- Ensure `<script src="https://unpkg.com/lucide@latest"></script>` is loaded

## 🎯 Next Steps

1. ✅ Complete setup
2. ✅ Create admin account
3. ✅ Customize personal information
4. ✅ Add your own projects
5. ✅ Update images
6. ✅ Test dark/light mode
7. ✅ Deploy to production

## 📚 Documentation

- Full README: `README_LARAVEL.md`
- Laravel Docs: https://laravel.com/docs
- TailwindCSS: https://tailwindcss.com/docs
- Alpine.js: https://alpinejs.dev/start-here

---

Need help? Check the main README_LARAVEL.md for detailed documentation.
