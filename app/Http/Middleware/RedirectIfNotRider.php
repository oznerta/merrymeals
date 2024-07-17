<?php

// RedirectIfNotRider.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRider
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('rider')->check()) {
            return redirect()->route('rider.dashboard');
        }

        return $next($request);
    }
}
