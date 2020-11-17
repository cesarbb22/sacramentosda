
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
                    <h2 id="nombrePersona"><strong>{{ $acta->persona->Nombre . ' ' . $acta->persona->PrimerApellido . ' ' . $acta->persona->SegundoApellido }}</strong></h2>

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
                                <span class="spanMargin">en: <strong>{{ $acta->persona->laico->LugarNacimiento }}</strong></span>
                            @endif
                    </div>
                    <div>
                        @if($acta->persona->laico->IDTipo_Hijo == 1)
                            <span>Hijo de: <strong>{{ $acta->persona->laico->NombreMadre }}</strong></span>
                        @else
                            <span>Hijo de: <strong>{{ $acta->persona->laico->NombrePadre . ' y ' . $acta->persona->laico->NombreMadre }}</strong></span>
                        @endif
                    </div>
                    <div>
                        <span class="">Abuelos paternos: {{ $acta->bautismo->AbuelosPaternos }}</span>
                        <span class="spanMargin">Abuelos maternos: {{ $acta->bautismo->AbuelosMaternos }}</span>
                    </div>
                </div>
            </div>


            <div class="sacramentosDiv centrar-texto">
                <h4 class="titulo-sacramentos"><strong>HA RECIBIDO LOS SACRAMENTOS DE:</strong></h4>
                <table class="tabla-sacramentos" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="izq-texto"><strong>Bautismo:</strong></td>
                        <td>el {{ $fecBau }}</td>
                        @if($acta->bautismo->IDParroquiaBautismo != null)
                            <td>en la Parroquia {{ $acta->bautismo->parroquia->NombreParroquia }}</td>
                        @else
                            <td>en {{ $acta->bautismo->LugarBautismo }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">Padrino: {{ $acta->bautismo->PadrinoBau2 }}</td>
                    </tr>
                    <tr class="tr-padding">
                        <td></td>
                        <td colspan="2">Madrina: {{ $acta->bautismo->PadrinoBau1 }}</td>
                    </tr>

                    <tr class="tr-padding">
                        <td class="izq-texto"><strong>Confirmación:</strong></td>
                        @if($acta->confirma->FechaConfirma == null)
                            <td>NO CONSTA FECHA</td>
                        @else
                            <td>el {{ $fecConf }}</td>
                        @endif

                        @if($acta->confirma->IDParroquiaConfirma != null)
                            <td>en la Parroquia {{ $acta->confirma->parroquia->NombreParroquia }}</td>
                        @else
                            <td>en {{ $acta->confirma->LugarConfirma }}</td>
                        @endif
                    </tr>

                    <tr>
                        <td class="izq-texto"><strong>Matrimonio:</strong></td>
                        @if($acta->matrimonio->FechaMatrimonio == null)
                            <td>NO CONSTA FECHA</td>
                        @else
                            <td>el {{ $fecMat }}</td>
                        @endif

                        @if($acta->matrimonio->IDParroquiaMatrimonio != null)
                            <td>en la Parroquia {{ $acta->matrimonio->parroquia->NombreParroquia }}</td>
                        @else
                            <td>en {{ $acta->matrimonio->LugarMatrimonio }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">con {{ $acta->matrimonio->NombreConyugue }}</td>
                    </tr>
                </table>
            </div>

            <div class="observacionesDiv">
                <p class="izq-texto">Notas Marginales: {{ $acta->bautismo->NotasMarginales . ' ' . $acta->confirma->NotasMarginales . ' ' . $acta->matrimonio->NotasMarginales }}</p>
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
                <p>Se extiende la presente solicitud del interesado, dado en la Parroquia <strong>{{ Auth::user()->parroquia->NombreParroquia }}</strong>
                 el {{ $fecHoy }}</p>
            </div>

            <div class="firmaDiv centrar-texto">
                <table class="tabla-firma">
                    <tr>
                        <td>__________________________</td>
                    </tr>
                    <tr class="centrar-texto">
                        <td>Cura párroco o vicario</td>
                    </tr>
                </table>
            </div>
        </div>



        <div id="footer">
            <img src="style/img/plantilla-footer.png" height="100%" width="100%">
        </div>
    </body>
</html>






