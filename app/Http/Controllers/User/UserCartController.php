<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;

class UserCartController extends Controller
{
    public function addToCart($id){

            $product = Product::findOrFail($id);
            $quantity = request()->input('quantity', 1);

            if (Auth::check()) {

                $cart = ProductCart::firstOrNew([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                ]);
                
                $cart->quantity = ($cart->quantity ?? 0) + $quantity;
                $cart->product_price = $product->product_prices;
                $cart->save();

            } else {
                $cart = session()->get('guest_cart', []);

                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] += $quantity;
                } else {
                    $cart[$id] = [
                        'product_id' => $product->id,
                        'product_title' => $product->product_title,
                        'product_price' => $product->product_prices,
                        'quantity' => $quantity,
                    ];
                }

                session()->put('guest_cart', $cart);
            }

            return redirect()->back()->with('cart_message', 'Product added to cart!');
        }


   public function cartProducts()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
            $cart = ProductCart::where('user_id', Auth::id())->get();
        } else {
            $cart = session()->get('guest_cart', []);
            $count = count($cart);
        }

        return view('viewcartproduct', compact('count', 'cart'));
    }

    public function removeCart($id)
    {
        if (Auth::check()) {
            ProductCart::findOrFail($id)->delete();
        } else {
            $cart = session()->get('guest_cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('guest_cart', $cart);
            }
        }
        return redirect()->back()->with('cart_message', 'Product removed from cart.');
    }
}
