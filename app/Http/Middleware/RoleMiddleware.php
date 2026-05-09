<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $peran): Response
    {
        if (! $request->user() || $request->user()->peran !== $peran) {
            abort(403);
        }

        return $next($request);
    }
}
