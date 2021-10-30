<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfSpecialist
{
    public function handle($request, Closure $next, $guard = 'specialist')
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/specialist');
        }
        return $next($request);
    }
}
