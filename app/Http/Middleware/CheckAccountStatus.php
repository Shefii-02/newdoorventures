<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next)
    {
       
        if (auth('account')->user() && (auth('account')->user()->status === "pending" || auth('account')->user()->status == ""  )) {
           

            return redirect()->route('public.account.pending');

        }

        return $next($request);
    }
}
