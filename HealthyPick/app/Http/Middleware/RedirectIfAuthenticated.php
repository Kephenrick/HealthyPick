<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log auth/session state for debugging
        try {
            $user = Auth::user();
            $userId = $user ? ($user->User_ID ?? $user->id ?? null) : null;
            $userEmail = $user ? ($user->Email ?? $user->email ?? null) : null;
            \Log::info('RedirectIfAuthenticated - session_id: ' . session()->getId() . ' | Auth::check: ' . (Auth::check() ? 'true' : 'false') . ' | user_id: ' . ($userId ?? 'null') . ' | user_email: ' . ($userEmail ?? 'null'));
        } catch (\Exception $e) {
            \Log::error('RedirectIfAuthenticated log error: ' . $e->getMessage());
        }

        if (Auth::check()) {
            return redirect('/user');
        }

        return $next($request);
    }
}
