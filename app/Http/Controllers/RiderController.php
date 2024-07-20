<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;

class RiderController extends Controller
{

    public function updateRider(Request $request, Rider $rider)
    {
        // Authorize the update action using the 'update-member' gate
        // if (Gate::denies('update-member')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $rider = auth()->user();


        $fields = $request->validate([
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', 'unique:members'],
            'street_address' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'postal_code' => ['string', 'max:255'],
            'state' => ['string', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);

        //can be used for member profile picture
        // if ($request->hasFile('image')) {
        //     if ($member->image) {
        //         Storage::disk('public')->delete($menu->image);
        //     }
        //     $fields['image'] = $request->file('image')->store('menus', 'public');
        // }

        $rider->update($fields);

        return redirect()->route('rider.profile')->with('success', 'Menu updated successfully.');
    }

}
