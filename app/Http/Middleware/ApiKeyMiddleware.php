<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Validates the X-API-KEY header against GEMINI_API_KEY in the environment.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $serverApiKey = env('GEMINI_API_KEY');

        if (empty($serverApiKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'GEMINI_API_KEY belum dikonfigurasi di environment server (.env).',
                'data' => null,
            ], 500);
        }

        $providedApiKey = $request->header('X-API-KEY');

        // Optional fallback: support Authorization: Bearer <key>
        if (empty($providedApiKey)) {
            $providedApiKey = $request->bearerToken();
        }

        if (empty($providedApiKey) || !hash_equals((string) $serverApiKey, (string) $providedApiKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Header X-API-KEY tidak valid atau tidak disertakan.',
                'data' => null,
            ], 401);
        }

        return $next($request);
    }
}
