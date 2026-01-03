<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function viewOrder() {
        $orders = Order::all();
        return view('admin.orders.vieworders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('order_message', 'Order status updated successfully!');
    }

    public function deleteOrder($id) {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('order_message', 'Order deleted successfully!');
    }
}
