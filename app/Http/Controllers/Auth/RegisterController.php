<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class RegisterController
{
    // -----------------------------------------Member Registration--------------------------------------------------------------------
    public function registerMember(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:members'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'caregiver_name' => ['nullable', 'string', 'max:255'],
            'caregiver_phone' => ['nullable', 'string', 'max:255'],
        ]);

        // Register the member
        $member = Member::create($fields);

        // Login
        Auth::login($member);

        // Return a response
        return redirect()->route('/');
    }



}
