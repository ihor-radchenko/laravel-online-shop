<?php

namespace AutoKit\Http\Middleware;

use Closure;

class Currency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasCookie('currency')) {
            return $next($request);
        }
        return $next($request)->withCookie(cookie()->forever('currency', 'USD'));
    }
}
