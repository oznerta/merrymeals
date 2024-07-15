<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\MemberController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\RiderController;


Route::get('/', function () {
    return Inertia::render('Landing');
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
});




Route::post('/register-member', [MemberController::class, 'registerMember']);
Route::post('/register/kitchen', [KitchenController::class, 'register'])->name('kitchen.register');
Route::post('/register/rider', [RiderController::class, 'register'])->name('rider.register');