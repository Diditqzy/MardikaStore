<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function pendingSellers()
    {
        $sellers = User::where('role', 'seller')
                        ->where('status', 'pending')
                        ->get();

        return view('admin.users.pending_sellers', compact('sellers'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return back()->with('success', 'Penjual berhasil disetujui');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        return back()->with('success', 'Penjual ditolak');
    }
    // Halaman edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        // update password jika diisi
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Delete user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Pengguna berhasil dihapus.');
    }
    public function approvedSellers()
    {
        $sellers = User::where('role', 'seller')
                        ->where('status', 'approved')
                        ->with('store')
                        ->get();

        return view('admin.users.sellers_list', compact('sellers'));
    }
}
