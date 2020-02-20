<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Validator;

use App\Persona;
use App\Laico;
use App\UbicacionActa;
use App\Acta;
use App\ActaBautizo;
use App\ActaConfirma;
use App\ActaMatrimonio;
use App\ActaDefuncion;
use App\Parroquia;
use App\Solicitud;
use App\Solicitud_Acta;


class SolicitudEliminarController extends Controller
{


     public function solicitudEliminar($id) {
         $acta = Acta::where('IDPersona', $id) -> first();

         $parroquias = \App\Parroquia::all();

        return view('AdminViews.SolicitudEliminar', ['parroquias'=> $parroquias, $id ]);
    }

     public function crearSolicitudEliminar(Request $request) {
         // $acta = Acta::where('IDPersona', $id) -> first();

         $Solicitud = new Solicitud;

            $Solicitud->IDPersona  = 154;
            $Solicitud->IDTipo_Solicitud =1;
            $Solicitud->IDEstado_Solicitud =3;

            $Solicitud->save();

            $Solicitud_Acta = new Solicitud_Acta;

            $Solicitud_Acta->IDSolicitud = $Solicitud->IDSolicitud;
            $Solicitud_Acta->IDActa =  $acta->IDActa;
            $Solicitud_Acta-> Descripcion = $request->descripcion;

            $Solicitud_Acta->save();

             return Redirect::to('/consultaAdmin');


     }



}
