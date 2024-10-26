<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Manejar la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== $role) {
            // Redirigir o mostrar un error si el rol no coincide
            return redirect('/login')->withErrors(['error' => 'Acceso denegado.']);
        }

        return $next($request);
    }
}
