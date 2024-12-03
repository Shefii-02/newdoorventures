<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAccount
{
    public function handle($request, Closure $next, $guard = 'account')
    {
     
        // if (! Auth::guard($guard)->check()) {
        //     if ($request->ajax() || $request->wantsJson()) {
        //         return response('Unauthorized.', 401);
        //     }

        //     return redirect()->guest(route('user.login'));
        // }

           

        return $next($request);
    }
}
