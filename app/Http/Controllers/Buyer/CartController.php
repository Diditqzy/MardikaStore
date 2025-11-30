<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['total' => 0]
        );

        $cart->items()->updateOrCreate(
            [
                'product_id' => $product->id,
            ],
            [
                'price' => $product->price,
                'quantity' => \DB::raw('quantity + 1'),
            ]
        );

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        return view('buyer.cart', compact('cart'));
    }
    public function ajaxUpdate(Request $request, $cartItemId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = \App\Models\CartItem::findOrFail($cartItemId);

    // pastikan item milik user
    if ($cartItem->cart->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    // pastikan tidak lebih dari stok
    $maxStock = $cartItem->product->stock;
    $qty = min($request->quantity, $maxStock);

    $cartItem->update([
        'quantity' => $qty
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Quantity updated',
        'quantity' => $qty
    ]);
}
}
