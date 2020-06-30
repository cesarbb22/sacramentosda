<?php

namespace App\Http\Controllers;

use App\Acta;
use App\ActaBautizo;
use App\ActaConfirma;
use App\ActaDefuncion;
use App\ActaMatrimonio;
use App\Laico;
use App\Persona;
use App\Solicitud;
use App\UbicacionActa;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;

class CentroNotificaciones extends Controller
{

    public function notificacion()
    {
        return view('AdminViews.notificacionesAdmin');
    }

    public function obtenerSolicitudesAdmin()
    {
        //$solicitud = \App\Solicitud::where('IDEstado_Solicitud', '=', 3)->get();

        $solicitud = \App\Solicitud::with('user', 'actas', 'tipo', 'estado', 'user.parroquia')->where('IDEstado_Solicitud', '=', 3)
            ->get();
        return $solicitud;
    }


    public function aceptarSolicitud($id)
    {
        $solicitud = \App\Solicitud::find($id);

        if ($solicitud->IDTipo_Solicitud == 3) { // nuevo usuario
            $user = \App\User::find($solicitud->IDUser);
            $user->Activo = 1;

            $user->save();

            $this->cambiarEstadoSolicitud($solicitud, 4);
        } elseif ($solicitud->IDTipo_Solicitud == 1) {
            try {
                //eliminar acta
                $sol_acta = \App\Solicitud_Acta::find($id);
                $acta = Acta::find($sol_acta->IDActa);

                $this->eliminarActa($acta);

                // solicitud rechazada
                $this->cambiarEstadoSolicitud($solicitud, 1);

                Log::info('Acta eliminada correctamente ' . $acta);
                return back()->with('msjBueno', "Se ha eliminado el acta correctamente");

            } catch (\Exception $e) {
                Log::error('Error al eliminar acta: ' . $e);
                return back()->with('msjMalo', "Ha ocurrido un error al eliminar el acta");
            }
        }

        return Redirect::to('/centroNotificacionAdmin');
    }


    public function rechazarSolicitud($id)
    {
        $solicitud = \App\Solicitud::find($id);
        $this->cambiarEstadoSolicitud($solicitud, 2);

        return Redirect::to('/centroNotificacionAdmin');
    }

    private function cambiarEstadoSolicitud($solicitud, $estado)
    {
        $solicitud->IDEstado_Solicitud = $estado;
        $solicitud->save();
    }

    private function eliminarActa($acta)
    {
        $idBautismo = $acta->IDBautismo;
        $idConfirma = $acta->IDConfirma;
        $idMatrimonio = $acta->IDMatrimonio;
        $idDefuncion = $acta->IDDefuncion;

        if ($idBautismo != null) {
            $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
            $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
            $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
            $UbicacionActaBautismo->delete();
            $actaBautismo->delete();
        }

        if ($idConfirma != null) {
            $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
            $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
            $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
            $UbicacionActaConfirma->delete();
            $actaConfirma->delete();
        }

        if ($idMatrimonio != null) {
            $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
            $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
            $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
            $UbicacionActaMatrimonio->delete();
            $actaMatrimonio->delete();
        }

        if ($idDefuncion != null) {
            $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
            $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
            $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
            $UbicacionActaDefuncion->delete();
            $actaDefuncion->delete();
        }

        $acta->delete();
        Laico::destroy($acta->IDPersona);
        Persona::destroy($acta->IDPersona);
    }
}
