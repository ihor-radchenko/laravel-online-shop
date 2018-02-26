<?php

namespace AutoKit\Http\Middleware;

use AutoKit\Facades\Cart;
use Closure;

class OrderIfCartNotEmpty
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
        if (Cart::isNotEmpty()) {
            return $next($request);
        }
        return abort(404);
    }
}
