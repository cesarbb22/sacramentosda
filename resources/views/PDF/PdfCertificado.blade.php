
<!DOCTYPE html>
<html>

    <head>
        <title>Certificado Sacramentos Recibidos <title>
            <link rel="stylesheet" href="css/pdf.css" type="text/css" />
    </head>
    <body>
        <div id="watermark">
            <img src="style/img/logo-100.png" height="100%" width="100%">
        </div>


        <div class="container">
            <div id="codigoDiv">
                {{ $codigo }}
            </div>

            <div id="encabezadoDiv" class="centrar-texto">
                <div id="tituloDiv">
                    <h2 id="titulo">LA DIÓCESIS DE ALAJUELA, HACE CONSTAR QUE:</h2>
                </div>
                <div>
                    <h2 id="nombrePersona"><span class="texto-capitalize"><strong>{{ $acta->persona->Nombre . ' ' . $acta->persona->PrimerApellido . ' ' . $acta->persona->SegundoApellido }}</strong></span></h2>

                    <div>
                        @if($acta->persona->Cedula == null)
                            <span class="">Ced. NO CONSTA</span>
                        @else
                            <span class="">Ced. {{ $acta->persona->Cedula }}</span>
                        @endif
                        <span class="spanMargin">Nació el: <strong>{{ $fecNac }}</strong></span>
                            @if($acta->persona->laico->LugarNacimiento == null)
                                <span class="spanMargin">en: <strong>NO CONSTA</strong></span>
                            @else
                                <span class="spanMargin">en: <span class="texto-capitalize"><strong>{{ $acta->persona->laico->LugarNacimiento }}</strong></span></span>
                            @endif
                    </div>
                    <div>
                        @if($acta->persona->laico->IDTipo_Hijo == 1)
                            <span>Hijo de: <span class="texto-capitalize"><strong>{{ $acta->persona->laico->NombreMadre }}</strong></span></span>
                        @else
                            <span>Hijo de: <span class="texto-capitalize"><strong>{{ $acta->persona->laico->NombrePadre . ' y ' . $acta->persona->laico->NombreMadre }}</strong></span></span>
                        @endif
                    </div>
                    <div>
                        <span class="">Abuelos paternos: <span class="texto-capitalize">{{ $acta->bautismo->AbuelosPaternos }}</span></span>
                        <span class="spanMargin">Abuelos maternos: <span class="texto-capitalize">{{ $acta->bautismo->AbuelosMaternos }}</span></span>
                    </div>
                </div>
            </div>


            <div class="sacramentosDiv centrar-texto">
                <h4 class="titulo-sacramentos"><strong>HA RECIBIDO LOS SACRAMENTOS DE:</strong></h4>
                <table class="tabla-sacramentos" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="izq-texto"><strong>Bautismo:</strong></td>
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
                            <td colspan="2">Padrino: <span class="texto-capitalize">{{ $acta->bautismo->PadrinoBau2 }}</span></td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                    <tr class="tr-padding">
                        <td></td>
                        @if($acta->bautismo != null)
                            <td colspan="2">Madrina: <span class="texto-capitalize">{{ $acta->bautismo->PadrinoBau1 }}</span></td>
                        @else
                            <td></td>
                        @endif
                    </tr>

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

                    @if($acta->matrimonio != null)
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
                            <td colspan="2">con <span class="texto-capitalize">{{ $acta->matrimonio->NombreConyugue }}</span></td>
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
                @if($acta->confirma != null && $acta->matrimonio == null)
                    <p class="izq-texto">Notas Marginales: {{ $acta->bautismo->NotasMarginales . ' ' . $acta->confirma->NotasMarginales }}</p>
                @elseif($acta->confirma == null && $acta->matrimonio != null)
                    <p class="izq-texto">Notas Marginales: {{ $acta->bautismo->NotasMarginales . ' ' . $acta->matrimonio->NotasMarginales }}</p>
                @elseif($acta->confirma == null && $acta->matrimonio == null)
                    <p class="izq-texto">Notas Marginales: {{ $acta->bautismo->NotasMarginales }}</p>
                @elseif($acta->confirma != null && $acta->matrimonio != null)
                    <p class="izq-texto">Notas Marginales: {{ $acta->bautismo->NotasMarginales . ' ' . $acta->confirma->NotasMarginales . ' ' . $acta->matrimonio->NotasMarginales }}</p>
                @endif
            </div>

            <div class="registrosDiv centrar-texto">
                <table class="tabla-registros">
                    <tr>
                        <td colspan="6">Según registros de libros bautismales de esta parroquia:</td>
                    </tr>
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
                    <p>Se extiende la presente solicitud del interesado, dado en la <strong>Curia Diocesana de Alajuela</strong>
                        el {{ $fecHoy }}</p>
                @else
                    <p>Se extiende la presente solicitud del interesado, dado en la Parroquia <strong>{{ Auth::user()->parroquia->NombreParroquia }}</strong>
                        el {{ $fecHoy }}</p>
                @endif
            </div>

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
        </div>



        <div id="footer">
            <img src="style/img/plantilla-footer.png" height="100%" width="100%">
        </div>
    </body>
</html>






