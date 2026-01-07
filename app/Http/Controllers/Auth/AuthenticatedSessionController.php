<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\ProductCart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user
        $request->authenticate();
        $request->session()->regenerate();

        $userId = Auth::id();

        // 1️⃣ Merge guest cart into user cart
        if (session()->has('guest_cart')) {
            $guestCart = session('guest_cart');

        foreach ($guestCart as $item) {
            $cart = ProductCart::firstOrNew([
                'user_id' => $userId,
                'product_id' => $item['product_id'],
            ]);

            $cart->quantity = ($cart->quantity ?? 0) + $item['quantity'];

            $cart->product_price = $item['product_price'];

            $cart->save();
        }

        session()->forget('guest_cart');
        }

        // 2️⃣ Handle pending order if exists
        if (session()->has('pending_order')) {
            $data = session('pending_order');

            foreach ($data['product_ids'] as $productId) {
                Order::create([
                    'user_id'          => $userId,
                    'product_id'       => $productId,
                    'receiver_address' => $data['receiver_address'],
                    'receiver_phone'   => $data['receiver_number'],
                    'status'           => 'pending',
                ]);
            }

            // Clear the cart after order
            ProductCart::where('user_id', $userId)->delete();

            session()->forget('pending_order');

            return redirect()
                ->route('user.order-history')
                ->with('order_message', 'Order placed successfully!');
        }

        // Default redirect after login
        return redirect()->intended(route('index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
