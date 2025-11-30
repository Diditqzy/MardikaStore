<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        // Jika seller belum punya toko, kembalikan array kosong
        $products = $store ? $store->products : [];

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'price' => 'required|numeric|min:1|max:999999999999',
            'stock'       => 'required|integer|min:1',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $store = Auth::user()->store;

        // Sanitasi harga (hapus titik, koma, dan huruf)
        $cleanPrice = preg_replace('/[^0-9]/', '', $request->price);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        Product::create([
            'store_id'    => $store->id,
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $cleanPrice,
            'stock'       => $request->stock,
            'image'       => $imagePath
        ]);

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'price'       => 'required|numeric|min:1',
            'stock'       => 'required|integer|min:1',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Sanitasi harga
        $cleanPrice = preg_replace('/[^0-9]/', '', $request->price);

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('product_images', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $cleanPrice,
            'stock'       => $request->stock,
        ]);
        

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
