<!DOCTYPE html>
<html>

<head>
    <title>Certificado Sacramentos Recibidos
    </title>
    <link rel="stylesheet" href="css/pdf.css" type="text/css"/>
</head>
<body>
<div id="plantilla-header">
    <img src="style/img/plantilla-header1.png" height="100%" width="100%">
</div>


<div class="container">
    <div id="codigoDiv">
        {{ $codigo }}
    </div>

    <div id="encabezadoDiv" class="centrar-texto">
        <div id="tituloDiv">
            <h2 id="titulo no-margin-padding">LA DIÓCESIS DE ALAJUELA</h2>
            <h3 id="titulo no-margin-padding">HACE CONSTAR QUE:</h3>
        </div>
        <div>
            <h2 id="nombrePersona">
                <strong>{{ $acta->persona->Nombre . ' ' . $acta->persona->PrimerApellido . ' ' . $acta->persona->SegundoApellido }}</strong>
            </h2>

            <div>
                <span class="spanMargin">Nació el: <strong>{{ $fecNac }}</strong></span>
                @if($acta->persona->laico->LugarNacimiento == null)
                    <span class="spanMargin">en: <strong>NO CONSTA</strong></span>
                @else
                    <span class="spanMargin">en: <span
                            class="texto-capitalize"><strong>{{ $acta->persona->laico->LugarNacimiento }}</strong></span></span>
                @endif
            </div>
            <div>
                @if($acta->persona->laico->IDTipo_Hijo == 1)
                    <span>Hijo de: <span
                            class="texto-capitalize"><strong>{{ $acta->persona->laico->NombreMadre }}</strong></span></span>
                @else
                    <span>Hijo de: <span
                            class="texto-capitalize"><strong>{{ $acta->persona->laico->NombrePadre }}</strong></span>  y  <span
                            class="texto-capitalize"><strong>{{ $acta->persona->laico->NombreMadre }}</strong></span></span>
                @endif
            </div>
        </div>
    </div>


    <div class="sacramentosDiv centrar-texto">
        <h4 class="titulo-sacramentos"><strong>HA RECIBIDO LOS SACRAMENTOS DE:</strong></h4>
        <table class="tabla-sacramentos" cellspacing="0" cellpadding="0">
            <tr>
                <td class="izq-texto"><strong>Bautizo:</strong></td>
                <td>el {{ $fecBau }}</td>
                @if($acta->bautismo != null && $acta->bautismo->IDParroquiaBautismo != null)
                    <td>en la Parroquia {{ $acta->bautismo->parroquia->NombreParroquia }}</td>
                @elseif($acta->bautismo != null)
                    <td>en <span class="texto-capitalize">{{ $acta->bautismo->LugarBautismo }}</span></td>
                @endif
            </tr>
            <tr>
                <td></td>
                @if($acta->bautismo != null)
                    <td colspan="2">Padrino: <span class="texto-capitalize">{{ $acta->bautismo->PadrinoBau2 }}</span>
                    </td>
                @else
                    <td></td>
                @endif
            </tr>
            <tr class="tr-padding">
                <td></td>
                @if($acta->bautismo != null)
                    <td colspan="2">Madrina: <span class="texto-capitalize">{{ $acta->bautismo->PadrinoBau1 }}</span>
                    </td>
                @else
                    <td></td>
                @endif
            </tr>

            @if($acta->primeraComunion != null)
                <tr class="mat-altura">
                    <td class="izq-texto"><strong>Primera Comunión:</strong></td>
                    @if($acta->primeracomunion->FechaPrimeraComunion == null)
                        <td>NO CONSTA FECHA</td>
                    @else
                        <td>el {{ $fecPrimeraC }}</td>
                    @endif

                    @if($acta->primeracomunion->IDParroquiaPrimeraComunion != null)
                        <td>en la Parroquia {{ $acta->primeracomunion->parroquia->NombreParroquia }}</td>
                    @elseif($acta->primeracomunion != null)
                        <td>en <span class="texto-capitalize">{{ $acta->primeracomunion->LugarPrimeraComunion }}</span></td>
                    @endif
                </tr>
            @else
                <tr>
                    <td class="izq-texto"><strong>Primera Comunión:</strong></td>
                    <td>NO CONSTA</td>
                </tr>
            @endif

            @if($acta->confirma != null)
                <tr class="tr-padding">
                    <td class="izq-texto"><strong>Confirmación:</strong></td>
                    @if($acta->confirma->FechaConfirma == null)
                        <td>NO CONSTA FECHA</td>
                    @else
                        <td>el {{ $fecConf }}</td>
                    @endif

                    @if($acta->confirma->IDParroquiaConfirma != null)
                        <td>en la Parroquia {{ $acta->confirma->parroquia->NombreParroquia }}</td>
                    @elseif($acta->confirma != null)
                        <td>en <span class="texto-capitalize">{{ $acta->confirma->LugarConfirma }}</span></td>
                    @endif
                </tr>
            @else
                <tr class="tr-padding">
                    <td class="izq-texto"><strong>Confirmación:</strong></td>
                    <td>NO CONSTA</td>
                </tr>
            @endif

            @if($actaMatrimonioReciente != null)
                <tr class="mat-altura">
                    <td class="izq-texto"><strong>Matrimonio:</strong></td>
                    @if($actaMatrimonioReciente->FechaMatrimonio == null)
                        <td>NO CONSTA FECHA</td>
                    @else
                        <td>el {{ $fecMat }}</td>
                    @endif

                    @if($actaMatrimonioReciente->IDParroquiaMatrimonio != null)
                        <td>en la Parroquia {{ $actaMatrimonioReciente->parroquia->NombreParroquia }}</td>
                    @elseif($actaMatrimonioReciente != null)
                        <td>en <span class="texto-capitalize">{{ $actaMatrimonioReciente->LugarMatrimonio }}</span></td>
                    @endif
                </tr>
                <tr class="mat-altura">
                    <td></td>
                    <td colspan="2">con <span class="texto-capitalize">{{ $actaMatrimonioReciente->NombreConyugue }}</span>
                        {{ $cantidadMatrimonios }}
                    </td>
                </tr>
            @elseif($acta->matrimonio != null)
                <tr class="mat-altura">
                    <td class="izq-texto"><strong>Matrimonio:</strong></td>
                    @if($acta->matrimonio->FechaMatrimonio == null)
                        <td>NO CONSTA FECHA</td>
                    @else
                        <td>el {{ $fecMat }}</td>
                    @endif

                    @if($acta->matrimonio->IDParroquiaMatrimonio != null)
                        <td>en la Parroquia {{ $acta->matrimonio->parroquia->NombreParroquia }}</td>
                    @elseif($acta->matrimonio != null)
                        <td>en <span class="texto-capitalize">{{ $acta->matrimonio->LugarMatrimonio }}</span></td>
                    @endif
                </tr>
                <tr class="mat-altura">
                    <td></td>
                    <td colspan="2">con <span class="texto-capitalize">{{ $acta->matrimonio->NombreConyugue }}</span>
                    </td>
                </tr>
            @else
                <tr>
                    <td class="izq-texto"><strong>Matrimonio:</strong></td>
                    <td>NO CONSTA</td>
                </tr>
                <tr>
                </tr>
            @endif
        </table>
    </div>

    <div class="observacionesDiv">
        @if($acta->bautismo != null)
            @if($acta->bautismo->NotasMarginales == null || $acta->bautismo->NotasMarginales == '')
                <p class="izq-texto">Notas
                    Marginales: NO CONSTA</p>
            @else
                <p class="izq-texto">Notas
                    Marginales: {{ $acta->bautismo->NotasMarginales }}</p>
            @endif
        @endif
    </div>

    <div class="registrosDiv centrar-texto">
        Según registros de libros bautismales de {{ $parroquiaRegistraBau }}:
        <table class="tabla-registros">
            <tr>
                <td class="centrar-texto">Libro</td>
                <td><strong>{{ $acta->bautismo->ubicacionActa->Libro }}</strong></td>

                <td class="centrar-texto">Folio</td>
                <td><strong>{{ $acta->bautismo->ubicacionActa->Folio }}</strong></td>

                <td class="centrar-texto">Asiento</td>
                <td><strong>{{ $acta->bautismo->ubicacionActa->Asiento }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="extiendeDiv centrar-texto">
        @if(Auth::user()->IDPuesto == 1 || Auth::user()->IDPuesto == 2)
            @if($motivo == 'personales')
                <p>Se extiende la presente solicitud para efectos <strong>{{ $motivo }}</strong>, dado en la <strong>Curia Diocesana de
                        Alajuela</strong>
                    el {{ $fecHoy }}</p>
            @else
                <p>Se extiende la presente solicitud para efectos de <strong>{{ $motivo }}</strong>, dado en la <strong>Curia Diocesana de
                        Alajuela</strong>
                    el {{ $fecHoy }}</p>
            @endif
        @else
            @if($motivo == 'personales')
                <p>Se extiende la presente solicitud para efectos <strong>{{ $motivo }}</strong>, dado en la Parroquia
                    <strong>{{ Auth::user()->parroquia->NombreParroquia }}</strong>
                    el {{ $fecHoy }}</p>
            @else
                <p>Se extiende la presente solicitud para efectos de <strong>{{ $motivo }}</strong>, dado en la Parroquia
                    <strong>{{ Auth::user()->parroquia->NombreParroquia }}</strong>
                    el {{ $fecHoy }}</p>
            @endif
        @endif
    </div>

    @if(Auth::user()->IDPuesto == 1 || Auth::user()->IDPuesto == 2)
        <div class="firmaDiv centrar-texto">
            <table class="tabla-firma">
                <tr>
                    <td>________________________________</td>
                </tr>
                <tr class="centrar-texto">
                    <td>
                        <p class="no-margin-padding">Pbro. Luis Fernando Rodríguez Rodríguez</p>
                        <p class="no-margin-padding">Canciller</p>
                    </td>
                </tr>
            </table>
        </div>
    @else
        <div class="firmaDiv centrar-texto">
            <table class="tabla-firma">
                <tr>
                    <td>__________________________</td>
                </tr>
                <tr class="centrar-texto">
                    <td>Cura Párroco o Vicario Parroquial</td>
                </tr>
            </table>
        </div>
    @endif
</div>


<div id="footer">
    <img src="style/img/plantilla-footer1.png" height="100%" width="100%">
</div>
</body>
</html>
