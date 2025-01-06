<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has an 'admin' role
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 2) {
            return $next($request);
        }
        // Redirect to login or show 403 error if unauthorized
        return redirect()->route('admin.login')->with('error', 'Unauthorized Access');
    }
}
