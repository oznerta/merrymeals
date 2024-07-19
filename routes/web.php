<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderNoteController;

// ------------------------------------------Public Routes------------------------------------------>>>>>>>>>>>>
Route::inertia('/', 'Home')->name('home');

// Authentication Routes
Route::inertia('/register', 'Auth/Register')->name('register')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register/member', [RegisterController::class, 'registerMember'])->name('register.submit')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register/rider', [RegisterController::class, 'registerRider'])->name('register.rider.submit')->middleware([RedirectIfAuthenticated::class]);
Route::post('/register/kitchen', [RegisterController::class, 'registerKitchen'])->name('register.kitchen.submit')->middleware([RedirectIfAuthenticated::class]);
Route::inertia('/login', 'Auth/Login')->name('login')->middleware([RedirectIfAuthenticated::class]);
Route::post('/login', [LoginController::class, 'loginUsers'])->name('login.submit')->middleware([RedirectIfAuthenticated::class]);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');




// -------------------------------------------Private Routes------------------------------------------>>>>>>>>>>>>
// Member routes
Route::middleware(['auth:member', 'verified'])->group(function () {
    Route::inertia('/member/restaurant', 'Members/Restaurant')->name('member.restaurant');
    Route::inertia('/member/profile', 'Members/Profile')->name('member.profile');
    Route::inertia('/member/order', 'Members/Order')->name('order.waiting');
    Route::put('/member/profile', [MemberController::class, 'update'])->name('member.update');

    // Route to fetch nearby kitchens
    Route::get('/get-nearby-kitchens', [MemberController::class, 'getNearbyKitchens'])->name('get-nearby-kitchens');

    // Menu routes
    Route::get('/member/menu/{kitchen_name}', [MenuController::class, 'show'])->name('member.menu');

    Route::get('/member/{restaurant_name}/{menu_name}/order', [OrderController::class, 'showOrderConfirmation'])->name('order.confirmation');

    Route::get('/order/confirmation', [OrderController::class, 'showOrderConfirmation'])->name('order.confirmation');

    Route::post('/order', [OrderController::class, 'store'])->name('order.store');


    

});

// Rider routes
Route::middleware(['auth:rider', 'verified'])->group(function () {
    Route::inertia('/rider/dashboard', 'Riders/dashboard')->name('rider.dashboard');
});

// Kitchen routes
Route::middleware(['auth:kitchen', 'verified'])->group(function () {
    Route::inertia('/kitchen/menu', 'Kitchens/Menu')->name('kitchen.menu');
    Route::inertia('/kitchen/profile', 'Kitchens/Profile')->name('kitchen.profile');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::put('/kitchen/profile', [MenuController::class, 'updateKitchen'])->name('kitchen.update');

});




