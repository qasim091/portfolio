<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [HomeController::class, 'project'])->name('projects.index');
Route::get('/projects/{slug}', [HomeController::class, 'projectshow'])->name('projects.show');

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

   // -------------------- CATEGORY ROUTES --------------------
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


// -------------------- PROJECT ROUTES --------------------
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');


// -------------------- SETTING ROUTES --------------------
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::get('settings/create', [SettingController::class, 'create'])->name('settings.create');
Route::post('settings', [SettingController::class, 'store'])->name('settings.store');
Route::get('settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
Route::delete('settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');
Route::get('settings/{setting}', [SettingController::class, 'show'])->name('settings.show');

});

require __DIR__.'/auth.php';
