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

        $products = Product::with(['store'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->latest()
            ->paginate(9);

        return view('buyer.dashboard', compact('products', 'categories'));
    }
}
