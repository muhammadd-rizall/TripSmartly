<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request);
        }

        // Cek apakah user memiliki role 'user'
        if (Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Akses ditolak');
        }
        abort(433, 'Unauthorized action.');
    }
}
