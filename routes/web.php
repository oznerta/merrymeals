<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\RedirectIfAuthenticated;

// -------------------------------------------Public Routes------------------------------------------>>>>>>>>>>>>
// Home route 
Route::inertia('/', 'Home')->name('home');

// Register routes
Route::inertia('/register', 'Auth/Register')->name('register')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register/member', [RegisterController::class, 'registerMember'])->name('register.submit')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register/rider', [RegisterController::class, 'registerRider'])->name('register.rider.submit')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register/kitchen', [RegisterController::class, 'registerKitchen'])->name('register.kitchen.submit')->middleware([RedirectIfAuthenticated::class]);


// Login & Logout routes
Route::inertia('/login', 'Auth/Login')->name('login')->middleware([RedirectIfAuthenticated::class]);
Route::post('/login', [LoginController::class, 'loginUsers'])->name('login.submit')->middleware([RedirectIfAuthenticated::class]);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');




// -------------------------------------------Private Routes------------------------------------------>>>>>>>>>>>>
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




