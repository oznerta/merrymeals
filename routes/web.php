<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\RedirectIfAuthenticated;

// Home route 
Route::inertia('/', 'Home')->name('home');

// Register routes
Route::inertia('/register', 'Auth/Register')->name('register')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register', [RegisterController::class, 'registerMember'])->name('register.submit')->middleware([RedirectIfAuthenticated::class]);

// Login routes
Route::inertia('/login', 'Auth/Login')->name('login')->middleware([RedirectIfAuthenticated::class]);
Route::post('/login', [LoginController::class, 'loginUsers'])->name('login.submit')->middleware([RedirectIfAuthenticated::class]);



// Member routes
Route::middleware(['auth:member', 'verified'])->group(function () {
    Route::inertia('/member/dashboard', 'Members/dashboard')->name('member.dashboard');
    Route::inertia('/member/sample', 'Members/sample')->name('member.sample');
});

// Rider routes
Route::middleware(['auth:rider', 'verified'])->group(function () {
    Route::inertia('/rider/dashboard', 'Riders/dashboard')->name('rider.dashboard');
});

// Kitchen routes
Route::middleware(['auth:kitchen', 'verified'])->group(function () {
    Route::inertia('/kitchen/dashboard', 'Kitchens/dashboard')->name('kitchen.dashboard');
});




