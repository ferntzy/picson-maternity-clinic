<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request using Spatie's role authorization.
     *
     * @param string ...$roles The allowed roles
     * @example middleware('role:admin,director')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! auth()->check()) {
            abort(401, 'Please log in first.');
        }

        $user = auth()->user();

        // If no roles specified, allow any authenticated user
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has any of the specified roles using Spatie
        if (! $user->hasAnyRole($roles)) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
