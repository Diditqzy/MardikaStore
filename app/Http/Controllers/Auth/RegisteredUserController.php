<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:buyer,seller'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'Email telah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'required' => 'Silahkan lengkapi data anda.',
        ]);

        $role = $request->role ?? 'buyer';
        $status = $role === 'seller' ? 'pending' : 'approved';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'status' => $status,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        

        // return redirect($this->redirectByRole());
        return redirect()
        ->route('register')
        ->with('success', 'Akun berhasil dibuat, silahkan login.');
    }

    private function redirectByRole()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return route('admin.dashboard');
        }

        if ($user->role === 'seller') {

            if ($user->status === 'pending') {
                return route('seller.pending');
            }

            if ($user->status === 'rejected') {
                return route('seller.rejected');
            }

            if ($user->status === 'approved') {
                return route('seller.dashboard');
            }
        }

        return route('buyer.dashboard');
    }
}
