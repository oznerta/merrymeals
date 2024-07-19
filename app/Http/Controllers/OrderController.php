<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Kitchen;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display the order confirmation page.
     */

    /**
     * Store a new order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'call_upon_arrival' => 'nullable|boolean',
            'ring_the_doorbell' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        $memberId = Auth::id();
        $today = Carbon::today();

        $existingOrder = Order::where('member_id', $memberId)
            ->whereDate('created_at', $today)
            ->first();

        if ($existingOrder) {
            return back()->withErrors(['error' => 'You can only place one order per day.']);
        }

        $order = Order::create([
            'member_id' => $memberId,
            'kitchen_id' => Menu::findOrFail($validated['menu_id'])->kitchen_id,
            'menu_id' => $validated['menu_id'],
            'call_upon_arrival' => $validated['call_upon_arrival'] ?? false,
            'ring_the_doorbell' => $validated['ring_the_doorbell'] ?? false,
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('order.waiting', ['order' => $order->id]);
    }

    private function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        return round(
            6371 * acos(
                cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
                cos(deg2rad($longitude2) - deg2rad($longitude1)) +
                sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))
            )
        );
    }


    public function showOrderConfirmation(Request $request, $restaurant_name, $menu_name)
    {
        $kitchen = Kitchen::where('restaurant_name', $restaurant_name)->firstOrFail();
        $menu = Menu::where('meal_name', $menu_name)->where('kitchen_id', $kitchen->id)->firstOrFail();

        // Assuming orders are created before confirmation
        $order = Order::with(['member', 'menu', 'kitchen'])
            ->where('menu_id', $menu->id)
            ->where('kitchen_id', $kitchen->id)
            ->first();

        // Fetch the authenticated user
        $user = Auth::user();

        // Calculate distance if user has coordinates
        $distance = null;
        if ($user->latitude && $user->longitude) {
            $distance = $this->calculateDistance(
                $user->latitude,
                $user->longitude,
                $kitchen->latitude,
                $kitchen->longitude
            );
        }

        return Inertia::render('Members/OrdersConfirm', [
            'orderDetails' => [
                'order' => $order,
                'member' => $order ? $order->member : null,
                'menu' => $menu,
                'kitchen' => $kitchen,
                'call_upon_arrival' => $order ? $order->call_upon_arrival : null,
                'ring_the_doorbell' => $order ? $order->ring_the_doorbell : null,
                'notes' => $order ? $order->notes : null,
                'selectedMenu' => $menu,
                'selectedKitchen' => $kitchen,
                'distance' => $distance,
            ],
        ]);

    }

    public function showWaitingPage($orderId)
    {
        // Fetch the order details and other necessary data
        $order = Order::with(['member', 'menu', 'kitchen'])->findOrFail($orderId);

        // Pass the order details to the view
        return Inertia::render('Members/Order', [
            'orderDetails' => $order,
        ]);
    }


}
