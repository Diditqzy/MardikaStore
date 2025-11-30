<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class BuyerDashboardController extends Controller
{
public function index(Request $request)
{
    $categories = Category::all();

    $query = Product::with(['store','category']);

    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    // AMBIL SEMUA PRODUK TANPA BATAS
    $products = $query->latest()->get();

    $selectedCategory = $request->category_id ? Category::find($request->category_id) : null;

    // cek kategori ada produk atau tidak
    $categoryHasAnyProducts = false;
    if ($selectedCategory) {
        $categoryHasAnyProducts =
            Product::where('category_id', $selectedCategory->id)->exists();
    }

    return view('buyer.dashboard', compact('products', 'categories', 'selectedCategory', 'categoryHasAnyProducts'));
}


}
