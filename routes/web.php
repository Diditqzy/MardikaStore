<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Session;

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
Route::middleware(['auth', 'buyer'])->get('/buyer/dashboard', function () {
    return view('buyer.dashboard');
})->name('buyer.dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin/categories')->name('admin.categories.')->group(function () {
    
    Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');

    Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');

    Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');
    Route::post('/{category}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');

    Route::delete('/{category}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('destroy');
});


require __DIR__.'/auth.php';
