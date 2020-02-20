<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;

class CentroNotificaciones extends Controller
{

      public function notificacion() {
        return view('AdminViews.notificacionesAdmin');
    }

    public function obtenerSolicitudesAdmin() {
      //$solicitud = \App\Solicitud::where('IDEstado_Solicitud', '=', 3)->get();

      $solicitud = \App\Solicitud::with('user', 'actas', 'tipo', 'estado', 'user.parroquia')->where('IDEstado_Solicitud', '=', 3)

        ->get();
      return $solicitud;
    }


    public function aceptarSolicitud($id) {
      $solicitud = \App\Solicitud::find($id);

      if ($solicitud->IDTipo_Solicitud == 3) {
        $user = \App\User::find($solicitud->IDUser);
        $user->Activo = 1;

        $user->save();

        $solicitud->IDEstado_Solicitud = 4;
        $solicitud->save();
      } else {
        $solicitud->IDEstado_Solicitud = 1;
        $solicitud->save();
      }

      return Redirect::to('/centroNotificacionAdmin');
    }


    public function rechazarSolicitud($id) {
      $solicitud = \App\Solicitud::find($id);

      $solicitud->IDEstado_Solicitud = 2;

      $solicitud->save();

      return Redirect::to('/centroNotificacionAdmin');
    }
}
