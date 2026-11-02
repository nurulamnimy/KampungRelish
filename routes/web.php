<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorProfileController;
use Illuminate\Support\Facades\Route;

// ---------- public pages ----------
Route::redirect('/', '/home');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// ---------- guest only (not logged in) ----------
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

// ---------- logged in users ----------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    // ----- admin only -----
    Route::middleware('admin')->group(function () {
        Route::get('/experiences/create', [ExperienceController::class, 'create'])->name('experiences.create');
        Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
        Route::get('/experiences/{experience}/edit', [ExperienceController::class, 'edit'])->name('experiences.edit');
        Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
        Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

        Route::resource('vendors', VendorProfileController::class)->except(['show']);
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    });

    // ----- admin + user -----
    Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::get('/experiences/{experience}', [ExperienceController::class, 'show'])->name('experiences.show');

    Route::resource('bookings', BookingController::class)->except(['show']);

    Route::get('/experiences/{experience}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/experiences/{experience}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
