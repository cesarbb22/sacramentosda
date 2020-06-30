<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Auth;
use App\Persona;
use App\Laico;
use App\UbicacionActa;
use App\Acta;
use App\ActaBautizo;
use App\ActaConfirma;
use App\ActaMatrimonio;
use App\ActaDefuncion;
use App\Parroquia;
use App\Solicitud_Acta;
use App\Solicitud;

class CentroNotificacionUsuario extends Controller
{

    public function notificacion()
    {
        return view('UserViews.notificaciones');
    }

    public function obtenerSolicitudes()
    {
        $solicitud = \App\Solicitud::with('user', 'actas', 'tipo', 'estado', 'user.parroquia')
            ->where('IDUser', '=', Auth::user()->IDUser)
            ->where(function ($q) {
                $q->where('IDEstado_Solicitud', '=', 1)
                    ->orWhere('IDEstado_Solicitud', '=', 2);
            })
            ->get();

        return $solicitud;
    }


    public function aceptarSolicitud($id)
    {
        try {
            $solicitud = \App\Solicitud::find($id);

            $solicitud->IDEstado_Solicitud = 4;

            $solicitud->save();

            return Redirect::to('/notificaciones');

        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error");
        }
    }
}
