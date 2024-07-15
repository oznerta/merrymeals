<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function registerMember(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'caregiver_name' => 'nullable|string|max:255',
            'caregiver_phone' => 'nullable|string|max:255',
        ]);

        // Create the member
        $member = Member::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'password' => bcrypt($validatedData['password']),
            'caregiver_name' => $validatedData['caregiver_name'],
            'caregiver_phone' => $validatedData['caregiver_phone'],
        ]);

        // Return a response
        return response()->json(['message' => 'Member registered successfully', 'member' => $member]);
    }
}

