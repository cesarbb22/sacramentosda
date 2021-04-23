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
        $fechaInicioBautizo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->annio, '01', '01'));
        $fechaFinBautizo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->annio, '12', '31'));
        $count = Acta::with(['persona', 'persona.laico', 'bautismo', 'bautismo.parroquia'])
            ->whereHas('bautismo', function (Builder $query) use ($parroquia, $fechaInicioBautizo, $fechaFinBautizo) {
                $query->where('actabautismo.IDParroquiaBautismo', $parroquia)
                ->whereBetween('actabautismo.FechaBautismo', [$fechaInicioBautizo, $fechaFinBautizo]);
            })
            ->count();

        return $count;
    }

    function formatDate($yearString, $mm, $dd)
    {
        return $yearString . '-' . $mm . '-' . $dd . ' 00:00:00';
    }
}
