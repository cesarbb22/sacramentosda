<?php

namespace App\Http\Controllers;

use App\Acta;
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
        $count = Acta::with(['persona', 'persona.laico', 'bautismo', 'bautismo.parroquia'])
            ->whereHas('bautismo', function (Builder $query) use ($parroquia) {
                $query->where('actabautismo.IDParroquiaBautismo', $parroquia);
            })
            ->count();

        return $count;
    }
}
