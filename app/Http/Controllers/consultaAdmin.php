<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Acta;
use App\Parroquia;
use Carbon\Carbon;

class consultaAdmin extends Controller
{
    public function home()
    {
        // Solo lo que necesita la vista (combo de parroquias)
        $parroquias = Parroquia::select('IDParroquia','NombreParroquia')
            ->orderBy('NombreParroquia')
            ->get();

        // NO cargar personas ni actas; la tabla se llena por AJAX.
        return view('AdminViews.ConsultaActaAdmin', compact('parroquias'));
    }

    public function query(Request $request)
    {
        $perPage = min(max((int) $request->input('per_page', 11), 5), 100);

        $actas = Acta::query()->with([
            // Limitar columnas en relaciones (incluye llaves foráneas)
            'persona' => function ($q) {
                $q->select('IDPersona','Cedula','Nombre','PrimerApellido','SegundoApellido');
            },
            'persona.laico' => function ($q) {
                $q->select('IDPersona','FechaNacimiento');
            },
            'bautismo' => function ($q) {
                $q->select('IDActa','IDParroquiaBautismo','FechaBautismo','LugarBautismo');
            },
            'bautismo.parroquia' => function ($q) {
                $q->select('IDParroquia','NombreParroquia');
            },
        ]);

        // Buscar por cédula
        if ($request->boolean('buscCed') && $request->filled('numCed')) {
            $ced = '%'.trim($request->numCed).'%';
            $actas->whereHas('persona', function (Builder $q) use ($ced) {
                $q->where('persona.Cedula', 'like', $ced);
            });
        }

        // Buscar por nombre (con binding para evitar inyección)
        if ($request->filled('nombre')) {
            $nombre = trim($request->nombre);
            $actas->whereHas('persona', function (Builder $q) use ($nombre) {
                $q->whereRaw(
                    'concat(persona.Nombre," ",persona.PrimerApellido," ",persona.SegundoApellido) like ?',
                    ["%{$nombre}%"]
                );
            });
        }

        // Filtro por parroquia / lugar
        if ($request->filled('parroquia')) {
            if ($request->parroquia !== 'otro') {
                $parr = $request->parroquia;
                $actas->whereHas('bautismo', function (Builder $q) use ($parr) {
                    $q->where('actabautismo.IDParroquiaBautismo', $parr);
                });
            } elseif ($request->filled('lugar')) {
                $lugar = '%'.trim($request->lugar).'%';
                $actas->whereHas('bautismo', function (Builder $q) use ($lugar) {
                    $q->where('actabautismo.LugarBautismo', 'like', $lugar);
                });
            }
        }

        // Rango de fechas (d/m/Y -> Y-m-d)
        if ($request->filled('fechaInicio')) {
            $fi = Carbon::createFromFormat('d/m/Y', $request->fechaInicio)->format('Y-m-d');
            $ff = $request->filled('fechaFin')
                ? Carbon::createFromFormat('d/m/Y', $request->fechaFin)->format('Y-m-d')
                : Carbon::now()->format('Y-m-d');

            $actas->whereHas('persona.laico', function (Builder $q) use ($fi, $ff) {
                $q->whereBetween('laico.FechaNacimiento', [$fi, $ff]);
            });
        }

        return $actas->orderByDesc('IDActa')->paginate($perPage);
    }
}