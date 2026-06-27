<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScopeToSchool
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $user = auth()->user();

    if ($user && $user->role === 'admin') {
        if (!$user->school_id) {
            abort(403, 'Akun admin belum dikaitkan ke sekolah.');
        }
        // Simpan ke request agar bisa diakses controller
        $request->merge(['scoped_school_id' => $user->school_id]);
    }

    return $next($request);
}
}
