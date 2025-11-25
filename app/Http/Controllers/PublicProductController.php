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

        $products = Product::with(['store', 'category'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->paginate(9);

        return view('public.catalog', compact('products', 'categories'));
    }

    // DETAIL PRODUK
    public function show(Product $product)
    {
        return view('public.product-detail', compact('product'));
    }
}
