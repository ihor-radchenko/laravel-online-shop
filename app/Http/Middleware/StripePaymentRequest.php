<?php

namespace AutoKit\Http\Middleware;

use Closure;

class StripePaymentRequest
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
        if ($request->has('stripeToken')) {
            return $next($request);
        }
        return abort(404);
    }
}
