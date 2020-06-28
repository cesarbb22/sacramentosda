<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Solicitud;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function index() {
        $parroquias = \App\Parroquia::all();
        $puesto = \App\Puesto::where('IDPuesto', '!=', 1)->get();
        return view('auth.register', ['parroquias' => $parroquias, 'puesto' => $puesto]);
    }


    public function registerForm(Request $request) {

        $email = \App\User::where('email', $request->email)->first();

        if ($email != null) {
            $request->session()->flash('errorEmail', '¡El email ya se encuentra registrado! Revise sus datos e intente nuevamente');

            $parroquias = \App\Parroquia::all();
            $puesto = \App\Puesto::all();
            return view('auth.register', ['parroquias' => $parroquias, 'puesto' => $puesto]);
        }

        $user = new User;

        $user->Nombre = $request->name;
        $user->PrimerApellido = $request->pApellido;
        $user->SegundoApellido = $request->sApellido;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->IDParroquia = $request->parroquia;
        $user->IDPuesto = $request->puesto;
        $user->Activo = 0;

        if ($request->has('numCel')) {
            $user->NumCelular = $request->numCel;
        }

        $user->save();

        //agregar la solicitud
        $solicitud = new Solicitud;
        $solicitud->IDUser = $user->IDUser;
        $solicitud->IDTipo_Solicitud = 3;
        $solicitud->IDEstado_Solicitud = 3;

        $solicitud->save();

        if($user->save()){
            $request->session()->flash('justLogin', '¡Solicitud de registro enviada! Debe esperar que el administrador la acepte');
            return view('auth.login');
        } else{
            $request->session()->flash('errorRegister', '¡Ha ocurrido un error! Revise sus datos e intente nuevamente');
            return view('auth.register');
        }
    }
}
