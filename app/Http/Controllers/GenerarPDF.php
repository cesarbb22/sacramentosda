<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use sistemaCuriaDiocesana\Parroquia;
use sistemaCuriaDiocesana\Persona;
use sistemaCuriaDiocesana\Acta;

class GenerarPDF extends Controller
{


    public function generarPDF(Request $request)
    {
        $parroquias = \sistemaCuriaDiocesana\Parroquia::all();

        $pdf = \PDF::loadView('PDF.PdfCertificado', ['personaNom' => $request->nombreEdit, 'personaAp1' => $request->apellido1Edit, 'personaAp2' => $request->apellido2Edit, 'personamadre' => $request->nombreMadreEdit,
            'personaPadre' => $request->nombrePadreEdit, 'fechaNacEdit' => $request->fechaNacEdit,
            'nacidolugar' => $request->lugarNacEdit, 'lugarBautizado' => $request->lugarBautizo, 'fechaBau' => $request->fechaBautizo, 'nombreMadrinaB' => $request->nombreMadrinaB, 'nombrePadrinoB' => $request->nombrePadrinoB,
            'numLibroB' => $request->numLibroB, 'numFolioB' => $request->numFolioB, 'numAsientoB' => $request->numAsientoB, 'lugarConfirma' => $request->lugarConfirma, 'fechaConfirma' => $request->fechaConfirma, 'nombrePadrinoC1' => $request->nombrePadrinoC1,
            'nombrePadrinoC2' => $request->nombrePadrinoC2, 'numLibroC' => $request->numLibroC, 'numFolioC' => $request->numFolioC, 'numAsientoC' => $request->numAsientoC,
            'lugarMatrimonio' => $request->lugarMatrimonio, 'fechaMatrimonio' => $request->fechaMatrimonio, 'nombreConyuge' => $request->nombreConyuge, 'numLibroM' => $request->numLibroM,
            'numFolioM' => $request->numFolioM, 'numAsientoM' => $request->numAsientoM,
            'lugarDefuncion' => $request->lugarDefuncion, 'fechaDefuncion' => $request->fechaDefuncion, 'causaDefuncion' => $request->causaDefuncion, 'numLibroD' => $request->numLibroD, 'numFolioD' => $request->numFolioD,
            'numAsientoD' => $request->numAsientoD, 'notasMarginalesEdit' => $request->notasMarginalesEdit, 'numCedulaEdit' => $request->numCedulaEdit, 'tipoHijo' => $request->tipoHijoValue, 'parroquias' => $parroquias
        ]);

        return $pdf->download('Certificado.pdf');
    }
}
