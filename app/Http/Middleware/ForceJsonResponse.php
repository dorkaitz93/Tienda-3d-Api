<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        // Forzamos el header 'Accept' a application/json en cada petición
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}