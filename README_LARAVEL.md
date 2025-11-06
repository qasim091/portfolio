# Laravel Portfolio - Alex Morgan

A fully-featured Laravel portfolio website converted from React, featuring dynamic content management, dark/light mode, and a complete admin panel.

## 🚀 Features

### Frontend
- ✨ **Responsive Design** - Mobile-first, fully responsive layout
- 🎨 **Dark/Light Mode** - Toggle between themes with persistent state
- 🎭 **Modern UI** - TailwindCSS with custom theme and animations
- 📱 **Smooth Animations** - CSS animations and transitions
- 🔍 **Project Filtering** - Search and category-based filtering
- 📄 **Dynamic Pages** - All content pulled from database

### Backend
- 🔐 **Authentication** - Laravel Breeze for secure login
- 👨‍💼 **Admin Panel** - Full CRUD operations for projects
- 📊 **Database-Driven** - MySQL/SQLite with Eloquent ORM
- 🏷️ **SEO-Friendly** - Proper meta tags and semantic HTML
- 🔄 **Real-time Updates** - Changes reflect immediately
- 🎯 **Slug-based URLs** - SEO-friendly project URLs

### Tech Stack
- **Framework**: Laravel 11.x
- **Frontend**: Blade Templates + TailwindCSS
- **Icons**: Lucide Icons
- **Interactivity**: Alpine.js
- **Database**: SQLite (easily changeable to MySQL)
- **Authentication**: Laravel Breeze

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (or MySQL)

### Setup Steps

1. **Clone the repository**
```bash
cd c:\laragon\www\loveable-laravel
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Environment Configuration**
```bash
# The .env file should already exist
# Update database settings if needed
```

5. **Generate Application Key**
```bash
php artisan key:generate
```

6. **Run Migrations & Seed Database**
```bash
php artisan migrate:fresh --seed
```

7. **Build Assets**
```bash
npm run build
# Or for development with hot reload:
npm run dev
```

8. **Start Development Server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 🎨 Dark/Light Mode

The theme toggle is implemented using Alpine.js and persists across page loads using localStorage. Users can switch between themes using the sun/moon icon in the header.

### Implementation
- CSS variables in `resources/css/app.css`
- Alpine.js for state management
- TailwindCSS dark mode classes
- Persistent storage with localStorage

## 📁 Project Structure

```
loveable-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php          # Homepage controller
│   │       ├── ProjectController.php       # Public project pages
│   │       └── Admin/
│   │           └── ProjectController.php   # Admin CRUD
│   └── Models/
│       └── Project.php                     # Project model with scopes
├── database/
│   ├── migrations/
│   │   └── *_create_projects_table.php    # Projects database schema
│   └── seeders/
│       └── ProjectSeeder.php              # Sample project data
├── resources/
│   ├── css/
│   │   └── app.css                        # Tailwind + custom styles
│   └── views/
│       ├── layouts/
│       │   └── portfolio.blade.php        # Main portfolio layout
│       ├── components/
│       │   ├── header.blade.php          # Navigation header
│       │   └── footer.blade.php          # Footer component
│       ├── home.blade.php                # Homepage
│       ├── projects/
│       │   ├── index.blade.php           # All projects page
│       │   └── show.blade.php            # Project detail page
│       └── admin/
│           └── projects/
│               └── index.blade.php       # Admin dashboard
├── routes/
│   └── web.php                           # All application routes
└── public/
    ├── favicon.ico
    ├── placeholder.svg
    └── robots.txt
```

## 🎯 Routes

### Public Routes
- `/` - Homepage with hero, projects, about, and contact sections
- `/projects` - All projects with search and filtering
- `/projects/{slug}` - Individual project details

### Admin Routes (Authentication Required)
- `/admin/projects` - Project management dashboard
- `/admin/projects/create` - Create new project
- `/admin/projects/{id}/edit` - Edit existing project
- `/admin/projects/{id}` - Delete project

### Auth Routes (Laravel Breeze)
- `/register` - User registration
- `/login` - User login
- `/dashboard` - User dashboard
- `/profile` - User profile management

## 👨‍💼 Admin Panel

### Accessing Admin Panel
1. Register a user account at `/register`
2. Login at `/login`
3. Navigate to `/admin/projects`

### Features
- ✅ Create new projects
- ✏️ Edit existing projects
- 🗑️ Delete projects
- 👀 Preview projects
- 📊 View all projects in table format
- ✨ Mark projects as featured
- 🔢 Set project order

### Project Fields
- Title
- Slug (auto-generated)
- Short Description
- Long Description
- Technologies (array)
- Images (array of URLs)
- Category
- GitHub URL
- Live Demo URL
- Features (array)
- Challenges
- Outcome
- Featured status
- Display order

## 🎨 Customization

### Update Site Information
Edit the following files:
- `resources/views/layouts/portfolio.blade.php` - Meta tags, title
- `resources/views/components/header.blade.php` - Logo, navigation
- `resources/views/components/footer.blade.php` - Footer text
- `resources/views/home.blade.php` - About section, contact info

### Change Colors
Edit `resources/css/app.css`:
```css
:root {
  --primary: 195 100% 45%;      /* Main brand color */
  --secondary: 280 65% 55%;     /* Secondary color */
  --background: 210 30% 96%;    /* Background */
  --foreground: 220 40% 10%;    /* Text color */
}

.dark {
  /* Dark mode colors */
}
```

### Add More Projects
1. Navigate to `/admin/projects`
2. Click "Add New Project"
3. Fill in all fields
4. Upload image URLs (use Unsplash or your own hosting)
5. Save

Or via Seeder:
Edit `database/seeders/ProjectSeeder.php` and run:
```bash
php artisan db:seed --class=ProjectSeeder
```

## 🚀 Deployment

### Production Build
```bash
# Build assets for production
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment Variables
Update `.env` for production:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Use MySQL in production
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Server Requirements
- PHP 8.2+
- MySQL 5.7+ or PostgreSQL 9.6+
- Nginx or Apache
- Composer
- Node.js (for building assets)

### Recommended Hosting
- **Shared Hosting**: Upload via FTP, point to `/public` directory
- **VPS**: Use Laravel Forge or manual setup
- **Cloud**: AWS, DigitalOcean, Linode
- **Platform**: Laravel Vapor, Heroku, Platform.sh

## 📊 Database

### Schema
The `projects` table includes:
- `id` - Primary key
- `title` - Project title
- `slug` - URL-friendly slug
- `description` - Short description
- `long_description` - Detailed description
- `tech` - JSON array of technologies
- `images` - JSON array of image URLs
- `github` - GitHub repository URL
- `live` - Live demo URL
- `category` - Project category
- `features` - JSON array of key features
- `challenges` - Text description of challenges
- `outcome` - Text description of outcome
- `is_featured` - Boolean for homepage display
- `order` - Integer for sorting
- `created_at` - Timestamp
- `updated_at` - Timestamp

### Switching to MySQL
Update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_portfolio
DB_USERNAME=root
DB_PASSWORD=
```

Then run:
```bash
php artisan migrate:fresh --seed
```

## 🔧 Troubleshooting

### Assets not loading
```bash
npm run build
php artisan view:clear
```

### Database issues
```bash
php artisan migrate:fresh --seed
```

### Permission errors
```bash
chmod -R 775 storage bootstrap/cache
```

### Route not found
```bash
php artisan route:clear
php artisan route:cache
```

## 📝 Key Differences from React Version

### What's Converted
✅ All pages (Home, Projects List, Project Detail)
✅ Dark/Light mode with persistence
✅ Responsive design and animations
✅ Search and filtering functionality
✅ Database-driven content
✅ Admin panel for content management

### What's Different
- **Framer Motion animations** → CSS animations & transitions
- **React Router** → Laravel routes
- **React State** → Blade directives & Alpine.js
- **Static data** → Dynamic database content
- **No backend** → Full Laravel backend with auth

### What's Enhanced
✅ **Authentication system** (Laravel Breeze)
✅ **Admin panel** for CRUD operations
✅ **Database integration** with MySQL/SQLite
✅ **SEO optimization** with proper meta tags
✅ **Server-side rendering** for better performance
✅ **Pagination** for projects listing

## 🆘 Support

For issues or questions:
1. Check Laravel documentation: https://laravel.com/docs
2. Check TailwindCSS documentation: https://tailwindcss.com/docs
3. Review this README
4. Check the code comments

## 📜 License

This project is open-source and available for personal and commercial use.

## 🎉 Credits

- **Original React Version**: Loveable Platform
- **Laravel Conversion**: Complete rebuild with backend integration
- **UI Framework**: TailwindCSS
- **Icons**: Lucide Icons
- **Images**: Unsplash

---

**Happy Coding! 🚀**
