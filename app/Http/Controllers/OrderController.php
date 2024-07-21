<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Kitchen;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
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

        return Inertia::location(route('order.waiting', ['orderId' => $order->id]));
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

        $order = Order::with(['member', 'menu', 'kitchen'])
            ->where('menu_id', $menu->id)
            ->where('kitchen_id', $kitchen->id)
            ->first();

        $user = Auth::user();

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
        $order = Order::with(['member', 'menu', 'kitchen'])->find($orderId);

        if (!$order) {
            return Inertia::render('Members/Order', [
                'orderDetails' => null,
            ]);
        }

        return Inertia::render('Members/Order', [
            'orderDetails' => $order,
        ]);
    }

    public function index()
{
    $orders = Order::with('menu', 'member')->where('status', 'pending')->get();
    $inPreparationOrders = Order::with('menu', 'member')->where('status', 'In Preparation')->get();
    $readyForPickupOrders = Order::with('menu', 'member')->where('status', 'ready for pickup')->get();
    $pickingUpOrders = Order::with('menu', 'member')->where('status', 'picking up')->get();
    $onItsWayOrder = Order::with('menu', 'member')->where('status', 'on its way')->get();
    $completedOrders = Order::with('menu', 'member')->where('status', 'completed')->get();

    return Inertia::render('Kitchens/Orders', [
        'orders' => $orders,
        'inPreparationOrders' => $inPreparationOrders,
        'readyForPickupOrders' => $readyForPickupOrders,
        'pickingUpOrders' => $pickingUpOrders,
        'onItsWayOrder' => $onItsWayOrder,
        'completedOrders' => $completedOrders
    ]);
}

public function acceptOrder($orderId)
{
    $order = Order::find($orderId);

    if (!$order) {
        return Redirect::back()->with('error', 'Order not found');
    }

    $order->status = 'In Preparation';
    $order->save();

    return Redirect::back()->with('success', 'Order is now in preparation');
}

public function cancelOrder($orderId)
{
    $order = Order::find($orderId);

    if (!$order) {
        return Redirect::back()->with('error', 'Order not found');
    }

    $order->delete(); // Remove the order completely

    return Redirect::back()->with('success', 'Order has been canceled');
}

public function markAsCooked($orderId)
{
    $order = Order::findOrFail($orderId);
    $order->status = 'ready for pickup';
    $order->save();

    return back()->with('success', 'Order marked as cooked.');
}

public function markAsPickingUp($orderId)
{
    $order = Order::findOrFail($orderId);
    $order->status = 'picking up';
    $order->rider_id = auth()->id();
    $order->save();

    return back()->with('success', 'Order marked as picking up.');
}

public function markAsOnItsWay($orderId)
{
    $order = Order::findOrFail($orderId);
    $order->rider_id = auth()->id();
    $order->status = 'on its way';
    $order->save();

    return back()->with('success', 'Order marked as on its way.');
}

public function markAsComplete($orderId)
{
    $order = Order::findOrFail($orderId);
    $order->status = 'completed';
    $order->save();

    return Redirect::route('member.restaurant');
}

public function ifKitchen()
{
    $user = Kitchen::user(); // Get the authenticated user

    return Inertia::render('OrderBox', [
        'shouldHideButton' => $user->isKitchen(),
    ]);
}

}
