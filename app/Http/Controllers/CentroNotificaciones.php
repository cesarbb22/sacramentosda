<?php

namespace sistemaCuriaDiocesana\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use sistemaCuriaDiocesana\User;

class CentroNotificaciones extends Controller
{
    
      public function notificacion() {
        return view('AdminViews.notificacionesAdmin');
    }
    
    public function obtenerSolicitudesAdmin() {
      //$solicitud = \sistemaCuriaDiocesana\Solicitud::where('IDEstado_Solicitud', '=', 3)->get();
      
      $solicitud = \sistemaCuriaDiocesana\Solicitud::with('user', 'actas', 'tipo', 'estado', 'user.parroquia')->where('IDEstado_Solicitud', '=', 3)
        
        ->get();
      return $solicitud;
    }
    
    
    public function aceptarSolicitud($id) {
      $solicitud = \sistemaCuriaDiocesana\Solicitud::find($id);
      
      if ($solicitud->IDTipo_Solicitud == 3) {
        $user = \sistemaCuriaDiocesana\User::find($solicitud->IDUser);
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
      $solicitud = \sistemaCuriaDiocesana\Solicitud::find($id);
      
      $solicitud->IDEstado_Solicitud = 2;
      
      $solicitud->save();
      
      return Redirect::to('/centroNotificacionAdmin');
    }
}