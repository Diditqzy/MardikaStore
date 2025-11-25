<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        // semua route di controller ini harus auth + buyer middleware applied in routes
    }

    // show cart page
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cart->load('items.product.store');
        return view('cart.index', compact('cart'));
    }

    // add product to cart
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = $request->quantity ?? 1;

        if ($product->stock < $qty) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
        }

        return DB::transaction(function () use ($product, $qty) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // check existing item
            $item = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

            if ($item) {
                $newQty = $item->quantity + $qty;
                if ($newQty > $product->stock) {
                    return redirect()->back()->withErrors(['quantity' => 'Tidak bisa menambahkan lebih dari stok tersedia.']);
                }
                $item->quantity = $newQty;
                $item->price = $product->price; // update snapshot price
                $item->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
        });
    }

    // update qty for a cart item
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())->firstOrFail();

        if ($cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $product = $cartItem->product;

        if (!$product) {
            return redirect()->route('cart.index')->withErrors(['Produk tidak ditemukan.']);
        }

        if ($request->quantity > $product->stock) {
            return redirect()->route('cart.index')
                ->withErrors(['quantity' => 'Jumlah melebihi stok tersedia.']);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Jumlah berhasil diperbarui.');
    }

    // remove item
    public function destroy(CartItem $cartItem)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        if ($cartItem->cart_id !== $cart->id) abort(403);

        $cartItem->delete();
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    // clear cart
    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrCreate();
        $cart->items()->delete();
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }
}
