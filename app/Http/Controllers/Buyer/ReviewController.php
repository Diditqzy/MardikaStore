<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($itemId)
    {
        $item = OrderItem::with('product')->findOrFail($itemId);

        return view('buyer.orders.orders.detail', compact('item'));
    }

    public function store(Request $request, $itemId)
    {
        $item = OrderItem::findOrFail($itemId);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $item->review()->create([
            'user_id' => auth()->id(),
            'product_id' => $item->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('buyer.orders.index')->with('success', 'Review berhasil dikirim!');
    }
}
