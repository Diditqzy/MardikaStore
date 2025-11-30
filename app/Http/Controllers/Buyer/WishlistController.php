<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
                    ->with('product')
                    ->get();

        return view('buyer.wishlist.index', compact('wishlists'));
    }

    public function add($productId)
    {
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $productId
        ]);

        return back()->with('success', 'Produk ditambahkan ke favorit.');
    }

    public function remove($productId)
    {
        Wishlist::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();

        return back()->with('success', 'Produk dihapus dari favorit.');
    }
}
