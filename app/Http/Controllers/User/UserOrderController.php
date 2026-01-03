<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductCart;

class UserOrderController extends Controller
{
    public function confirmOrder(Request $request)
    {
    if (!Auth::check()) {
        return redirect()->route('login')
            ->with('login_to_continue', 'Please login to place your order');
    }

    $request->validate([
        'receiver_address' => 'required|string|max:255',
        'receiver_number'  => 'required|string|max:20',
    ]);

    $cartItems = ProductCart::where('user_id', Auth::id())->get();

    if ($cartItems->isEmpty() && session()->has('guest_cart')) {
        $cartItems = collect(session('guest_cart'));
    }

    foreach ($cartItems as $item) {
        Order::create([
            'receiver_address' => $request->receiver_address,
            'receiver_phone'   => $request->receiver_number,
            'user_id'          => Auth::id(),
            'product_id'       => is_array($item) ? $item['product_id'] : $item->product_id,
            'status'           => 'pending',
        ]);
    }

    ProductCart::where('user_id', Auth::id())->delete();
    session()->forget('guest_cart');

    return redirect()->route('user.order-history')
        ->with('order_message', 'Order placed successfully!');
    }


    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('myorders', compact('orders'));
    }


    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('order_message', 'Order cancelled successfully.');
    }

    public function orderHistory() {
    $orders = Order::with('product')
                   ->where('user_id', auth()->id())
                   ->latest()
                   ->get();

    return view('user.order-history', compact('orders'));
    }

}
