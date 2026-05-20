<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRole {
    /**
     * Permite uno o varios roles. Si la petición es API, responde JSON; si es web, redirige.
     * Uso: ->middleware('checkrole:admin') o ->middleware('checkrole:admin,mecanico')
     */
    public function handle(Request $request, Closure $next, ...$roles) {
        $user = Auth::user();
        if (!$user || (count($roles) && !in_array($user->rol, $roles))) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'msg' => 'No tienes permiso para esto'
                ], 403);
            } else {
                // Redirige a login si no está autenticado, o a home si no tiene rol
                return redirect($user ? '/' : route('login'))->with('error', 'No tienes permiso para acceder a esta sección.');
            }
        }
        return $next($request);
    }
}
