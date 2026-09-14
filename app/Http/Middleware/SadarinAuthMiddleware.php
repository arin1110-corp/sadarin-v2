<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SadarinAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | CEK AUTHENTICATED
        |--------------------------------------------------------------------------
        */

        if (!session('sadarin_authenticated')) {
            return redirect()->route('sadarin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        /*
        |--------------------------------------------------------------------------
        | SESSION VALID
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}