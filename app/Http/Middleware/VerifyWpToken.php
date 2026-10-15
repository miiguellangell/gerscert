<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Autentica las llamadas de WordPress (gerscol.com) con el token compartido
 * WP_API_TOKEN del .env (en WordPress: GC_CERT_API_TOKEN en wp-config.php).
 */
class VerifyWpToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = (string) config('services.wordpress.token');

        if ($token === '' || ! hash_equals($token, (string) $request->bearerToken())) {
            return response()->json(['message' => 'No autorizado.'], 401);
        }

        return $next($request);
    }
}
