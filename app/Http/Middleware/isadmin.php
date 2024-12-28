<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class isadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->type === 'admin' && Auth::user()->active === 1) {
            return $next($request);

        } elseif (Auth::check() && Auth::user()->type === 'monitor' && Auth::user()->active === 1) {
            return $next($request);
        }
        return redirect('login');

    }
}
