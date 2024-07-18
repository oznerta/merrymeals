<?php

namespace App\Policies;

use App\Models\Kitchen; // Import specific user types
use App\Models\Menu;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    // Adjust methods to accept specific user types
    public function view(Kitchen $kitchen, Menu $menu)
    {
        // Only allow kitchen to view menus associated with their kitchen_id
        if ($kitchen->role === 'kitchen' && $kitchen->id === $menu->kitchen_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this menu.');
    }

    public function create(Kitchen $kitchen)
    {
        return $kitchen->role === 'kitchen'
            ? Response::allow()
            : Response::deny('Only kitchens can create menus.');
    }

    public function update(Kitchen $kitchen, Menu $menu)
    {
        return $kitchen->role === 'kitchen' && $kitchen->id === $menu->kitchen_id
            ? Response::allow()
            : Response::deny('You do not have permission to update this menu.');
    }

    public function delete(Kitchen $kitchen, Menu $menu)
    {
        return $kitchen->role === 'kitchen' && $kitchen->id === $menu->kitchen_id
            ? Response::allow()
            : Response::deny('You do not have permission to delete this menu.');
    }
}
