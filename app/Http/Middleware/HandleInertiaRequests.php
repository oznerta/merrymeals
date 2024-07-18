<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Kitchen;
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
                            return $user->only('id', 'first_name', 'last_name', 'email', 'latitude', 'longitude');
                        case 'rider':
                            return $user->only('id', 'first_name', 'last_name', 'email', 'latitude', 'longitude');
                        case 'kitchen':
                            return $user->only('id', 'first_name', 'last_name', 'email', 'restaurant_name', 'street_address', 'city', 'postal_code', 'state', 'latitude', 'longitude');
                        default:
                            return null;
                    }
                }
                return null;
            },
            'menus' => function () {
                return Menu::all();
            },
            'nearbyKitchens' => function () use ($request) {
                $user = $request->user();
                if (!$user) {
                    return [
                        'nearby' => [],
                        'all' => []
                    ];
                }

                $memberLatitude = $user->latitude ?? 0; // Default to 0 if latitude is not set
                $memberLongitude = $user->longitude ?? 0; // Default to 0 if longitude is not set

                // Fetch kitchens within a 10km radius
                $nearbyKitchens = Kitchen::select('id', 'restaurant_name', 'street_address', 'city', 'postal_code', 'state')
                    ->selectRaw(
                        '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                        [$memberLatitude, $memberLongitude, $memberLatitude]
                    )
                    ->having('distance', '<', 10) // Within 10 kilometers
                    ->orderBy('distance')
                    ->get();

                // Fetch all kitchens (excluding nearby) for display
                $allKitchens = Kitchen::select('id', 'restaurant_name', 'street_address', 'city', 'postal_code', 'state')
                    ->whereNotIn('id', $nearbyKitchens->pluck('id')->toArray())
                    ->get();

                return [
                    'nearby' => $nearbyKitchens,
                    'all' => $allKitchens,
                ];
            },

        ]);
    }
}
