<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VendorAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki role vendor
        if (!Auth::check() || Auth::user()->role !== 'vendor') {
            if (Auth::check()) {
                Auth::logout();
            }
            return redirect('/login/vendor')
                ->with('error', 'Silakan login sebagai vendor terlebih dahulu.');
        }

        return $next($request);
    }
}
