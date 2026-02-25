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
        $acta = Acta::paginate(0);

        return view('UserViews.ConsultaActa', ['parroquias'=> $parroquias, 'personas'=> $personas, 'acta'=> $acta]);
    }


    public function query(Request $request) {
        // Search by cedula (separate path with early return)
        if ($request->has('buscCed')) {
            return Acta::with('persona', 'persona.laico', 'bautismo', 'bautismo.parroquia')
                ->whereHas('persona', function (Builder $query) use ($request) {
                    $query->where('persona.Cedula', 'like', '%'.$request->numCed.'%');
                })
                ->paginate(11);
        }

        // Build query conditionally based on provided filters
        $acta = Acta::with('persona', 'persona.laico', 'bautismo', 'bautismo.parroquia');

        // Filter by nombre
        if ($request->filled('nombre')) {
            $nombre = $request->nombre;
            $acta->whereHas('persona', function (Builder $query) use ($nombre) {
                $query->where(function ($q) use ($nombre) {
                    $q->whereRaw(
                        'concat(persona.Nombre, " ", persona.PrimerApellido, " ", persona.SegundoApellido) like ?',
                        ['%'.$nombre.'%']
                    );
                });
            });
        }

        // Filter by parroquia or lugar
        if ($request->filled('parroquia')) {
            if ($request->parroquia !== 'otro') {
                $parroquia = $request->parroquia;
                $acta->whereHas('bautismo', function (Builder $query) use ($parroquia) {
                    $query->where('actabautismo.IDParroquiaBautismo', $parroquia);
                });
            } else {
                $lugar = $request->lugar;
                $acta->whereHas('bautismo', function (Builder $query) use ($lugar) {
                    $query->where('actabautismo.LugarBautismo', 'like', '%'.$lugar.'%');
                });
            }
        }

        // Filter by fecha de nacimiento range
        if ($request->filled('fechaInicio')) {
            $fechaInicio = \DateTime::createFromFormat('d/m/Y', $request->fechaInicio)->format('Y-m-d');
            $fechaFin = $request->filled('fechaFin')
                ? \DateTime::createFromFormat('d/m/Y', $request->fechaFin)->format('Y-m-d')
                : date('Y-m-d');

            $acta->whereHas('persona.laico', function (Builder $query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('laico.FechaNacimiento', [$fechaInicio, $fechaFin]);
            });
        }

        return $acta->paginate(11);
    }
}
