<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Acta;

class consultaAdmin extends Controller
{

    public function home() {
        $parroquias = \App\Parroquia::all();
        $personas = \App\Persona::All();

        return view('AdminViews.ConsultaActaAdmin', ['parroquias'=> $parroquias, 'personas'=> $personas]);
    }

    public function query(Request $request) {
        if ($request->has('buscCed')) {

            $cedula = $request->numCed;

                $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                    ->whereHas('persona', function (Builder $query) use ($cedula) {
                        $query->where('persona.Cedula', 'like', '%'.$cedula.'%');
                    })
                    ->get();

                return $acta;
        } else {
            if ($request->nombre != '' && $request->parroquia != '' && $request->fechaInicio != '') {
                $nombre = $request->nombre;
                $fechaInicio = date('Y-m-d', strtotime($request->fechaInicio));
                $fechaFin = $request->fechaFin;
                if ($fechaFin == '') {
                    $fechaFin = date('Y-m-d');
                } else {
                    $fechaFin = date('Y-m-d', strtotime($request->fechaFin));
                }

                if ($request->parroquia != 'otro') {
                    $parroquia = $request->parroquia;
                    $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                        ->whereHas('persona', function (Builder $query) use ($nombre) {
                            $query->whereRaw('concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like "%'.$nombre.'%"');
                        })
                        ->whereHas('bautismo', function (Builder $query) use ($parroquia) {
                            $query->where('actaBautismo.IDParroquiaBautismo', $parroquia); // side note: operator '=' is default, so can be ommited
                        })
                        ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                            $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                        })
                        ->get();
                } else {
                    $lugar = $request->lugar;
                    $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                        ->whereHas('persona', function (Builder $query) use ($nombre) {
                            $query->whereRaw('concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like "%'.$nombre.'%"');
                        })
                        ->whereHas('bautismo', function (Builder $query) use ($lugar) {
                            $query->where('actaBautismo.LugarBautismo', 'like', '%'.$lugar.'%');
                        })
                        ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                            $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                        })
                        ->get();
                }

                return $acta;
            } else {
                if ($request->nombre != '' && $request->parroquia != '') {
                    $nombre = $request->nombre;

                    if ($request->parroquia != 'otro') {
                        $parroquia = $request->parroquia;
                        $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                            ->whereHas('persona', function (Builder $query) use ($nombre) {
                                $query->whereRaw('concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like "%'.$nombre.'%"');
                            })
                            ->whereHas('bautismo', function (Builder $query) use ($parroquia) {
                                $query->where('actaBautismo.IDParroquiaBautismo', $parroquia); // side note: operator '=' is default, so can be ommited
                            })
                            ->get();
                    } else {
                        $lugar = $request->lugar;
                        $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                            ->whereHas('persona', function (Builder $query) use ($nombre) {
                                $query->whereRaw('concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like "%'.$nombre.'%"');
                            })
                            ->whereHas('bautismo', function (Builder $query) use ($lugar) {
                                $query->where('actaBautismo.LugarBautismo', 'like', '%'.$lugar.'%');
                            })
                            ->get();
                    }

                    return $acta;
                } else {
                    if ($request->parroquia != '' && $request->fechaInicio != '') {
                        $fechaInicio = date('Y-m-d', strtotime($request->fechaInicio));
                        $fechaFin = $request->fechaFin;
                        if ($fechaFin == '') {
                            $fechaFin = date('Y-m-d');
                        } else {
                            $fechaFin = date('Y-m-d', strtotime($request->fechaFin));
                        }

                        if ($request->parroquia != 'otro') {
                            $parroquia = $request->parroquia;
                            $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                                ->whereHas('bautismo', function (Builder $query) use ($parroquia) {
                                    $query->where('actaBautismo.IDParroquiaBautismo', $parroquia); // side note: operator '=' is default, so can be ommited
                                })
                                ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                    $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                                })
                                ->get();
                        } else {
                            $lugar = $request->lugar;
                            $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                                ->whereHas('bautismo', function (Builder $query) use ($lugar) {
                                    $query->where('actaBautismo.LugarBautismo', 'like', '%'.$lugar.'%');
                                })
                                ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                    $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                                })
                                ->get();
                        }

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

                            $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                                ->whereHas('persona', function (Builder $query) use ($nombre) {
                                    $query->whereRaw('concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like "%'.$nombre.'%"');
                                })
                                ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                    $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
                                })
                                ->get();

                            return $acta;
                        } else {
                            if ($request->nombre != '') {
                                $nombre = $request->nombre;

                                $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                                    ->whereHas('persona', function (Builder $query) use ($nombre) {
                                        $query->whereRaw('concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like "%'.$nombre.'%"');
                                    })
                                ->get();

                                return $acta;
                            } else {
                                if ($request->parroquia != '') {
                                    if ($request->parroquia != 'otro') {
                                        $parroquia = $request->parroquia;
                                        $acta = Acta::with(['persona', 'bautismo', 'persona.laico'])
                                            ->whereHas('bautismo', function (Builder $query) use ($parroquia) {
                                                $query->where('actaBautismo.IDParroquiaBautismo', $parroquia);
                                            })
                                            ->get();
                                    } else {
                                        $lugar = $request->lugar;
                                        $acta = Acta::with(['persona', 'bautismo', 'persona.laico'])
                                            ->whereHas('bautismo', function (Builder $query) use ($lugar) {
                                                $query->where('actaBautismo.LugarBautismo', 'like', '%'.$lugar.'%');
                                            })
                                            ->get();
                                    }

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

                                        $acta = Acta::with('persona', 'bautismo', 'persona.laico')
                                            ->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                                                $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]); // side note: operator '=' is default, so can be ommited
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
