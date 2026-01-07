<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Count items in DB for logged-in users
                $count = ProductCart::where('user_id', Auth::id())->sum('quantity');
            } else {
                // Count items in session for guests
                $guestCart = session()->get('guest_cart', []);
                $count = array_sum(array_column($guestCart, 'quantity'));
            }

            $view->with('count', $count);
        });
    }
}
