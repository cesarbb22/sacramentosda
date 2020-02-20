<?php

namespace sistemaCuriaDiocesana\Http\Controllers\Auth;

use sistemaCuriaDiocesana\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['Email' => $request['email'], 'password' => $request['password'] ])) { 
            //return Redirect::to('/ActasAdmin');
            if (Auth::user()->Activo == 0) {
                Auth::logout();
                $request->session()->flash('errorLogin', 'Su solicitud aún no ha sido aceptada!');
                return Redirect::to('login');
            } else {
                if(Auth::user()->puesto->IDPuesto == 1 || Auth::user()->puesto->IDPuesto == 2) {
                    return Redirect::to('/ActasAdmin');
                } else {
                    return Redirect::to('/Actas');
                }
            }  
        } else {
            $request->session()->flash('errorLogin', '¡Correo electrónico o contraseña incorrecta!');
            return Redirect::to('login');
        }    
    }
}
