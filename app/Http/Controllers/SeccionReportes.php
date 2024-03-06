<?php

namespace App\Http\Controllers;

use App\Acta;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SeccionReportes extends Controller
{

    public function home() {
        $parroquias = \App\Parroquia::all();

        return view('AdminViews.SeccionReportes', ['parroquias'=> $parroquias]);
    }

    public function queryBautizosAnnio(Request $request) {
        $parroquia = $request->parroquia;
        $fechaInicio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaInicio));
        $fechaFin = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaFin));
        $fechaFin->addDay();

        $totalCount = 0;

        if ($request->has('bautismo')) {
            $totalCount += Acta::whereHas('bautismo', function (Builder $query) use ($parroquia, $fechaInicio, $fechaFin) {
                $query->where('actabautismo.IDParroquiaRegistra', $parroquia)
                    ->whereBetween('actabautismo.created_at', [$fechaInicio, $fechaFin]);
            })->count();
        }

        if ($request->has('pcomunion')) {
            $totalCount += Acta::whereHas('primeracomunion', function (Builder $query) use ($parroquia, $fechaInicio, $fechaFin) {
                $query->where('actaprimeracomunion.IDParroquiaRegistra', $parroquia)
                    ->whereBetween('actaprimeracomunion.created_at', [$fechaInicio, $fechaFin]);
            })->count();
        }

        if ($request->has('confirma')) {
            $totalCount += Acta::whereHas('confirma', function (Builder $query) use ($parroquia, $fechaInicio, $fechaFin) {
                $query->where('actaconfirma.IDParroquiaRegistra', $parroquia)
                    ->whereBetween('actaconfirma.created_at', [$fechaInicio, $fechaFin]);
            })->count();
        }

        if ($request->has('matrimonio')) {
            $totalCount += Acta::whereHas('matrimonio', function (Builder $query) use ($parroquia, $fechaInicio, $fechaFin) {
                $query->where('actamatrimonio.IDParroquiaRegistra', $parroquia)
                    ->whereBetween('actamatrimonio.created_at', [$fechaInicio, $fechaFin]);
            })->count();
        }

        if ($request->has('defuncion')) {
            $totalCount += Acta::whereHas('defuncion', function (Builder $query) use ($parroquia, $fechaInicio, $fechaFin) {
                $query->where('actadefuncion.IDParroquiaRegistra', $parroquia)
                    ->whereBetween('actadefuncion.created_at', [$fechaInicio, $fechaFin]);
            })->count();
        }

        return $totalCount;
    }

    function formatDate($dateString)
    {
        $dd = substr($dateString, 0, 2);
        $mm = substr($dateString, 3, 2);
        $yyyy = substr($dateString, 6, 4);
        return $yyyy . '-' . $mm . '-' . $dd . ' 00:00:00';
    }
}
