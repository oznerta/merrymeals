<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kitchen;

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
}
