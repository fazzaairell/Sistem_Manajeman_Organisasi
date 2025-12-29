<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Homepage\HomepageController;
use App\Http\Controllers\Homepage\EventHomeController;
use App\Http\Controllers\Homepage\AnnouncementHomeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GeneralController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\AnnouncementController;


Route::get('/', [HomepageController::class, 'index'])->name('home');

// Event public (tanpa login)
Route::get('/events', [EventHomeController::class, 'index'])->name('events.public');
Route::get('/announcements', [AnnouncementHomeController::class, 'index'])->name('announcements.public');

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
    Route::get('/dashboard/general', [GeneralController::class, 'index'])->name('general.profile');
    Route::put('/dashboard/general', [GeneralController::class, 'update'])->name('general.update');
    Route::put('/dashboard/general/change-password', [GeneralController::class, 'changePassword'])->name('general.change-password');

    // User Management routes (Admin only)
    Route::resource('/dashboard/users', UserController::class);
    Route::get('/dashboard/users-export-pdf', [UserController::class, 'exportPdf'])->name('users.export-pdf');

    // Event Routes
    Route::resource('/dashboard/events', EventController::class);

    // Announcement Routes
    Route::resource('/dashboard/announcements', AnnouncementController::class);

});
