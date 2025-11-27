<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\Buyer\BuyerDashboardController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
Route::get('/force-logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/login');
});

// Homepage (Guest / Public)
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes (Profile from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Seller Pending Page
Route::get('/seller/pending', function () {
    return view('seller.pending');
})->middleware(['auth', 'seller.pending'])->name('seller.pending');

// =============================
// DASHBOARDS FOR EACH ROLE
// =============================

// ADMIN DASHBOARD
Route::middleware(['auth', 'admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// SELLER DASHBOARD (APPROVED)
Route::middleware(['auth', 'seller'])->get('/seller/dashboard', function () {
    return view('seller.dashboard');
})->name('seller.dashboard');

// BUYER DASHBOARD
// Route::middleware(['auth', 'buyer'])->get('/buyer/dashboard', function () {
//     return view('buyer.dashboard');
// })->name('buyer.dashboard');
Route::middleware(['auth','buyer'])
    ->get('/buyer/dashboard', [BuyerDashboardController::class, 'index'])
    ->name('buyer.dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin/categories')->name('admin.categories.')->group(function () {
    
    Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');

    Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');

    Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');
    Route::post('/{category}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');

    Route::delete('/{category}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/store', [App\Http\Controllers\Seller\StoreController::class, 'index'])->name('store');
    Route::post('/store/update', [App\Http\Controllers\Seller\StoreController::class, 'update'])->name('store.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/users', [App\Http\Controllers\Admin\UserManagementController::class, 'index'])
        ->name('users.index');

    Route::get('/sellers/pending', [App\Http\Controllers\Admin\UserManagementController::class, 'pendingSellers'])
        ->name('sellers.pending');

    Route::post('/sellers/{id}/approve', [App\Http\Controllers\Admin\UserManagementController::class, 'approve'])
        ->name('sellers.approve');

    Route::post('/sellers/{id}/reject', [App\Http\Controllers\Admin\UserManagementController::class, 'reject'])
        ->name('sellers.reject');
});

Route::get('/seller/rejected', function () {
    return view('seller.rejected');
})->middleware('auth')->name('seller.rejected');

Route::delete('/seller/delete-account', function () {
    $user = auth()->user();
    $user->delete();

    auth()->logout();

    return redirect('/')->with('success', 'Account deleted');
})->middleware('auth')->name('seller.delete.account');


Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {

    // Store
    Route::get('/store', [App\Http\Controllers\Seller\StoreController::class, 'index'])->name('store');
    Route::post('/store/update', [App\Http\Controllers\Seller\StoreController::class, 'update'])->name('store.update');

    // Products
    Route::get('/products', [App\Http\Controllers\Seller\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\Seller\ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [App\Http\Controllers\Seller\ProductController::class, 'store'])->name('products.store');

    Route::get('/products/{product}/edit', [App\Http\Controllers\Seller\ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}/update', [App\Http\Controllers\Seller\ProductController::class, 'update'])->name('products.update');

    Route::delete('/products/{product}/delete', [App\Http\Controllers\Seller\ProductController::class, 'destroy'])->name('products.delete');
});

Route::get('/', [PublicProductController::class, 'index'])->name('catalog');
Route::get('/product/{product}', [PublicProductController::class, 'show'])->name('product.detail');

Route::middleware(['auth','buyer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::patch('/cart/item/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/item/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Checkout (buyer)
Route::middleware(['auth','buyer'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // buyer orders
    Route::get('/buyer/orders', [BuyerOrderController::class, 'index'])->name('buyer.orders.index');
    Route::get('/buyer/orders/{order}', [BuyerOrderController::class, 'show'])->name('buyer.orders.show');
    Route::post('/buyer/orders/{order}/cancel', [BuyerOrderController::class, 'cancel'])->name('buyer.orders.cancel');
});

// seller orders
Route::middleware(['auth','seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::get('/order/success/{order}', function(App\Models\Order $order){
    return view('order.success', compact('order'));
})->middleware(['auth','buyer'])->name('order.success');

Route::middleware(['auth','buyer'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/buyer/orders', [App\Http\Controllers\Buyer\OrderController::class, 'index'])->name('buyer.orders.index');
    Route::get('/buyer/orders/{order}', [App\Http\Controllers\Buyer\OrderController::class, 'show'])->name('buyer.orders.show');
    Route::post('/buyer/orders/{order}/cancel', [App\Http\Controllers\Buyer\OrderController::class, 'cancel'])->name('buyer.orders.cancel');
    Route::get('/order/success/{order}', function(App\Models\Order $order){
        return view('order.success', compact('order'));
    })->name('order.success');
});

// Seller order management
Route::middleware(['auth','seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/orders', [App\Http\Controllers\Seller\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Seller\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [App\Http\Controllers\Seller\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::patch('/cart/item/{cartItem}/ajax', [CartController::class, 'ajaxUpdate'])
    ->middleware(['auth','buyer'])
    ->name('cart.ajax.update');

Route::middleware(['auth', 'buyer'])->group(function () {
    Route::post('/review/{orderItem}', [ReviewController::class, 'store'])
        ->name('review.store');
});

require __DIR__.'/auth.php';
