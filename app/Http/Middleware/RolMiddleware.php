<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        if (!$user->estado) {
            auth()->logout();
            return redirect('/login')->with('error', 'Usuario deshabilitado.');
        }

        // Comparación insensible a mayúsculas
        if (!in_array(strtoupper($user->rol), array_map('strtoupper', $roles))) {
            abort(403, 'No tienes permiso para acceder.');
        }

        return $next($request);
    }
}
