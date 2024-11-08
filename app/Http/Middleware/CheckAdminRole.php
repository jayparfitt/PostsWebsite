<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole extends Middleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
