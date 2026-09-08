<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EdgeCache
{
    /**
     * Handle an incoming request and attach Vercel Edge caching headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  int  $sMaxAge
     */
    public function handle(Request $request, Closure $next, int $sMaxAge = 3600): Response
    {
        $response = $next($request);

        // Never cache for authenticated admin sessions, unsafe methods, or non-200 responses
        if (!$request->isMethodSafe() || !$response->isSuccessful() || auth()->check()) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, private');
            return $response;
        }

        // Attach Vercel Edge Network Cache headers
        $response->headers->set('Cache-Control', "public, max-age=0, s-maxage={$sMaxAge}, stale-while-revalidate=86400");

        return $response;
    }
}
