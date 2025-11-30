<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Build base query (applied category + search)
        $query = Product::with(['store', 'category']);

        // If category filter present, apply it (but keep query object so we can check existence separately)
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Apply search if present
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Get filtered products (what will be displayed)
        $products = $query->latest()->get();

        // Additional check: does the selected category (if any) have any products at all?
        $categoryHasAnyProducts = false;
        $selectedCategory = null;
        if ($request->category_id) {
            $selectedCategory = Category::find($request->category_id);
            if ($selectedCategory) {
                // check existence of any product in that category (regardless of search)
                $categoryHasAnyProducts = Product::where('category_id', $selectedCategory->id)->exists();
            }
        }

        return view('public.catalog', compact('products', 'categories', 'categoryHasAnyProducts', 'selectedCategory'));
    }

    // DETAIL PRODUK

    public function show(Product $product)
{
    // BUYER
    if (auth()->check() && auth()->user()->role === 'buyer') {

        $isWishlist = auth()->user()
            ->wishlist()
            ->where('product_id', $product->id)
            ->exists();

        return view('public.product-detail-buyer', [
            'product' => $product,
            'isWishlist' => $isWishlist,
        ]);
    }

    // GUEST
    return view('public.product-detail-guest', compact('product'));
}
}
