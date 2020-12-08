<!DOCTYPE html>
<html>

<head>
    <title>Certificado Sacramentos Recibidos
    </title>
    <link rel="stylesheet" href="css/pdf.css" type="text/css"/>
</head>
<body>
<div id="plantilla-sacramentos-header">
    <img src="style/img/plantilla-confirma-header.png" height="100%" width="100%">
</div>

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
            <h2 id="nombrePersona">
                <strong>{{ $acta->persona->Nombre . ' ' . $acta->persona->PrimerApellido . ' ' . $acta->persona->SegundoApellido }}</strong>
            </h2>

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

    <br><br>

    <div class="sacramentosDiv centrar-texto">
        <h2 class="titulo-sacramentos"><strong>HA RECIBIDO CRISTIANA SEPULTURA</strong></h2>
    </div>

    <br><br>

    <div class="row sacramento-info-div">
        <p>El día: <strong>{{ $fecDef }}</strong></p>
        @if($acta->defuncion != null && $acta->defuncion->IDParroquiaDefuncion != null)
            <p>En la Parroquia <strong>{{ $acta->defuncion->parroquia->NombreParroquia }}</strong></p>
        @elseif($acta->defuncion != null)
            <p>En <span class="texto-capitalize"><strong>{{ $acta->defuncion->LugarBautismo }}</strong></span></p>
        @endif
        <p>Causa de muerte: <strong>{{ $acta->defuncion->CausaMuerte }}</strong></p>
    </div>

    <div class="observacionesDiv">
        @if($acta->defuncion != null)
            @if($acta->defuncion->NotasMarginales == null || $acta->defuncion->NotasMarginales == '')
                <p class="izq-texto">Notas
                    Marginales: NO CONSTA</p>
            @else
                <p class="izq-texto">Notas
                    Marginales: {{ $acta->defuncion->NotasMarginales }}</p>
            @endif
        @endif
    </div>

    <div class="registrosDiv centrar-texto">
        Según registros de libros bautismales de {{ $parroquiaRegistraDef }}:
        <table class="tabla-registros">
            <tr>
                <td class="centrar-texto">Libro</td>
                <td><strong>{{ $acta->defuncion->ubicacionActa->Libro }}</strong></td>

                <td class="centrar-texto">Folio</td>
                <td><strong>{{ $acta->defuncion->ubicacionActa->Folio }}</strong></td>

                <td class="centrar-texto">Asiento</td>
                <td><strong>{{ $acta->defuncion->ubicacionActa->Asiento }}</strong></td>
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
                        <p class="no-margin-padding">Pbro. Lic. Sixto Varela Santamaría</p>
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
    <img src="style/img/plantilla-sacramentos-footer.png" height="100%" width="100%">
</div>
</body>
</html>
