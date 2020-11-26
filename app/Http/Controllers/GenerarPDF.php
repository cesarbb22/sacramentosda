<?php

namespace App\Http\Controllers;

use App\Parroquia;
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

        $parroquiaRegistraBau = 'Curia Diocesana de Alajuela';
        if($acta->bautismo->IDParroquiaRegistra != -1) {
            $parroquia = Parroquia::where('IDParroquia', $acta->bautismo->IDParroquiaRegistra)->first();
            $parroquiaRegistraBau = 'parroquia ' . $parroquia->NombreParroquia;
        }

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
        $fecHoyFormatted = $fechaHoy->format('d') . ' de ' . $mesHoy . ' de ' . $fechaHoy->format('Y');

        $pdf = \PDF::loadView('PDF.PdfCertificado', ['acta' => $acta, 'codigo' => $request->codigo, 'fecNac'=> $fecNacFormatted, 'fecBau'=> $fecBauFormatted
        , 'parroquiaRegistraBau'=>$parroquiaRegistraBau, 'fecConf'=> $fecConfFormatted, 'fecMat'=> $fecMatFormatted, 'fecHoy'=> $fecHoyFormatted]);

        return $pdf->download('Certificado.pdf');
    }
}
