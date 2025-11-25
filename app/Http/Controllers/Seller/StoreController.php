<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        return view('seller.store.index', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $store = Auth::user()->store;

        if (!$store) {
            $store = Store::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } else {
            $store->name = $request->name;
            $store->description = $request->description;

            if ($request->hasFile('image')) {
                $store->image = $request->file('image')->store('store_images', 'public');
            }

            $store->save();
        }

        return redirect()->route('seller.store')->with('success', 'Store updated.');
    }
}
