<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, OrderItem $orderItem)
    {
        // pastikan buyer memang pemilik order
        if ($orderItem->order->user_id !== Auth::id()) {
            abort(403);
        }

        // hanya bisa review bila order COMPLETED
        if ($orderItem->order->status !== 'completed') {
            return back()->withErrors(['msg' => 'Review hanya bisa setelah pesanan selesai.']);
        }

        // validasi
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        // cegah review duplikat
        if ($orderItem->review) {
            return back()->withErrors(['msg' => 'Anda sudah me-review produk ini.']);
        }

        ProductReview::create([
            'order_id'      => $orderItem->order_id,
            'order_item_id' => $orderItem->id,
            'product_id'    => $orderItem->product_id,
            'user_id'       => Auth::id(),
            'rating'        => $request->rating,
            'comment'       => $request->comment,
        ]);

        return back()->with('success', 'Review berhasil dikirim.');
    }
}
