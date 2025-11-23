<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'seller') {
            return redirect('/');
        }

        // Jika seller pending
        if (Auth::user()->status === 'pending') {
            return redirect('/seller/pending');
        }

        // Jika seller rejected
        if (Auth::user()->status === 'rejected') {
            return redirect('/seller/rejected');
        }

        // Seller approved => boleh masuk
        return $next($request);
    }
}
