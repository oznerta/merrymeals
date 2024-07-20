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
use App\Http\Controllers\RiderController;
use Carbon\Carbon;
use App\Models\Order;
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

    Route::put('/member/profile', [MemberController::class, 'update'])->name('member.update');
    Route::get('/member/order/{orderId}', [OrderController::class, 'showWaitingPage'])->name('order.waiting');

    // Route to fetch nearby kitchens
    Route::get('/get-nearby-kitchens', [MemberController::class, 'getNearbyKitchens'])->name('get-nearby-kitchens');

    // Menu routes
    Route::get('/member/menu/{kitchen_name}', [MenuController::class, 'show'])->name('member.menu');

    Route::get('/member/{restaurant_name}/{menu_name}/order', [OrderController::class, 'showOrderConfirmation'])->name('order.confirmation');

    Route::get('/order/confirmation', [OrderController::class, 'showOrderConfirmation'])->name('order.confirmation');

    Route::post('/order', [OrderController::class, 'store'])->name('order.store');


    Route::get('/api/current-order', function () {
        $memberId = Auth::id();
        $today = Carbon::today();

        $order = Order::where('member_id', $memberId)
            ->whereDate('created_at', $today)
            ->first();

        return response()->json([
            'orderId' => $order ? $order->id : null,
        ]);
    });



    

});

// Rider routes
Route::middleware(['auth:rider', 'verified'])->group(function () {
    Route::inertia('/rider/dashboard', 'Riders/dashboard')->name('rider.dashboard');
    Route::inertia('/rider/profile', 'Riders/Profile')->name('rider.profile');
    Route::inertia('/rider/orders','Riders/Orders')->name('rider.orders');

    Route::put('/rider/profile', [RiderController::class, 'updateRider'])->name('rider.update');
});

// Kitchen routes
Route::middleware(['auth:kitchen', 'verified'])->group(function () {
    Route::inertia('/kitchen/orders', 'Kitchens/Orders')->name('kitchen.orders');
    Route::inertia('/kitchen/menu', 'Kitchens/Menu')->name('kitchen.menu');
    Route::inertia('/kitchen/profile', 'Kitchens/Profile')->name('kitchen.profile');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::put('/kitchen/profile', [MenuController::class, 'updateKitchen'])->name('kitchen.update');

    Route::post('/orders/{order}/accept', [OrderController::class, 'acceptOrder'])->name('orders.accept');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    
    // Add these routes for specific status updates
    Route::post('/orders/{order}/cooked', [OrderController::class, 'markAsCooked'])->name('orders.cooked');
    Route::post('/orders/{order}/on-its-way', [OrderController::class, 'markAsOnItsWay'])->name('orders.onItsWay');
    Route::post('/orders/{order}/complete', [OrderController::class, 'markAsComplete'])->name('orders.complete');

});




