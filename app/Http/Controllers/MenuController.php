<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kitchen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // Import the Gate facade
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        // Authorize the view action using the 'view-menu' gate
        if (Gate::denies('view-menu')) {
            abort(403, 'Unauthorized action.');
        }

        $menus = Menu::where('kitchen_id', Auth::id())->get();
        return inertia('Kitchens/Menu', ['menus' => $menus]);
    }

    public function store(Request $request)
    {
        // Authorize the create action using the 'create-menu' gate
        if (Gate::denies('create-menu')) {
            abort(403, 'Unauthorized action.');
        }

        $fields = $request->validate([
            'meal_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:1024', // 1MB max
        ]);

        $fields['kitchen_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $fields['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($fields);

        return redirect()->route('kitchen.menu')->with('success', 'Menu created successfully.');
    }

    public function update(Request $request, Menu $menu)
    {
        // Authorize the update action using the 'update-menu' gate
        if (Gate::denies('update-menu', $menu)) {
            abort(403, 'Unauthorized action.');
        }

        $fields = $request->validate([
            'meal_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:1024', // 1MB max
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $fields['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($fields);

        return redirect()->route('kitchen.menu')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        // Authorize the delete action using the 'delete-menu' gate
        if (Gate::denies('delete-menu', $menu)) {
            abort(403, 'Unauthorized action.');
        }

        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('kitchen.menu')->with('success', 'Menu deleted successfully.');
    }


    public function show($kitchen_name)
    {
        // Fetch the kitchen based on the name
        $kitchen = Kitchen::where('restaurant_name', $kitchen_name)->firstOrFail();

        // Optionally, fetch menus related to this kitchen
        $menus = $kitchen->menus()->get(); // Assuming Kitchen has a relationship with Menu model

        // Return the view or Inertia response for the menu page
        return inertia('Members/Menu', [
            'selectedKitchen' => $kitchen, // Ensure this matches your prop name in Vue component
            'menus' => $menus,
        ]);
    }

    public function updateKitchen(Request $request, Kitchen $kitchen)
    {
        // Authorize the update action using the 'update-member' gate
        // if (Gate::denies('update-member')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $kitchen = auth()->user();


        $fields = $request->validate([
            'restaurant_name' => ['string','max:255'],
            'first_name' => [ 'string', 'max:255'],
            'last_name' => [ 'string', 'max:255'],
            'email' => ['email', 'max:255', 'unique:kitchens'],
            'street_address' => [ 'string', 'max:255'],
            'city' => [ 'string', 'max:255'],
            'postal_code' => [ 'string', 'max:255'],
            'state' => [ 'string', 'max:255'],
            'phone_number' => [ 'string', 'max:255'],
            'password' => [ 'string', 'min:8', 'confirmed'],
        ]);

        //can be used for member profile picture
        // if ($request->hasFile('image')) {
        //     if ($member->image) {
        //         Storage::disk('public')->delete($menu->image);
        //     }
        //     $fields['image'] = $request->file('image')->store('menus', 'public');
        // }

        $kitchen->update($fields);

        return redirect()->route('kitchen.profile')->with('success', 'Kitchen profile updated successfully.');
    }

}
