<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // show orders where seller_id == current user (single-seller assumption)
        $orders = Order::where('seller_id', Auth::id())->latest()->paginate(10);
        return view('seller.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->seller_id !== Auth::id()) abort(403);
        $order->load('items.product');
        return view('seller.orders.show', compact('order'));
    }

    // change status: only allowed transitions
    public function updateStatus(Request $request, Order $order)
    {
        if ($order->seller_id !== Auth::id()) abort(403);

        $request->validate(['status' => 'required|in:packed,shipped,completed']);

        $allowed = [
            'pending' => ['packed'],
            'packed' => ['shipped'],
            'shipped' => ['completed'],
        ];

        $current = $order->status;
        $next = $request->status;

        if (!isset($allowed[$current]) || !in_array($next, $allowed[$current])) {
            return redirect()->back()->withErrors(['status' => 'Transisi status tidak diizinkan.']);
        }

        $order->status = $next;
        $order->save();

        return redirect()->back()->with('success', 'Status order diperbarui menjadi '. $next);
    }
}
