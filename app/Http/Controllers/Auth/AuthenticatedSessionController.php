<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(LoginRequest $request): RedirectResponse{
    $request->authenticate();
    $request->session()->regenerate();

    // ✅ HANDLE PENDING GUEST ORDER
    if (session()->has('pending_order')) {

        $data = session('pending_order');

        foreach ($data['product_ids'] as $productId) {
            Order::create([
                'user_id'          => Auth::id(),
                'product_id'       => $productId,
                'receiver_address' => $data['receiver_address'],
                'receiver_phone'   => $data['receiver_number'],
                'status'           => 'pending',
            ]);
        }

        ProductCart::where('user_id', Auth::id())->delete();

        session()->forget('pending_order');

        return redirect()
            ->route('user.order-history')
            ->with('order_message', 'Order placed successfully!');
    }

    return redirect()->intended(route('index', false));
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
