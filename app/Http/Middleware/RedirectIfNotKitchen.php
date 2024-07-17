<?php


// RedirectIfNotKitchen.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotKitchen
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('kitchen')->check()) {
            return redirect()->route('kitchen.dashboard');
        }

        return $next($request);
    }
}

