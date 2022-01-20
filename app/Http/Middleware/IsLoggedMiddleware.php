<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLoggedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check($request)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Error no puedes acceder, No estas Logueado',
                'data' => null
            ], 401);
        }
        return $next($request);
    }
}
