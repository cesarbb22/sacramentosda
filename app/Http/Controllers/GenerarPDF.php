<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acta;
use Carbon\Carbon;

class GenerarPDF extends Controller
{


    public function generarPDF(Request $request)
    {

        $acta = Acta::with('persona', 'persona.laico', 'bautismo', 'bautismo.parroquia', 'bautismo.ubicacionActa', 'confirma', 'confirma.parroquia', 'matrimonio', 'matrimonio.parroquia')
            ->where('IDActa', $request->idActa)
            ->first();

        $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");

        // fecha nacimiento
        $fechaNac = Carbon::parse($acta->persona->laico->FechaNacimiento);
        $mesNac = $meses[($fechaNac->format('n')) - 1];
        $fecNacFormatted = $fechaNac->format('d') . ' de ' . $mesNac . ' de ' . $fechaNac->format('Y');

        // fecha bautismo
        if ($acta->bautismo != null) {
            $fechaBau = Carbon::parse($acta->bautismo->FechaBautismo);
            $mesBau = $meses[($fechaBau->format('n')) - 1];
            $fecBauFormatted = $fechaBau->format('d') . ' de ' . $mesBau . ' de ' . $fechaBau->format('Y');
        }

        // fecha confirma
        $fecConfFormatted = null;
        if ($acta->confirma != null && $acta->confirma->FechaConfirma != null) {
            $fechaConf = Carbon::parse($acta->confirma->FechaConfirma);
            $mesConf = $meses[($fechaConf->format('n')) - 1];
            $fecConfFormatted = $fechaConf->format('d') . ' de ' . $mesConf . ' de ' . $fechaConf->format('Y');
        }

        // fecha matrimonio
        $fecMatFormatted = null;
        if ($acta->matrimonio != null && $acta->matrimonio->FechaMatrimonio != null) {
            $fechaMat = Carbon::parse($acta->matrimonio->FechaMatrimonio);
            $mesMat = $meses[($fechaMat->format('n')) - 1];
            $fecMatFormatted = $fechaMat->format('d') . ' de ' . $mesMat . ' de ' . $fechaMat->format('Y');
        }

        // fecha hoy
        $fecHoyFormatted = null;
        $fechaHoy = Carbon::now();
        $mesHoy = $meses[($fechaHoy->format('n')) - 1];
        $fecHoyFormatted = $fechaHoy->format('d') - 1 . ' de ' . $mesHoy . ' de ' . $fechaHoy->format('Y');

        $pdf = \PDF::loadView('PDF.PdfCertificado', ['acta' => $acta, 'codigo' => $request->codigo, 'fecNac'=> $fecNacFormatted, 'fecBau'=> $fecBauFormatted
        , 'fecConf'=> $fecConfFormatted, 'fecMat'=> $fecMatFormatted, 'fecHoy'=> $fecHoyFormatted]);

        /*$pdf = \PDF::loadView('PDF.PdfCertificado', ['personaNom' => $request->nombreEdit, 'personaAp1' => $request->apellido1Edit, 'personaAp2' => $request->apellido2Edit, 'personamadre' => $request->nombreMadreEdit,
            'personaPadre' => $request->nombrePadreEdit, 'fechaNacEdit' => $request->fechaNacEdit,
            'nacidolugar' => $request->lugarNacEdit, 'lugarBautizado' => $request->lugarBautizo, 'fechaBau' => $request->fechaBautizo, 'nombreMadrinaB' => $request->nombreMadrinaB, 'nombrePadrinoB' => $request->nombrePadrinoB,
            'numLibroB' => $request->numLibroB, 'numFolioB' => $request->numFolioB, 'numAsientoB' => $request->numAsientoB, 'lugarConfirma' => $request->lugarConfirma, 'fechaConfirma' => $request->fechaConfirma, 'nombrePadrinoC1' => $request->nombrePadrinoC1,
            'nombrePadrinoC2' => $request->nombrePadrinoC2, 'numLibroC' => $request->numLibroC, 'numFolioC' => $request->numFolioC, 'numAsientoC' => $request->numAsientoC,
            'lugarMatrimonio' => $request->lugarMatrimonio, 'fechaMatrimonio' => $request->fechaMatrimonio, 'nombreConyuge' => $request->nombreConyuge, 'numLibroM' => $request->numLibroM,
            'numFolioM' => $request->numFolioM, 'numAsientoM' => $request->numAsientoM,
            'lugarDefuncion' => $request->lugarDefuncion, 'fechaDefuncion' => $request->fechaDefuncion, 'causaDefuncion' => $request->causaDefuncion, 'numLibroD' => $request->numLibroD, 'numFolioD' => $request->numFolioD,
            'numAsientoD' => $request->numAsientoD, 'notasMarginalesEdit' => $request->notasMarginalesEdit, 'numCedulaEdit' => $request->numCedulaEdit, 'tipoHijo' => $request->tipoHijoValue, 'parroquias' => $parroquias
        ]);*/

        return $pdf->download('Certificado.pdf');
    }
}
