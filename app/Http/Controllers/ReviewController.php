<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\OrderItem;

class ReviewController extends Controller
{
    // FORM — HALAMAN REVIEW
    public function form($itemId)
    {
        $item = OrderItem::findOrFail($itemId);

        // CEK APAKAH SUDAH ADA REVIEW
        $existingReview = Review::where('order_item_id', $item->id)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($existingReview) {
            return redirect()
                ->back()
                ->with('success', 'Anda sudah pernah memberi review untuk produk ini.');
        }

        return view('buyer.orders.review', compact('item'));
    }


    // SIMPAN REVIEW
    public function store(Request $request, $itemId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $item = OrderItem::findOrFail($itemId);

        // CEK DOUBLE REVIEW
        $exists = Review::where('order_item_id', $item->id)
                        ->where('user_id', auth()->id())
                        ->exists();

        if ($exists) {
            return back()->with('success', 'Review anda sudah tercatat sebelumnya.');
        }

        Review::create([
            'user_id'       => auth()->id(),
            'product_id'    => $item->product_id,
            'order_id'      => $item->order_id,
            'order_item_id' => $item->id,
            'rating'        => $request->rating,
            'comment'       => $request->comment,
        ]);

        return redirect()
        ->route('product.detail', $item->product_id)
        ->with('success', 'Review anda telah tercatat.');
                
    }
}
