<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (FacadesAuth::check() && $request->is('/')) {
            return redirect('/dashboard');
        }

        if (!FacadesAuth::check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
