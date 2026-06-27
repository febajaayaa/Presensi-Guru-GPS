<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
        abort(403, 'Kamu bukan admin');
    }

    return $next($request);
}
}