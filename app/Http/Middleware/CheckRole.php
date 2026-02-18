<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! auth()->check()) {
            // or return redirect()->route('filament.admin.auth.login');  ← adjust to your login path
            abort(401, 'Please log in first.');
        }

        $userType = auth()->user()?->type ?? null;

        if (! in_array($userType, $roles)) {
            abort(403, 'You do not have permission to access this panel.');
        }

        return $next($request);
    }
}
