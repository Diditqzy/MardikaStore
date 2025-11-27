<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // show checkout form (optional). We'll implement checkout action from cart page.
    public function store(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'integer|exists:cart_items,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:2000',
            'notes' => 'nullable|string|max:2000',
        ]);

        $userId = Auth::id();

        // Wrap in DB transaction
        return DB::transaction(function () use ($request, $userId) {
            // Load cart items and validate ownership and stock
            $cart = Cart::where('user_id', $userId)->firstOrFail();

            $selectedIds = $request->input('selected_items', []);
            $cartItems = CartItem::with('product')->whereIn('id', $selectedIds)->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->withErrors(['selected_items' => 'Item tidak ditemukan.']);
            }

            // Validate all items belong to user's cart
            foreach ($cartItems as $ci) {
                if ($ci->cart_id !== $cart->id) {
                    abort(403);
                }
                if (!$ci->product) {
                    return redirect()->back()->withErrors(['product' => 'Produk sudah tidak tersedia.']);
                }
                if ($ci->quantity > $ci->product->stock) {
                    return redirect()->back()->withErrors(['stock' => "Stok tidak mencukupi untuk {$ci->product->name}."]);
                }
            }

            // Create order (we assume single-seller scenario; take seller from first item)
            $firstSellerId = $cartItems->first()->product->store->user_id ?? null;

            $total = 0;
            foreach ($cartItems as $ci) {
                $total += $ci->price * $ci->quantity;
            }

            $order = Order::create([
                'buyer_id' => $userId,
                'seller_id' => $firstSellerId,
                'total_price' => $total,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);

            // Create order items, deduct stock, remove cart_items
            foreach ($cartItems as $ci) {
                $product = $ci->product;
                $sellerId = $product->store->user_id ?? null;
                $subtotal = $ci->price * $ci->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'seller_id' => $sellerId,
                    'quantity' => $ci->quantity,
                    'price' => $ci->price,
                    'subtotal' => $subtotal,
                ]);

                // deduct stock
                $product->stock = max(0, $product->stock - $ci->quantity);
                $product->save();

                // remove cart item (partial checkout: remove only selected items)
                $ci->delete();
            }

            return redirect()->route('order.success', $order->id);
        });
    }
}
