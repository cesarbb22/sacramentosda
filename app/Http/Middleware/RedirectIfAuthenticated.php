<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->Activo == 0) {
                Auth::logout();
                $request->session()->flash('errorLogin', 'Su solicitud aún no ha sido aceptada!');
                return Redirect::to('/login');
            } else {
                if(Auth::user()->puesto->IDPuesto == 1 || Auth::user()->puesto->IDPuesto == 2) {
                    return Redirect::to('/ActasAdmin');
                } else {
                    return Redirect::to('/Actas');
                }
            }
        }

        return $next($request);
    }
}
