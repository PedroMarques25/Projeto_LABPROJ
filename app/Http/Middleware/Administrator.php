<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Administrator
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->isAdmin() && Auth::user()->isGuide()) {
            return redirect()->route('show.profile');
        }

        return $next($request);
    }
}
