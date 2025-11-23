<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Session;


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

require __DIR__.'/auth.php';
