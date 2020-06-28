<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;

class AdminMiddleware
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
        if ($request->user() && ($request->user()->puesto->IDPuesto != 1 && $request->user()->puesto->IDPuesto != 2)) {
            return new Response(view('unauthorized'));
        }

        return $next($request);
    }
}
