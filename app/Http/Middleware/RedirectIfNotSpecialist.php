<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotSpecialist
{
    public function handle($request, Closure $next, $guard = 'specialist')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('specialist/login');
        }
        return $next($request);
    }
}
