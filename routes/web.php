<?php

use App\Http\Controllers\Homepage\ProfileController;
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
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\EventRegistrationController;


Route::get('/', [HomepageController::class, 'index'])->name('home');

// Event public (tanpa login)
Route::get('/events', [EventHomeController::class, 'index'])->name('events.public');
Route::get('/announcements', [AnnouncementHomeController::class, 'index'])->name('announcements.public');
Route::post('/events/{event}/register', [EventHomeController::class, 'register'])
    ->middleware('auth') 
    ->name('events.register');
Route::get('/events/{event}', [EventHomeController::class, 'show'])->name('events.show');

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('homepage', [HomepageController::class, 'index']);



});

// Route menampilkan profile user
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [ProfileController::class, 'index'])->name('profile.index');
});


// Route yang diproteksi (harus login)
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Profile routes (accessible by all authenticated users)
    Route::get('/dashboard/profile', [GeneralController::class, 'index'])->name('general.profile');
    Route::put('/dashboard/profile', [GeneralController::class, 'update'])->name('general.update');
    Route::put('/dashboard/profile/change-password', [GeneralController::class, 'changePassword'])->name('general.change-password');

    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Management routes (Admin only)
        // PDF Export MUST come before resource route
        Route::get('/dashboard/users/export-pdf', [UserController::class, 'exportPdf'])->name('users.export-pdf');
        Route::resource('/dashboard/users', UserController::class);

        // Event Routes (Admin only)
        // PDF Export MUST come before resource route
        Route::get('/dashboard/events/export-pdf', [EventController::class, 'exportPdf'])->name('events.export-pdf');
        Route::resource('/dashboard/events', EventController::class);

        // Event Registration Management (Admin only)
        // PDF Export MUST come before other routes
        Route::get('/dashboard/event-registrations/export-pdf', [EventRegistrationController::class, 'exportPdf'])->name('event-registrations.export-pdf');
        Route::get('/dashboard/event-registrations', [EventRegistrationController::class, 'index'])->name('event-registrations.index');
        Route::get('/dashboard/event-registrations/{eventRegistration}', [EventRegistrationController::class, 'show'])->name('event-registrations.show');
        Route::patch('/dashboard/event-registrations/{eventRegistration}/approve', [EventRegistrationController::class, 'approve'])->name('event-registrations.approve');
        Route::patch('/dashboard/event-registrations/{eventRegistration}/reject', [EventRegistrationController::class, 'reject'])->name('event-registrations.reject');
        Route::post('/dashboard/event-registrations/bulk-approve', [EventRegistrationController::class, 'bulkApprove'])->name('event-registrations.bulk-approve');

        // Announcement Routes (Admin only)
        // PDF Export MUST come before resource route
        Route::get('/dashboard/announcements/export-pdf', [AnnouncementController::class, 'exportPdf'])->name('announcements.export-pdf');
        Route::resource('/dashboard/announcements', AnnouncementController::class);

        // Gallery Routes (Admin only)
        Route::resource('dashboard/gallery', GalleryController::class);

    });


});
