<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\User;
class StoreManagementController extends Controller
{
    public function index()
    {
          // Relasi ke pemilik toko
  
           $stores = Store::with('user')->paginate(10);

        return view('admin.stores.index', compact('stores'));
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        $store->delete();

        return redirect()->route('admin.stores.index')
            ->with('success', 'Toko tersebut telah berhasil dihapus.');
    }
}
