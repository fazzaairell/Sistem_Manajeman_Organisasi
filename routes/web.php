<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageController;

Route::get('/', [HomepageController::class, 'index'])->name('home');

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('homepage', [HomepageController::class, 'index']);

});

// Route yang diproteksi (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // General routes
    Route::get('/general', [GeneralController::class, 'index'])->name('general.profile');
    Route::put('/general', [GeneralController::class, 'update'])->name('general.update');
    // Route::put('/general/change-password', [GeneralController::class, 'changePassword'])->name('general.change-password');

    // User Management routes (Admin only)
    Route::resource('users', UserController::class);
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users-export-pdf', [UserController::class, 'exportPdf'])->name('users.export-pdf');

    // Event Routes
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store'); 
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Announcement Routes
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcement/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

});
