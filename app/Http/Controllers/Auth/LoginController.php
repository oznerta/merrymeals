<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class LoginController extends Controller
{
    public function loginUsers(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to login using the member guard
        if (Auth::guard('member')->attempt(['email' => $fields['email'], 'password' => $fields['password']])) {
            $request->session()->regenerate();
            return redirect()->route('member.restaurant');
        }

        // Attempt to login using the rider guard
        if (Auth::guard('rider')->attempt(['email' => $fields['email'], 'password' => $fields['password']])) {
            $request->session()->regenerate();
            return redirect()->route('rider.dashboard');
        }

        // Attempt to login using the kitchen guard
        if (Auth::guard('kitchen')->attempt(['email' => $fields['email'], 'password' => $fields['password']])) {
            $request->session()->regenerate();
            return redirect()->route('kitchen.menu');
        }

        return response()->json([
            'errors' => ['email' => 'The provided credentials do not match our records.'],
        ], 422);
    }
}

