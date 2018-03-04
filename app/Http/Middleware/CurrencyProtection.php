<?php

namespace AutoKit\Http\Middleware;

use AutoKit\Components\Money\Currency;
use Closure;

class CurrencyProtection
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
        if (Currency::exist(strtoupper($request->currency))) {
            return $next($request);
        }
        return abort(404);
    }
}
