<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Kitchen;
use App\Models\Order;
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
            'menus' => function () use ($request) {
                $user = $request->user();
                if ($user && $user->role === 'kitchen') {
                    return Menu::where('kitchen_id', $user->id)->get();
                }
                return [];
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
                    ->get()
                    ->each(function ($kitchen) {
                    $kitchen->distance = round($kitchen->distance);
                });

                // Fetch all kitchens (excluding nearby) and calculate distance
                $allKitchens = Kitchen::select('id', 'restaurant_name', 'street_address', 'city', 'postal_code', 'state', 'latitude', 'longitude')
                    ->whereNotIn('id', $nearbyKitchens->pluck('id')->toArray())
                    ->get()
                    ->each(function ($kitchen) use ($memberLatitude, $memberLongitude) {
                    $kitchen->distance = round(
                        6371 * acos(
                            cos(deg2rad($memberLatitude)) * cos(deg2rad($kitchen->latitude)) *
                            cos(deg2rad($kitchen->longitude) - deg2rad($memberLongitude)) +
                            sin(deg2rad($memberLatitude)) * sin(deg2rad($kitchen->latitude))
                        )
                    );
                });

                return [
                    'nearby' => $nearbyKitchens,
                    'all' => $allKitchens,
                ];
            },
            'selectedKitchen' => function () use ($request) {
                $restaurantName = $request->route('restaurant_name');

                // Fetch the kitchen details by restaurant name
                $kitchen = Kitchen::where('restaurant_name', $restaurantName)->first();

                if (!$kitchen) {
                    return null; // Handle case where kitchen is not found
                }

                // Fetch menus based on the selected kitchen's ID
                $menus = Menu::where('kitchen_id', $kitchen->id)->get();

                // Calculate distance for the selected kitchen
                $user = $request->user();
                if ($user) {
                    $memberLatitude = $user->latitude ?? 0;
                    $memberLongitude = $user->longitude ?? 0;
                    $kitchen->distance = round(6371 * acos(
                        cos(deg2rad($memberLatitude)) * cos(deg2rad($kitchen->latitude)) *
                        cos(deg2rad($kitchen->longitude) - deg2rad($memberLongitude)) +
                        sin(deg2rad($memberLatitude)) * sin(deg2rad($kitchen->latitude))
                    )
                    );
                }

                return [
                    'kitchen' => $kitchen,
                    'menus' => $menus,
                ];
            },
            'orderDetails' => function () use ($request) {
            $orderId = $request->route('order');
            if (!$orderId) {
                return null;
            }

            $order = Order::with(['member', 'menu', 'kitchen'])->find($orderId);

            if (!$order) {
                return null;
            }

            return [
                'order' => $order,
                'status'=>$order->status,
                'member' => $order->member,
                'menu' => $order->menu,
                'kitchen' => $order->kitchen,
                'call_upon_arrival' => $order->call_upon_arrival,
                'ring_the_doorbell' => $order->ring_the_doorbell,
                'notes' => $order->notes,
            ];
        },
        'orders' => function () use ($request) {
            if ($request->user() && $request->user()->role === 'kitchen' || 'rider') {
                return Order::with('menu', 'member')->get();
            }

        }


        ]);
    }
}
