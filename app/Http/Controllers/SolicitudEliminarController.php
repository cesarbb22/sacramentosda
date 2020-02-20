<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Validator;

use sistemaCuriaDiocesana\Persona;
use sistemaCuriaDiocesana\Laico;
use sistemaCuriaDiocesana\UbicacionActa;
use sistemaCuriaDiocesana\Acta;
use sistemaCuriaDiocesana\ActaBautizo;
use sistemaCuriaDiocesana\ActaConfirma;
use sistemaCuriaDiocesana\ActaMatrimonio;
use sistemaCuriaDiocesana\ActaDefuncion;
use sistemaCuriaDiocesana\Parroquia;
use sistemaCuriaDiocesana\Solicitud;
use sistemaCuriaDiocesana\Solicitud_Acta;


class SolicitudEliminarController extends Controller
{


     public function solicitudEliminar($id) {
         $acta = Acta::where('IDPersona', $id) -> first();

         $parroquias = \sistemaCuriaDiocesana\Parroquia::all();

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
