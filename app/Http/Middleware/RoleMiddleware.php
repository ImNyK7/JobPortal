<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        // User not logged in → redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // User logged in but doesn't have the required role
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect()->route('dashboard')
                ->with('warning', 'You are not allowed to access that page.');
        }

        return $next($request);
    }
}
