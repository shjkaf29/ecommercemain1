<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Dashboard route (shared for user/admin)
Route::middleware(['auth'])->group(function(){//auth-Custom middleware
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');//User Dashboard Route
});

// Frontend home page
Route::group([], function(){
    Route::get('/', [UserDashboardController::class,'home'])->name('index');//home page
    Route::get('/frontend/contact', [ContactController::class, 'index'])->name('frontend.contact');//contact page
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');//contact submit
    Route::get('/frontend/shop',[ShopController::class, 'index'])->name('frontend.shop');//shop page
});

// User routes
Route::middleware(['auth'])->group(function(){
    Route::post('/confirm_order', [UserOrderController::class, 'confirmOrder'])->name('confirm_order');//Confirm order Route
    Route::get('/myorders', [UserOrderController::class, 'myOrders'])->name('user.myorders');
    Route::get('/cancel-order/{id}', [UserOrderController::class, 'cancelOrder'])->name('user.cancelorder');
    Route::get('/order-history', [UserOrderController::class, 'orderHistory'])->name('user.orderhistory');
    Route::get('/user/order-history', [UserOrderController::class, 'orderHistory'])->name('user.order-history');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

//Product Details Route- All
Route::controller(UserProductController::class)->group(function () {
    Route::get('/product_details/{id}', 'productDetails')->name('product_details');
});

Route::controller(UserCartController::class)->group(function () {
    Route::post('/addtocart/{id}', 'addToCart')->name('addtocart');
    Route::get('/cartporducts', 'cartProducts')->name('cartproducts');
    Route::get('/removecartproducts/{id}', 'removeCart')->name('removecartproducts');
});

// Admin routes
Route::middleware(['auth','admin'])->group(function(){//admin middleware-created by developer
    Route::get('/admin/dashboard', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');
    //Category Route
    Route::get('/add_category',[AdminCategoryController::class, 'add'])->name('admin.category.addcategory');
    Route::post('/add_category',[AdminCategoryController::class, 'store'])->name('admin.category.postaddcategory');
    Route::get('/view_category',[AdminCategoryController::class, 'view'])->name('admin.category.viewcategory');
    Route::delete('/delete_category/{id}',[AdminCategoryController::class, 'deleteCategory'])->name('admin.category.categorydelete');
    Route::get('/update_category/{id}',[AdminCategoryController::class, 'updateCategory'])->name('admin.category.categoryupdate');
    Route::post('/update_category/{id}',[AdminCategoryController::class, 'postUpdateCategory'])->name('admin.category.postupdatecategory');
    //Product Route
    Route::get('/add_product',[AdminProductController::class, 'add'])->name('admin.product.addproduct');
    Route::post('/add_product',[AdminProductController::class,'postAdd'])->name('admin.product.postaddproduct');
    Route::get('/view_product',[AdminProductController::class,'view'])->name('admin.product.viewproduct');
    Route::delete('/view_product/{id}',[AdminProductController::class, 'delete'])->name('admin.deleteproduct');
    Route::get('/update_product/{id}', [AdminProductController::class, 'update'])->name('admin.updateproduct');
    Route::post('/update_product/{id}', [AdminProductController::class, 'postUpdate'])->name('admin.postupdateproduct');
    //Order Route
    Route::get('/vieworder', [AdminOrderController::class, 'view'])->name('admin.orders.vieworders');
    Route::post('/update_order_status/{id}', [AdminOrderController::class, 'updateOrderStatus'])->name('admin.orders.updateorderstatus');
    Route::delete('/delete_order/{id}', [AdminOrderController::class, 'delete'])->name('admin.deleteorder');
    //User Route
    Route::get('/users', [AdminUserController::class, 'view'])->name('admin.users');
    Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');
});
