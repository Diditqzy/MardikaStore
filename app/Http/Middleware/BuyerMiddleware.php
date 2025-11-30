<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Authz;
use Symfony\Component\HttpFoundation\Response;

class BuyerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'buyer') {
            return redirect('/');
        }

        return $next($request);
    }
}
