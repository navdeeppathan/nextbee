<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect('/');
        }

        // Check role
        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
