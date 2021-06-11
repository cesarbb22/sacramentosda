<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

use App\Acta;
use App\ActaConfirma;
use App\ActaDefuncion;
use App\ActaMatrimonio;
use App\Solicitud;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CentroNotificacionUsuario extends Controller
{

    public function notificacion()
    {
        return view('UserViews.notificaciones');
    }

    public function obtenerSolicitudes(Request $request)
    {
        // enviado -> 4, recibido -> 5
        $tipo_solicitud = $request->tipo;

        $idParroquia = Auth::user()->IDParroquia;
        if (Auth::user()->puesto->IDPuesto == 1 || Auth::user()->puesto->IDPuesto == 2) {
            $idParroquia = -1;
        }

        $solicitud = null;
        if ($tipo_solicitud == 5) { //recibido
            $solicitud = \App\Solicitud::with('user', 'acta', 'tipo', 'estado', 'user.parroquia', 'parroquia')
                ->where("IDParroquia", '=', $idParroquia)
                ->orderBy('IDEstado_Solicitud', 'asc')
                ->orderBy('Fecha_Solicitud', 'desc')
                ->get();
        } else { //enviado
            $solicitud = \App\Solicitud::with('user', 'acta', 'tipo', 'estado', 'user.parroquia', 'parroquia')
                ->where('IDUser', '=', Auth::user()->IDUser)
                ->orderBy('IDEstado_Solicitud', 'asc')
                ->orderBy('Fecha_Solicitud', 'desc')
                ->get();
        }

        return $solicitud;
    }

    public function enviarAviso(Request $request) {
        try {
            $acta = Acta::findOrFail($request->idActaAvisar);

            $partida = null;
            switch ($request->sacramento) {
                case 'CONFIRMA':
                    $partida = ActaConfirma::findOrFail($acta->IDConfirma);
                    break;
                case 'MATRIMONIO':
                    $partida = ActaMatrimonio::findOrFail($acta->IDMatrimonio);
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
            return back()->with('msjMalo', "Ha ocurrido un error".$e);
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
            return back()->with('msjBueno', "Se ha finalizado la solicitud correctamente");
        } catch (\Exception $e) {
            Log::error('Error al finalizar solicitud: ' . $e);
            return back()->with('msjMalo', "Ha ocurrido un error al finalizar la solicitud");
        }
    }

    function formatDate($dateString)
    {
        $dd = substr($dateString, 0, 2);
        $mm = substr($dateString, 3, 2);
        $yyyy = substr($dateString, 6, 4);
        return $yyyy . '-' . $mm . '-' . $dd . ' 00:00:00';
    }

    function formatDateToString($dateString)
    {
        $yyyy = substr($dateString, 0, 4);
        $mm = substr($dateString, 5, 2);
        $dd = substr($dateString, 8, 2);
        return $dd . '/' . $mm . '/' . $yyyy;
    }
}
