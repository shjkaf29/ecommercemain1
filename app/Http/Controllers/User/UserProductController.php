<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;

class UserProductController extends Controller
{
    public function home()
    {
        $count = Auth::check() ? ProductCart::where('user_id', Auth::id())->count() : 0;
        $products = Product::all();
        return view('frontend.index', compact('products', 'count'));
    }

    public function productDetails($id)
    {
        $count = Auth::check() ? ProductCart::where('user_id', Auth::id())->count() : 0;
        $product = Product::findOrFail($id);
        return view('product_details', compact('product', 'count'));
    }
}
