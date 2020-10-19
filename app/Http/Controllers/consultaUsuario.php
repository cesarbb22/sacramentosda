<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use App\Acta;

class consultaUsuario extends Controller
{

    public function home() {
        $parroquias = \App\Parroquia::all();
        $personas = \App\Persona::All();

        return view('UserViews.ConsultaActa', ['parroquias'=> $parroquias, 'personas'=> $personas]);
    }


    public function query(Request $request) {
        if ($request->has('buscCed')) {

            $cedula = $request->numCed;

                $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                    ->whereHas('persona', function (Builder $query) use ($cedula) {
                        $query->where('Persona.Cedula', 'like', '%'.$cedula.'%');
                    })
                    ->get();

                return $acta;
        } else {
            if ($request->nombre != '' && $request->parroquia != '' && $request->fechaInicio != '') {
                $nombre = $request->nombre;
                $parroquia = $request->parroquia;
                $fechaInicio = date('Y-m-d', strtotime($request->fechaInicio));
                $fechaFin = $request->fechaFin;
                if ($fechaFin == '') {
                    $fechaFin = date('Y-m-d');
                } else {
                    $fechaFin = date('Y-m-d', strtotime($request->fechaFin));
                }

                $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                    ->whereHas('persona', function (Builder $query) use ($nombre) {
                        $query->whereRaw('concat(Persona.Nombre," ",Persona.PrimerApellido," ",Persona.SegundoApellido) like "%'.$nombre.'%"');
                    })
                    ->whereHas('parroquia', function (Builder $query) use ($parroquia) {
                        $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                    })
                    ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                        $query->whereBetween('Laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                    })
                    ->get();

                return $acta;
            } else {
                if ($request->nombre != '' && $request->parroquia != '') {
                    $nombre = $request->nombre;
                    $parroquia = $request->parroquia;

                    $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                        ->whereHas('persona', function (Builder $query) use ($nombre) {
                            $query->whereRaw('concat(Persona.Nombre," ",Persona.PrimerApellido," ",Persona.SegundoApellido) like "%'.$nombre.'%"');
                        })
                        ->whereHas('parroquia', function (Builder $query) use ($parroquia) {
                            $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                        })
                        ->get();

                    return $acta;
                } else {
                    if ($request->parroquia != '' && $request->fechaInicio != '') {
                        $parroquia = $request->parroquia;
                        $fechaInicio = date('Y-m-d', strtotime($request->fechaInicio));
                        $fechaFin = $request->fechaFin;
                        if ($fechaFin == '') {
                            $fechaFin = date('Y-m-d');
                        } else {
                            $fechaFin = date('Y-m-d', strtotime($request->fechaFin));
                        }

                        $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                            ->whereHas('parroquia', function (Builder $query) use ($parroquia) {
                                $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                            })
                            ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                $query->whereBetween('Laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                            })
                            ->get();

                        return $acta;
                    } else {
                        if ($request->nombre != '' && $request->fechaInicio != '') {
                            $nombre = $request->nombre;
                            $fechaInicio = date('Y-m-d', strtotime($request->fechaInicio));
                            $fechaFin = $request->fechaFin;
                            if ($fechaFin == '') {
                                $fechaFin = date('Y-m-d');
                            } else {
                                $fechaFin = date('Y-m-d', strtotime($request->fechaFin));
                            }

                            $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                ->whereHas('persona', function (Builder $query) use ($nombre) {
                                    $query->whereRaw('concat(Persona.Nombre," ",Persona.PrimerApellido," ",Persona.SegundoApellido) like "%'.$nombre.'%"');
                                })
                                ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                    $query->whereBetween('Laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                                })
                                ->get();

                            return $acta;
                        } else {
                            if ($request->nombre != '') {
                                $nombre = $request->nombre;

                                $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                    ->whereHas('persona', function (Builder $query) use ($nombre) {
                                        $query->whereRaw('concat(Persona.Nombre," ",Persona.PrimerApellido," ",Persona.SegundoApellido) like "%'.$nombre.'%"');
                                    })
                                ->get();

                                return $acta;
                            } else {
                                if ($request->parroquia != '') {
                                    $parroquia = $request->parroquia;

                                    $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                        ->whereHas('parroquia', function (Builder $query) use ($parroquia) {
                                            $query->where('Parroquia.IDParroquia', $parroquia); // side note: operator '=' is default, so can be ommited
                                        })
                                        ->get();

                                    return $acta;
                                } else {
                                    if ($request->fechaInicio != '') {
                                        $fechaInicio = date('Y-m-d', strtotime($request->fechaInicio));
                                        $fechaFin = $request->fechaFin;
                                        if ($fechaFin == '') {
                                            $fechaFin = date('Y-m-d');
                                        } else {
                                            $fechaFin = date('Y-m-d', strtotime($request->fechaFin));
                                        }

                                        $acta = Acta::with('persona', 'parroquia', 'persona.laico')
                                            ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                                $query->whereBetween('Laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
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
        }
    }
}
