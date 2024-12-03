<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAccount
{
    public function handle($request, Closure $next, $guard = 'account')
    {
        if (Auth::guard($guard)->check()) {
            return redirect(route('user.dashboard'));
        }

        return $next($request);
    }
}
