<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Hash;
use App\User;

use Validator;

class UserController extends Controller {

    public function index() {
        $parroquias = \App\Parroquia::all();
        $puesto = \App\Puesto::where('IDPuesto', '=', Auth::user()->IDPuesto)->first();
        if ($puesto->IDPuesto == 1 || $puesto->IDPuesto == 2) {
            return view('auth.editarPerfil', ['parroquias' => $parroquias, 'puesto' => $puesto]);
        } else {
            return view('auth.editarPerfilUser', ['parroquias' => $parroquias, 'puesto' => $puesto]);
        }
    }

    public function index2() {
        $parroquias = \App\Parroquia::all();
        $puesto = \App\Puesto::where('IDPuesto', '!=', 1)->get();
        return view('AdminViews.AgregarUsuarioAdmin', ['parroquias' => $parroquias, 'puesto' => $puesto]);
    }

    public function home() {
        $usuarios = \App\User::where([['IDUser', '!=', Auth::user()->IDUser], ['IDUser', '!=', 1]])->get();

        return view('AdminViews.MantenimientoUsuario', ['usuarios'=> $usuarios]);
    }

    public function cambiarContrasena(Request $request) {

        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];

        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            if(Hash::check($request->mypassword, Auth::user()->password)) {
                $user = new User;
                $user->where('Email', '=', Auth::user()->email)
                     ->update(['password' => bcrypt($request->password)]);
                return back()->with('msjBueno', "Se ha cambiado correctamente la contraseña");
            } else {
                return back()->with('msjMalo', "Ha ocurrido un error al cambiar la contraseña");
            }
        }
    }

    public function editarPerfilUser(Request $request) {
        try {
            $user = new User;
            $user->where('IDUser', '=', Auth::user()->IDUser)
                 ->update(['Nombre' => $request->name, 'PrimerApellido' => $request->pApellido, 'SegundoApellido' => $request->sApellido, 'Email' => $request->email, 'IDParroquia' => $request->parroquia, 'NumCelular' => $request->numCel]);
            return back()->with('msjBueno', "Se ha guardado correctamente la información");
        } catch(\Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error al editar la información");
        }
    }


    public function EliminarUsuario($id) {
        try {
            User::destroy($id);
            return back()->with('msjBueno', "Se ha eliminado el usuario correctamente");
            return Redirect::to('/mantenimientoUsuarios');
        } catch(\Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error al eliminar el usuario");
            return Redirect::to('/mantenimientoUsuarios');
        }
    }

    public function editarUsuarioAdmin(Request $request) {
        try {
            $id = $_POST['IDUser'];

            $user = User::find($id);
            $user->Nombre = $request->name;
            $user->PrimerApellido = $request->pApellido;
            $user->SegundoApellido = $request->sApellido;
            $user->email = $request->email;
            $user->IDParroquia = $request->parroquia;
            $user->NumCelular = $request->numCel;
            $user->IDPuesto = $request->puesto;
            $user->Activo = 0;
            if ($request->activoCheck == "on") {
                $user->Activo = 1;
            }
            $user -> save();

            return back()->with('msjBueno', "Se ha guardado correctamente la información");
            return Redirect::to('/ActasAdmin');
        } catch(\Exception $e) {
            Log::error($e);
            return back()->with('msjMalo', "Ha ocurrido un error al editar la información");
            return Redirect::to('/ActasAdmin');
        }
    }

    public function mostrarUsuario($id) {
        $usuario = User::where('IDUser', $id) -> first();
        $parroquias = \App\Parroquia::all();
        $puesto = \App\Puesto::where('IDPuesto', '!=', 1)->get();
        return view('AdminViews.EditarUsuariosAdmin', ['usuario'=> $usuario, 'parroquias' => $parroquias, 'puesto' => $puesto]);
    }

    public function agregarUsuario(Request $request) {
        try {
            $email = \App\User::where('email', $request->email)->first();

            if ($email != null) {
                $request->session()->flash('errorEmail', '¡El email ya se encuentra registrado! Revise sus datos e intente nuevamente');

                $parroquias = \App\Parroquia::all();
                $puesto = \App\Puesto::all();
                return view('AdminViews.AgregarUsuarioAdmin', ['parroquias' => $parroquias, 'puesto' => $puesto]);
            }

            $user = new User;

            $user->Nombre = $request->name;
            $user->PrimerApellido = $request->pApellido;
            $user->SegundoApellido = $request->sApellido;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->IDParroquia = $request->parroquia;
            $user->IDPuesto = $request->puesto;
            $user->Activo = 1;

            if ($request->has('numCel')) {
                $user->NumCelular = $request->numCel;
            }

            $user->save();

            return back()->with('msjBueno', "Se ha creado correctamente el usuario");
            return Redirect::to('/ActasAdmin');
        } catch(\Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error al ingresar el usuario");
            return Redirect::to('/ActasAdmin');
        }
    }

}
