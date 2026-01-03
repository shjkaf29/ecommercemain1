<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    public function add() {
        $categories = Category::all(); 
        return view('admin.product.addproduct', compact('categories'));
    }

public function postAdd(Request $request) {
    $request->validate([
        'product_title' => 'required|string|max:255',
        'product_description' => 'required|string',
        'product_prices' => 'required|numeric',
        'product_quantity' => 'required|integer',
        'product_category' => 'required|string',
        'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:2048'
    ]);

    $product = new Product();

    // Assign fields manually
    $product->product_title = $request->product_title;
    $product->product_description = $request->product_description;
    $product->product_prices = $request->product_prices;
    $product->product_quantity = $request->product_quantity;
    $product->product_category = $request->product_category;

    // Handle image separately
    if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('product_images'), $imageName);
        $product->product_image = $imageName;
    }

    $product->save();

    return redirect()->back()->with('product_message', 'Product added successfully!');
}


    public function view() {
        $products = Product::all();
        return view('admin.product.viewproduct', compact('products'));
    }

    public function delete($id) {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('delete_message', 'Product deleted successfully!');
    }

    public function update($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.updateproduct', compact('product', 'categories'));
    }

    public function postUpdate(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->fill($request->only(['product_title', 'product_description', 'product_prices', 'product_quantity', 'product_category']));

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('product_images'), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();
        return redirect()->back()->with('product_message', 'Product updated successfully!');
    }
}
