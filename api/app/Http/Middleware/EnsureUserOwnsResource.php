<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserOwnsResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $paramName  The name of the route parameter to check ownership against
     */
    public function handle(Request $request, Closure $next, string $paramName): Response
    {
        $routeParamId = $request->route($paramName);

        if (is_object($routeParamId)) {
            $routeParamId = $routeParamId->id;
        }

        if (auth()->id() != $routeParamId) {
            return response()->json([
                'message' => 'Non hai il permesso di accedere a questa risorsa.',
            ], 403);
        }

        return $next($request);
    }
}
