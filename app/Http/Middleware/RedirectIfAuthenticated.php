<?php

// RedirectIfAuthenticated.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('member.dashboard');
        }

        if (Auth::guard('rider')->check()) {
            return redirect()->route('rider.dashboard');
        }

        if (Auth::guard('kitchen')->check()) {
            return redirect()->route('kitchen.dashboard');
        }

        return $next($request);
    }
}

