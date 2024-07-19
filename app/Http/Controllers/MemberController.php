<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Import the Gate facade
use App\Models\Kitchen;
use App\Models\Member;

class MemberController extends Controller
{
    public function getNearbyKitchens(Request $request)
    {
        // Assume member's latitude and longitude are available from request parameters
        $memberLatitude = $request->input('latitude');
        $memberLongitude = $request->input('longitude');

        $kitchens = Kitchen::select('id', 'restaurant_name', 'latitude', 'longitude')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$memberLatitude, $memberLongitude, $memberLatitude]
            )
            ->having('distance', '<', 10) // Example radius of 10 kilometers
            ->orderBy('distance')
            ->get();

        return response()->json($kitchens);
    }

    public function update(Request $request, Member $member)
    {
        // Authorize the update action using the 'update-member' gate
        // if (Gate::denies('update-member')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $member = auth()->user();


        $fields = $request->validate([
            'first_name' => [ 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => [ 'email', 'max:255', 'unique:members'],
            'street_address' => [ 'string', 'max:255'],
            'city' => [ 'string', 'max:255'],
            'postal_code' => [ 'string', 'max:255'],
            'state' => ['string', 'max:255'],
            'phone_number' => [ 'string', 'max:255'],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);

        //can be used for member profile picture
        // if ($request->hasFile('image')) {
        //     if ($member->image) {
        //         Storage::disk('public')->delete($menu->image);
        //     }
        //     $fields['image'] = $request->file('image')->store('menus', 'public');
        // }

        $member->update($fields);

        return redirect()->route('member.profile')->with('success', 'Menu updated successfully.');
    }

}
