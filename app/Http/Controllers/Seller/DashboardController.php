<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();   
        $store = $user->store;    

        $products = $store
            ? Product::where('store_id', $store->id)->pluck('id')
            : collect([]);

        $ratings = $products->count() > 0
            ? Review::selectRaw('product_id, AVG(rating) as avg_rating, COUNT(*) as total')
                ->whereIn('product_id', $products)
                ->groupBy('product_id')
                ->get()
            : collect([]);

        return view('seller.dashboard', [
            'user' => $user,
            'store' => $store,
            'ratings' => $ratings,
        ]);
    }
}
