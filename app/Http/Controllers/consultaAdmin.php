<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use sistemaCuriaDiocesana\Parroquia;
use sistemaCuriaDiocesana\Persona;
use sistemaCuriaDiocesana\Acta;

class consultaAdmin extends Controller
{

    public function home() {
        $parroquias = \sistemaCuriaDiocesana\Parroquia::all();
        $personas = \sistemaCuriaDiocesana\Persona::All();

        return view('AdminViews.ConsultaActaAdmin', ['parroquias'=> $parroquias, 'personas'=> $personas]);
    }

    public function query(Request $request) {
        if ($request->has('buscCed')) {

            $cedula = $request->numCed;

                $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                    ->whereHas('persona', function ($query) use ($cedula) {
                        $query->where('Persona.Cedula', 'like', '%'.$cedula.'%');
                    })
                    ->get();

                return $acta;
        } else {
            if ($request->nombre != '' && $request->parroquia != '' && $request->fechaInicio != '') {
                $nombre = $request->nombre;
                $parroquia = $request->parroquia;
                $fechaInicio = $request->fechaInicio;
                $fechaFin = $request->fechaFin;

                $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                    ->whereHas('persona', function ($query) use ($nombre) {
                        $query->where('Persona.Nombre', 'like', '%'.$nombre.'%');
                    })
                    ->whereHas('parroquia', function ($query) use ($parroquia) {
                        $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                    })
                    ->whereHas('persona.laico', function ($query) use ($fechaInicio, $fechaFin) {
                        $query->whereBetween('Laico.FechaNacimiento', array($fechaInicio, $fechaFin)); // side note: operator '=' is default, so can be ommited
                    })
                    ->get();

                return $acta;
            } else {
                if ($request->nombre != '' && $request->parroquia != '') {
                    $nombre = $request->nombre;
                    $parroquia = $request->parroquia;

                    $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                        ->whereHas('persona', function ($query) use ($nombre) {
                            $query->where('Persona.Nombre', 'like', '%'.$nombre.'%');
                        })
                        ->whereHas('parroquia', function ($query) use ($parroquia) {
                            $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                        })
                        ->get();

                    return $acta;
                } else {
                    if ($request->parroquia != '' && $request->fechaInicio != '') {
                        $parroquia = $request->parroquia;
                        $fechaInicio = $request->fechaInicio;
                        $fechaFin = $request->fechaFin;

                        $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                            ->whereHas('parroquia', function ($query) use ($parroquia) {
                                $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                            })
                            ->whereHas('persona.laico', function ($query) use ($fechaInicio, $fechaFin) {
                                $query->whereBetween('Laico.FechaNacimiento', array($fechaInicio, $fechaFin)); // side note: operator '=' is default, so can be ommited
                            })
                            ->get();

                        return $acta;
                    } else {
                        if ($request->nombre != '' && $request->fechaInicio != '') {
                            $nombre = $request->nombre;
                            $fechaInicio = $request->fechaInicio;
                            $fechaFin = $request->fechaFin;

                            $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                ->whereHas('persona', function ($query) use ($nombre) {
                                    $query->where('Persona.Nombre', 'like', '%'.$nombre.'%');
                                })
                                ->whereHas('persona.laico', function ($query) use ($fechaInicio, $fechaFin) {
                                    $query->whereBetween('Laico.FechaNacimiento', array($fechaInicio, $fechaFin)); // side note: operator '=' is default, so can be ommited
                                })
                                ->get();

                            return $acta;
                        } else {
                            if ($request->nombre != '') {
                                $nombre = $request->nombre;

                                $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                    ->whereHas('persona', function ($query) use ($nombre) {
                                        $query->where('Persona.Nombre', 'like', '%'.$nombre.'%');
                                    })
                                ->get();

                                return $acta;
                            } else {
                                if ($request->parroquia != '') {
                                    $parroquia = $request->parroquia;

                                    $acta = Acta::with(['persona', 'parroquia', 'persona.laico'])
                                        ->whereHas('parroquia', function ($query) use ($parroquia) {
                                            $query->where('IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                                        })
                                        ->get();

                                    return $acta;
                                } else {
                                    if ($request->fechaInicio != '') {
                                        $fechaInicio = $request->fechaInicio;
                                        $fechaFin = $request->fechaFin;

                                        $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                            ->whereHas('persona.laico', function ($query) use ($fechaInicio, $fechaFin) {
                                                $query->whereBetween('Laico.FechaNacimiento', array($fechaInicio, $fechaFin)); // side note: operator '=' is default, so can be ommited
                                            })
                                            ->get();

                                        return $acta;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return 'funciona';
        }
    }
}
