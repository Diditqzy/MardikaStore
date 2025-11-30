<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

class ProductManagementController extends Controller
{
    public function index()
    {
        $products = Product::with(['store.user', 'category'])->get();
        return view('admin.products.index', compact('products'));
    }
    public function seller()
{
    return $this->belongsTo(\App\Models\User::class, 'seller_id');
}
public function category()
{
    return $this->belongsTo(\App\Models\Category::class);
}
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('admin.products.index')
        ->with('success', 'Produk berhasil dihapus.');
}
}
