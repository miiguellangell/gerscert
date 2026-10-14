<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoIndex
{
    /**
     * Añade la cabecera X-Robots-Tag: noindex para que los buscadores no
     * indexen las páginas y PDF de certificados (contienen datos personales).
     * Cubre tanto respuestas HTML como descargas de PDF.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow');

        return $response;
    }
}
