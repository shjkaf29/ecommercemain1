<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class UserDashboardController extends Controller
{
    public function home()
    {
        $products = Product::latest()->take(8)->get();
        $count = 0;

        return view('frontend.index', compact('products', 'count'));
    }

    public function index(){
    if (Auth::user()->user_type === 'admin') {
        $totalProducts = Product::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalProducts', 'totalUsers'));
    }

    // Fetch orders for logged-in user
    $orders = Order::with('product')
                   ->where('user_id', Auth::id())
                   ->latest()
                   ->get();

    return view('user.dashboard', compact('orders'));
    }
}
