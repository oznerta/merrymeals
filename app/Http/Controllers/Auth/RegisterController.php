<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Rider;
use App\Models\Kitchen;
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
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'caregiver_name' => ['nullable', 'string', 'max:255'],
            'caregiver_phone' => ['nullable', 'string', 'max:255'],
        ]);

        // Register the member
        $member = Member::create($fields);

        // Login member
        Auth::guard('member')->login($member);

        // Return a response
        return redirect()->route('member.dashboard');
    }

    public function registerRider(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:riders'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Register the rider
        $rider = Rider::create($fields);

        // Login rider
        Auth::guard('rider')->login($rider);

        // Return a response
        return redirect()->route('rider.dashboard');
    }

    public function registerKitchen(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'restaurant_name' => ['required', 'string','max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:kitchens'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Register the kitchen
        $kitchen = Kitchen::create($fields);

        // Login kitchen
        Auth::guard('kitchen')->login($kitchen);

        // Return a response
        return redirect()->route('kitchen.dashboard');
    }



}
