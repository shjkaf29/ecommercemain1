<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ShopController extends Controller
{
    public function index()
    {
        // Get all products
        $products = Product::all();

        // Pass products to the view
        return view('frontend.shop', compact('products'));
    }
}
