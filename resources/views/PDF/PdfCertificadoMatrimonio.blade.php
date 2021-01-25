<!DOCTYPE html>
<html>

<head>
    <title>Certificado Sacramentos Recibidos
    </title>
    <link rel="stylesheet" href="css/pdf.css" type="text/css"/>
</head>
<body>
<div id="plantilla-sacramentos-header">
    <img src="style/img/plantilla-matrimonio-header.png" height="100%" width="100%">
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
            <h2 id="titulo no-margin-padding">LA DIÓCESIS DE ALAJUELA</h2>
            <h3 id="titulo no-margin-padding">HACE CONSTAR QUE:</h3>
        </div>
        <br><br>
        <div>
            <h3 class="no-margin-padding">
                @if($acta->persona->Cedula == null)
                    <span class="upperCase">{{ $acta->persona->Nombre . ' ' . $acta->persona->PrimerApellido . ' ' . $acta->persona->SegundoApellido }}</span>
                    <span class="strong">Ced. NO CONSTA</span>
                @else
                    <span class="upperCase">{{ $acta->persona->Nombre . ' ' . $acta->persona->PrimerApellido . ' ' . $acta->persona->SegundoApellido }}</span>
                    <span class="strong">Ced. {{ $acta->persona->Cedula }}</span>
                @endif
            </h3>
            <h3 class="no-margin-padding">
                <span class="strong">y</span> <span class="upperCase">{{ $acta->matrimonio->NombreConyugue }}</span>
            </h3>
        </div>
    </div>

    <br><br><br>

    <div class="sacramentosDiv centrar-texto">
        <h2 class="titulo-sacramentos"><strong>CONTRAJERON MATRIMONIO</strong></h2>
    </div>

    <br><br><br>

    <div class="row sacramento-info-div">
        <p>El día: <strong>{{ $fecMat }}</strong></p>
        @if($acta->matrimonio != null && $acta->matrimonio->IDParroquiaMatrimonio != null)
            <p>En la Parroquia <strong>{{ $acta->matrimonio->parroquia->NombreParroquia }}</strong></p>
        @elseif($acta->matrimonio != null)
            <p>En <span class="texto-capitalize"><strong>{{ $acta->matrimonio->LugarBautismo }}</strong></span></p>
        @endif
    </div>

    <br>

    <div class="observacionesDiv">
        @if($acta->matrimonio != null)
            @if($acta->matrimonio->NotasMarginales == null || $acta->matrimonio->NotasMarginales == '')
                <p class="izq-texto">Notas
                    Marginales: NO CONSTA</p>
            @else
                <p class="izq-texto">Notas
                    Marginales: {{ $acta->matrimonio->NotasMarginales }}</p>
            @endif
        @endif
    </div>

    <div class="registrosDiv centrar-texto">
        Según registros de libros matrimoniales {{ $parroquiaRegistraMat }}:
        <table class="tabla-registros">
            <tr>
                <td class="centrar-texto">Libro</td>
                <td><strong>{{ $acta->matrimonio->ubicacionActa->Libro }}</strong></td>

                <td class="centrar-texto">Folio</td>
                <td><strong>{{ $acta->matrimonio->ubicacionActa->Folio }}</strong></td>

                <td class="centrar-texto">Asiento</td>
                <td><strong>{{ $acta->matrimonio->ubicacionActa->Asiento }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="extiendeDiv centrar-texto">
        @if(Auth::user()->IDPuesto == 1 || Auth::user()->IDPuesto == 2)
            @if($motivo == 'personales')
                <p>Se extiende la presente solicitud para efectos <strong>{{ $motivo }}</strong>, dado en la <strong>Curia
                        Diocesana de
                        Alajuela</strong>
                    el {{ $fecHoy }}</p>
            @else
                <p>Se extiende la presente solicitud para efectos de <strong>{{ $motivo }}</strong>, dado en la <strong>Curia
                        Diocesana de
                        Alajuela</strong>
                    el {{ $fecHoy }}</p>
            @endif
        @else
            @if($motivo == 'personales')
                <p>Se extiende la presente solicitud para efectos <strong>{{ $motivo }}</strong>, dado en la Parroquia
                    <strong>{{ Auth::user()->parroquia->NombreParroquia }}</strong>
                    el {{ $fecHoy }}</p>
            @else
                <p>Se extiende la presente solicitud para efectos de <strong>{{ $motivo }}</strong>, dado en la
                    Parroquia
                    <strong>{{ Auth::user()->parroquia->NombreParroquia }}</strong>
                    el {{ $fecHoy }}</p>
            @endif
        @endif
    </div>

    @if(Auth::user()->IDPuesto == 1 || Auth::user()->IDPuesto == 2)
        <div class="firmaDivSubida centrar-texto">
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
        <div class="firmaDivSubida centrar-texto">
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






