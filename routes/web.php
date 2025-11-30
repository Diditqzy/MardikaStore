<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\Buyer\BuyerDashboardController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\StoreManagementController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Buyer\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| FORCE LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/force-logout', function () {

    Auth::logout();

    Session::invalidate();
    Session::regenerateToken();

    return redirect('/login')->with('success', 'Anda telah logout.');
})->name('force.logout');



/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicProductController::class, 'index'])->name('catalog');
Route::get('/product/{product}', [PublicProductController::class, 'show'])->name('product.detail');



/*
|--------------------------------------------------------------------------
| USER PROFILE (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



/*
|--------------------------------------------------------------------------
| SELLER — PENDING / REJECTED (NO ROLE MIDDLEWARE)
|--------------------------------------------------------------------------
| Seller pending & rejected tidak boleh diletakkan dalam middleware role:seller.
| Kalau tidak, seller pending tidak akan bisa akses route dan akan error 404.
*/
Route::middleware('auth')->group(function () {

    Route::get('/seller/pending', function () {
        return view('seller.pending');
    })->name('seller.pending');

    Route::get('/seller/rejected', function () {
        return view('seller.rejected');
    })->name('seller.rejected');

});



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    /*
    |------------------------------
    | CATEGORY MANAGEMENT
    |------------------------------
    */
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');

        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/{category}/update', [CategoryController::class, 'update'])->name('update');

        Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('destroy');
    });


    /*
    |------------------------------
    | USER MANAGEMENT
    |------------------------------
    */
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');

    Route::get('/sellers/pending', [UserManagementController::class, 'pendingSellers'])->name('sellers.pending');
    Route::post('/sellers/{id}/approve', [UserManagementController::class, 'approve'])->name('sellers.approve');
    Route::post('/sellers/{id}/reject', [UserManagementController::class, 'reject'])->name('sellers.reject');
    Route::get('/sellers', [UserManagementController::class, 'approvedSellers'])->name('sellers.index');


    /*
    |------------------------------
    | PRODUCT MANAGEMENT
    |------------------------------
    */
    Route::get('/products', [ProductManagementController::class, 'index'])->name('products.index');
    Route::delete('/products/{id}', [ProductManagementController::class, 'destroy'])->name('products.destroy');


    /*
    |------------------------------
    | STORE MANAGEMENT
    |------------------------------
    */
    Route::get('/stores', [StoreManagementController::class, 'index'])->name('stores.index');
    Route::delete('/stores/{id}', [StoreManagementController::class, 'destroy'])->name('stores.destroy');
});



/*
|--------------------------------------------------------------------------
| SELLER ROUTES (ONLY APPROVED SELLER)
|--------------------------------------------------------------------------
*/

Route::prefix('seller')->middleware(['auth', 'role:seller'])->name('seller.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Store Management
    Route::get('/store', [StoreController::class, 'index'])->name('store');
    Route::post('/store/update', [StoreController::class, 'update'])->name('store.update');

    // Products
    Route::get('/products', [SellerProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [SellerProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [SellerProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [SellerProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}/update', [SellerProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/delete', [SellerProductController::class, 'destroy'])->name('products.delete');

    // Orders
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
Route::delete('/seller/delete-account', [SellerController::class, 'destroy'])
    ->name('seller.delete.account');

Route::middleware(['auth'])->delete('/seller/delete-account', function () {
    $user = auth()->user();

    // Pastikan hanya seller rejected yang boleh hapus
    if ($user->role !== 'seller' || $user->status !== 'rejected') {
        abort(403, 'Unauthorized');
    }

    // Hapus user
    $user->delete();

    // Logout setelah hapus
    Auth::logout();

    session()->invalidate();
    session()->regenerateToken();

    return redirect('/')->with('success', 'Akun Anda berhasil dihapus permanen.');
})->name('seller.delete.account');

/*
|--------------------------------------------------------------------------
| BUYER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [BuyerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [BuyerOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [BuyerOrderController::class, 'cancel'])->name('orders.cancel');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // FORM REVIEW (GET)
    Route::get('/orders/item/{item}/review', [\App\Http\Controllers\ReviewController::class, 'form'])
        ->name('orders.review');
    

    // SIMPAN REVIEW (POST)
    Route::post('/orders/item/{item}/review', [\App\Http\Controllers\ReviewController::class, 'store'])
        ->name('review.store');
        
    // FORM REVIEW
Route::get('/buyer/orders/item/{item}/review', [ReviewController::class, 'form'])
    ->middleware(['auth', 'role:buyer'])
    ->name('buyer.orders.review');

// SIMPAN REVIEW
Route::post('/buyer/orders/item/{item}/review', [ReviewController::class, 'store'])
    ->middleware(['auth', 'role:buyer'])
    ->name('buyer.orders.review.store');

    

        
});



/*
|--------------------------------------------------------------------------
| CHECKOUT (BUYER ONLY)
|--------------------------------------------------------------------------


*/





Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});



/*
|--------------------------------------------------------------------------
| CART (BUYER ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::patch('/cart/item/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/item/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
});



Route::middleware(['auth', 'role:buyer'])
    ->prefix('buyer')
    ->name('buyer.')
    ->group(function () {

        Route::get('/order-success/{order}', function (Order $order) {
            return view('order.success', compact('order'));
        })->name('order.success');

    });


Route::patch('/cart/item/{cartItem}/ajax', [CartController::class, 'update'])
    ->name('cart.ajax.update');
/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
