<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('buyer_id', Auth::id())->latest()->paginate(10);
        return view('buyer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // ensure buyer owns order
        if ($order->buyer_id !== Auth::id()) abort(403);
        $order->load('items.product.store');
        return view('buyer.orders.show', compact('order'));
    }
    public function details(Order $order)
    {
        

        $order->load('items.product');

        return view('buyer.orders.orders.detail', [
            'order' => $order,
            'items' => $order->items
        ]);
    }

    // buyer cancel (only pending)
    public function cancel(Order $order)
    {
        if ($order->buyer_id !== Auth::id()) abort(403);
        if ($order->status !== 'pending') {
            return redirect()->back()->withErrors(['order' => 'Order tidak bisa dibatalkan pada tahap ini.']);
        }

        DB::transaction(function () use ($order) {
            // restore stock and return items to cart
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->stock += $item->quantity;
                    $product->save();
                }

                // put item back to buyer cart
                $cart = Cart::firstOrCreate(['user_id' => $order->buyer_id]);
                // if item exists in cart, increase qty
                $existing = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $item->product_id)
                            ->first();
                if ($existing) {
                    $existing->quantity += $item->quantity;
                    $existing->save();
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                }
            }

            // mark order cancelled
            $order->status = 'cancelled';
            $order->save();
        });

        return redirect()->route('buyer.orders.index')->with('success', 'Order dibatalkan dan item dikembalikan ke keranjang.');
    }
}
