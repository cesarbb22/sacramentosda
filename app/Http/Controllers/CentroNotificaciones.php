<?php

namespace App\Http\Controllers;

use App\ActaPrimeraComunion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

class CentroNotificaciones extends Controller
{

    public function notificacion()
    {
        return view('AdminViews.notificacionesAdmin');
    }

    public function obtenerSolicitudesAdmin(Request $request)
    {
        // enviado -> 4, recibido -> 5
        $tipo_solicitud = $request->tipo;

        $idParroquia = Auth::user()->IDParroquia;
        if (Auth::user()->puesto->IDPuesto == 1 || Auth::user()->puesto->IDPuesto == 2) {
            $idParroquia = -1;
        }

        $solicitud = null;
        if ($tipo_solicitud == 5) { //recibidos
            $solicitud = \App\Solicitud::with('user', 'acta', 'tipo', 'estado', 'user.parroquia', 'parroquia')
                ->where("IDParroquia", '=', $idParroquia)
                ->orderBy('IDEstado_Solicitud', 'asc')
                ->orderBy('Fecha_Solicitud', 'desc')
                ->get();
        } else { //enviados
            $solicitud = \App\Solicitud::with('user', 'acta', 'tipo', 'estado', 'user.parroquia', 'parroquia')
                ->where('IDUser', '=', Auth::user()->IDUser)
                ->orderBy('IDEstado_Solicitud', 'asc')
                ->orderBy('Fecha_Solicitud', 'desc')
                ->get();
        }

        return $solicitud;
    }

    public function resetAviso(Request $request) {
        try {
            $acta = Acta::findOrFail($request->idActaAvisar);

            $partida = null;
            switch ($request->sacramento) {
                case 'PRIMERA_COMUNION':
                    $partida = ActaPrimeraComunion::findOrFail($acta->IDPrimeraComunion);
                    break;
                case 'CONFIRMA':
                    $partida = ActaConfirma::findOrFail($acta->IDConfirma);
                    break;
                case 'MATRIMONIO':
                    $partida = ActaMatrimonio::findOrFail($acta->IDMatrimonio);
                    break;
                case 'MATRIMONIO_ADICIONAL':
                    $partida = ActaMatrimonio::findOrFail($request->matrimonioId);
                    break;
                case 'DEFUNCION':
                    $partida = ActaDefuncion::findOrFail($acta->IDDefuncion);
                    break;
            }

            $partida->AvisoEnviado = 0;
            $partida->save();

            return back()->with('msjBueno', "Aviso enviado exitosamente!");
        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error");
        }
    }

    public function enviarAviso(Request $request) {
        try {
            $acta = Acta::findOrFail($request->idActaAvisar);

            $partida = null;
            switch ($request->sacramento) {
                case 'PRIMERA_COMUNION':
                    $partida = ActaPrimeraComunion::findOrFail($acta->IDPrimeraComunion);
                    break;
                case 'CONFIRMA':
                    $partida = ActaConfirma::findOrFail($acta->IDConfirma);
                    break;
                case 'MATRIMONIO':
                    $partida = ActaMatrimonio::findOrFail($acta->IDMatrimonio);
                    break;
                case 'MATRIMONIO_ADICIONAL':
                    $partida = ActaMatrimonio::findOrFail($request->matrimonioId);
                    break;
                case 'DEFUNCION':
                    $partida = ActaDefuncion::findOrFail($acta->IDDefuncion);
                    break;
            }

            $solicitud = new Solicitud;

            $solicitud->IDUser = Auth::user()->IDUser;
            $solicitud->IDTipo_Solicitud = 3;
            $solicitud->IDEstado_Solicitud = 3;
            $solicitud->Fecha_Solicitud = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subDays(1));
            $solicitud->IDParroquia = $request->idParroquiaAvisar;
            $solicitud->IDActa = $request->idActaAvisar;
            $solicitud->Sacramento = $request->sacramento;
            $solicitud->Descripcion = $request->descripcion;
            $solicitud->save();

            $partida->AvisoEnviado = 1;
            $partida->save();

            return back()->with('msjBueno', "Aviso enviado exitosamente!");
        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error");
        }
    }

    public function buscarCedulaAvisa(Request $request) {
        try {
            $cedula = $request->numCedula;
            $acta = Acta::with('persona')
                ->whereHas('persona', function (Builder $query) use ($cedula) {
                    $query->where('persona.Cedula', '=', $cedula);
                })->get();
            return $acta;
        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error".$e);
        }
    }


    public function aceptarSolicitud($id)
    {
        try {
            $solicitud = \App\Solicitud::find($id);
            $solicitud->IDEstado_Solicitud = 4;
            $solicitud->save();

            Log::info('Solicitud finalizada correctamente: ' . $solicitud);
            return back()->with('msjBueno', "Se ha finalizado la solicitud correctamente!");
        } catch (\Exception $e) {
            Log::error('Error al finalizar solicitud: ' . $e);
            return back()->with('msjMalo', "Ha ocurrido un error al finalizar la solicitud");
        }
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
