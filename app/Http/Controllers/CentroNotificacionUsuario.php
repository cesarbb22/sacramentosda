<?php

namespace sistemaCuriaDiocesana\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Auth;
use sistemaCuriaDiocesana\Persona;
use sistemaCuriaDiocesana\Laico;
use sistemaCuriaDiocesana\UbicacionActa;
use sistemaCuriaDiocesana\Acta;
use sistemaCuriaDiocesana\ActaBautizo;
use sistemaCuriaDiocesana\ActaConfirma;
use sistemaCuriaDiocesana\ActaMatrimonio;
use sistemaCuriaDiocesana\ActaDefuncion;
use sistemaCuriaDiocesana\Parroquia;
use sistemaCuriaDiocesana\Solicitud_Acta;
use sistemaCuriaDiocesana\Solicitud;

class CentroNotificacionUsuario extends Controller
{

    public function notificacion()
    {
        return view('UserViews.notificaciones');
    }

    public function obtenerSolicitudes()
    {
        $solicitud = \sistemaCuriaDiocesana\Solicitud::with('user', 'actas', 'tipo', 'estado', 'user.parroquia')
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
        $solicitud = \sistemaCuriaDiocesana\Solicitud::find($id);

        $estado = $solicitud->IDEstado_Solicitud;
        $tipo = $solicitud->IDTipo_Solicitud;

        if ($estado == 1) {
            if ($tipo == 1) {
                try {
                    //eliminar acta
                    $sol_acta = \sistemaCuriaDiocesana\Solicitud_Acta::find($id);

                    $acta = Acta::find($sol_acta->IDActa);

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

                    Persona::destroy($acta->IDPersona);
                    Solicitud::destroy($id);
                    Log::info('Acta eliminada correctamente '.$acta);
                    return back()->with('msjBueno', "Se ha eliminado el acta correctamente");

                } catch (\Exception $e) {
                    Log::error('Error al eliminar acta: '.$e);
                    return back()->with('msjMalo', "Ha ocurrido un error al eliminar el acta");
                }
            } else {
                //editar acta
                try {
                    $sol_acta = \sistemaCuriaDiocesana\Solicitud_Acta::find($id);

                    $acta = Acta::find($sol_acta->IDActa);
                    $parroquias = \sistemaCuriaDiocesana\Parroquia::all();

                    $idBautismo = $acta->IDBautismo;
                    $idConfirma = $acta->IDConfirma;
                    $idMatrimonio = $acta->IDMatrimonio;
                    $idDefuncion = $acta->IDDefuncion;

                    $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
                    $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
                    $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
                    $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();

                    if ($idBautismo != null) {
                        $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                        $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                    } else {
                        $idUbicacionActaBau = null;
                        $UbicacionActaBautismo = null;
                    }

                    if ($idConfirma != null) {
                        $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                        $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                    } else {
                        $idUbicacionActaCon = null;
                        $UbicacionActaConfirma = null;
                    }

                    if ($idMatrimonio != null) {
                        $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                        $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                    } else {
                        $idUbicacionActaMat = null;
                        $UbicacionActaMatrimonio = null;
                    }

                    if ($idDefuncion != null) {
                        $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                        $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                    } else {
                        $idUbicacionActaDef = null;
                        $UbicacionActaDefuncion = null;
                    }

                    //$solicitud->IDEstado_Solicitud = 4;

                    //$solicitud->save();

                    return view('UserViews.editarActaSolicitud', ['persona' => Persona::findOrFail($acta->IDPersona), 'laico' => Laico::findOrFail($acta->IDPersona),
                        'acta' => $acta, 'actaBautismo' => $actaBautismo, 'actaConfirma' => $actaConfirma, 'actaMatrimonio' => $actaMatrimonio,
                        'actaDefuncion' => $actaDefuncion, 'UbicacionActaBautismo' => $UbicacionActaBautismo, 'UbicacionActaConfirma' => $UbicacionActaConfirma,
                        'UbicacionActaMatrimonio' => $UbicacionActaMatrimonio, 'UbicacionActaDefuncion' => $UbicacionActaDefuncion, 'parroquias' => $parroquias, 'IDSolicitud' => $id]);

                } catch (Exception $e) {
                    return back()->with('msjMalo', "Ha ocurrido un error");
                    return Redirect::to('/notificaciones');
                }
            }
        } else {
            $solicitud->IDEstado_Solicitud = 4;

            $solicitud->save();

            return Redirect::to('/notificaciones');
        }
    }
}
