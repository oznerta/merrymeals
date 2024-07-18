<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth.user' => function () use ($request) {
                $user = $request->user();
                if ($user) {
                    $role = $user->role;
                    switch ($role) {
                        case 'member':
                            return $user->only('id', 'first_name', 'last_name', 'email');
                        case 'rider':
                            return $user->only('id', 'first_name', 'last_name', 'email');
                        case 'kitchen':
                            return $user->only('id', 'first_name', 'last_name', 'email', 'restaurant_name', 'street_address', 'city', 'postal_code', 'state');
                        default:
                            return null;
                    }
                }
                return null;
            },
            'menus' => function () {
                return Menu::all(); // Adjust query as needed
            },
        ]);
    }
}
