<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next)
    {
        // if (auth('account')->user() && (auth('account')->user()->status === "pending" || auth('account')->user()->status == ""  )) {
        //     return redirect()->route('user.pending');
        // }
        // else
         if (auth('account')->user() && (auth('account')->user()->status === "suspended" || auth('account')->user()->status == ""  )) {
           

            return redirect()->route('user.suspended');

        }

        return $next($request);
    }
}
