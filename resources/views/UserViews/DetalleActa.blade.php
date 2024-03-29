@extends('layouts.masterPage')

@section('content')
    <style type="text/css">


        .btn:focus, .btn-large:focus, .btn-floating:focus {
            background-color: #af771f;
        }

    </style>
    <div id='n' class="row">
        @if(session()->has('msjMalo'))
            <div class="col l2"></div>
            <div class="col s12 m8 l8">
                <div class="card-panel red lighten-2 center-align">
                    <span class="white-text">{{session('msjMalo')}}</span>
                </div>
            </div>
            <div class="col l2"></div><br><br><br><br><br>
        @endif

        @if(session()->has('msjBueno'))
            <div class="col l2"></div>
            <div class="col s12 m8 l8">
                <div class="card-panel green darken-3 center-align">
                    <span class="white-text">{{session('msjBueno')}}</span>
                </div>
            </div>
            <div class="col l2"></div><br><br><br><br><br>
        @endif

        <div class="col s12 m4 l2"></div>

        <form id="detalleForm" method="POST" role='form'>
            {{ csrf_field() }}
            <div class=" col s12 m4 l8 card-panel z-depth-5">

                <div class="row">
                    <div class="col s12 m3 l3"></div>
                    <div class="col s12 m6 l6"><h4 class="center-align">Detalle de Partida</h4></div>
                    <div class="col s12 m3 l3"></div>
                </div>

                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel red">
                                <ul class='white-text'>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="input-field col s4">
                        <input id="numCedulaEdit" name='numCedulaEdit' type="text" value="{{ $persona->Cedula }}"
                               readonly maxlength="9">
                        <label for="numCedulaEdit">Número de cédula:</label>
                    </div>

                    <div class="input-field col s8">
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombreEdit" name='nombreEdit' type="text" value="{{ $persona->Nombre }}"
                               readonly>
                        <label for="nombreEdit">Nombre:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido1Edit" name='apellido1Edit' type="text"
                               value="{{ $persona->PrimerApellido }}" readonly>
                        <label for="apellido1Edit">Primer apellido:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido2Edit" name='apellido2Edit' type="text"
                               value="{{ $persona->SegundoApellido }}" readonly>
                        <label for="apellido2Edit">Segundo apellido:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input name='tipoHijo' type="text" id="tipoH1" value="{{ $tipoHijo }}" readonly/>
                        <input name='tipoHijoValue' type="hidden" id="tipoH" value="{{ $laico->IDTipo_Hijo }}"/>
                        <label for="tipoH1">Tipo hijo:</label>
                    </div>
                    <div class="col s8">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombrePadreEdit" name='nombrePadreEdit' type="text"
                                       value="{{ $laico->NombrePadre }}" readonly>
                                <label for="nombrePadreEdit">Nombre del padre:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombreMadreEdit" name='nombreMadreEdit' type="text"
                                       value="{{ $laico->NombreMadre }} " readonly>
                                <label for="nombreMadreEdit">Nombre de la madre:</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6"></div>
                    <div class="input-field col s6">
                        <label>Fecha de nacimiento:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="lugarNacEdit" name='lugarNacEdit' type="text" value="{{ $laico->LugarNacimiento }}"
                               readonly>
                        <label for="LugarNacEdit">Lugar de nacimiento:</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="fechaNacEdit" name='fechaNacEdit'
                               pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                               class="" type="text" title="Formato de fecha: dd/mm/aaaa"
                               value="{{ $laico->FechaNacimiento }}" readonly>
                    </div>
                </div>

                <div class="row"></div>

                <div class="row">

                    <div class="collapsible-header waves-light waves-effect white-text">Partida de Bautizo</div>

                    @if($actaBautismo != null)

                        <div class="row">
                            <div class="input-field col s6"></div>
                            <div class="input-field col s6">
                                <label>Fecha de Bautizo:</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="lugarBautizo" name="lugarBautizo" type="text"
                                       value="{{ $actaBautismo->LugarBautismo }}" readonly>
                                <label for="lugarBautizo"> Bautizado en:</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="fechaBaut" name="fechaBautizo"
                                       pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                       class="" type="text" title="Formato de fecha: dd/mm/aaaa"
                                       value="{{ $actaBautismo->FechaBautismo }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s8">
                                <input id="nombreAbuelosPaternos" name="nombreAbuelosPaternos" type="text"
                                       value="{{ $actaBautismo->AbuelosPaternos }}" readonly>
                                <label for="nombreAbuelosPaternos">Nombre de abuelos paternos:</label>
                            </div>
                            <div class="input-field col s8">
                                <input id="nombreAbuelosMaternos" name="nombreAbuelosMaternos" type="text"
                                       value="{{ $actaBautismo->AbuelosMaternos }}" readonly>
                                <label for="nombreAbuelosMaternos">Nombre de abuelos maternos:</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s8">
                                <input id="nombreMadrina" name="nombreMadrinaB" type="text"
                                       value="{{ $actaBautismo->PadrinoBau1 }}" readonly>
                                <label for="nombreMadrina">Nombre de la madrina:</label>
                            </div>
                            <div class="input-field col s8">
                                <input id="nombrePadrino" name="nombrePadrinoB" type="text"
                                       value="{{ $actaBautismo->PadrinoBau2 }}" readonly>
                                <label for="nombrePadrino">Nombre del padrino:</label>
                            </div>
                            <div class="input-field col s8">
                                <input id="nombreSacerdoteBau" name="nombreSacerdoteBau" type="text"
                                       value="{{ $actaBautismo->SacerdoteBautiza }}" readonly>
                                <label for="nombreSacerdoteBau">Nombre de sacerdote que bautiza:</label>
                            </div>
                            <div class="input-field col s8">
                                <label for="informacion">Esta información consta en:</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-num col s4">
                                <input id="numLibroB" name="numLibroB" type="number"
                                       value="{{ $UbicacionActaBautismo->Libro }}" readonly>
                                <label for="numLibroB">Número de Libro:</label>
                            </div>
                            <div class="input-num col s4">
                                <input id="numFolioB" name="numFolioB" type="number"
                                       value="{{ $UbicacionActaBautismo->Folio }}" readonly>
                                <label for="numFolioB">Número de Folio:</label>
                            </div>
                            <div class="input-num col s4">
                                <input id="numAsientoB" name="numAsientoB" type="number"
                                       value="{{ $UbicacionActaBautismo->Asiento }}" readonly>
                                <label for="numAsientoB">Número de Asiento:</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="notasMarginalesBauEdit" name='notasMarginalesBauEdit' type="text"
                                       value="{{ $actaBautismo->NotasMarginales }}" readonly>
                                <label for="notasMarginalesBauEdit">Notas Marginales:</label>
                            </div>
                        </div>

                        <div class="div-creado-por">
                            <span class="p-creado-por">Creada por: {{ $nomParroquiaBauRegistra }}</span>
                        </div>
                        <br>
                        <div class="row" style="text-align: left">
                            <button id="Descargar" class="waves-effect waves-light btn left modal-trigger"
                                    data-target="modalPDFDetalleBautismo"><i
                                    class="material-icons left">file_download</i>Constancia de Bautizo
                            </button>
                        </div>
                        <br>
                    @else
                        <div class="row">
                            <div class="input-field col s6">
                                <p>No cuenta con esta partida</p>
                            </div>

                        </div>

                </div>
                @endif

                <div class="collapsible-header waves-light waves-effect white-text">Partida de Primera Comunión</div>
                @if($actaPrimeraComunion != null)
                    <div class="row">
                        <div class="input-field col s6"></div>
                        <div class="input-field col s6">
                            <label>Fecha de Primera Comunión:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="lugarPrimeraComunion" name="lugarPrimeraComunion" type="text"
                                   value="{{ $actaPrimeraComunion -> LugarPrimeraComunion }}" readonly>
                            <label for="lugarPrimeraComunion"> Primera Comunión en:</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaPrimeraComunion" name="fechaPrimeraComunion"
                                   pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                   class="" type="text" title="Formato de fecha: dd/mm/aaaa"
                                   value="{{ $actaPrimeraComunion -> FechaPrimeraComunion }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s8">
                            <label for="informacion">Esta información consta en:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-num col s4">
                            <input id="numLibroPC" name="numLibroPC" type="number"
                                   value="{{ $UbicacionPrimeraComunion->Libro }}" readonly>
                            <label for="numLibroPC">Número de Libro:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numFolioPC" name="numFolioPC" type="number"
                                   value="{{ $UbicacionPrimeraComunion->Folio }}" readonly>
                            <label for="numFolioPC">Número de Folio:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numAsientoPC" name="numAsientoPC" type="number"
                                   value="{{ $UbicacionPrimeraComunion->Asiento }}" readonly>
                            <label for="numAsientoPC">Número de Asiento:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="notasMarginalesPrimeraComunion" name='notasMarginalesPrimeraComunion' type="text"
                                   value="{{ $actaPrimeraComunion->NotasMarginales }}" readonly>
                            <label for="notasMarginalesPrimeraComunion">Notas Marginales:</label>
                        </div>
                    </div>

                    <div class="div-creado-por">
                        <span class="p-creado-por">Creada por: {{ $nomParroquiaPrimeraCRegistra }}</span>
                    </div>
                    <br>
                    <div class="row" style="text-align: left">
                        <button id="Descargar" class="waves-effect waves-light btn left modal-trigger"
                                data-target="modalPDFDetallePrimeraComunion"><i
                                class="material-icons left">file_download</i>Constancia de Primera Comunión
                        </button>
                    </div>
                    @if($actaPrimeraComunion->IDParroquiaRegistra == $parroquiaUser)
                        <div class="row" style="text-align: left">
                            @if($actaBautismo != null && $actaBautismo->IDParroquiaRegistra != $parroquiaUser)
                                @if ($actaPrimeraComunion->AvisoEnviado == 0)
                                    <button id="avisoPrimeraComunion"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="PRIMERA_COMUNION">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoPrimeraComunion"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="PRIMERA_COMUNION"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @elseif ($actaBautismo == null)
                                @if ($actaPrimeraComunion->AvisoEnviado == 0)
                                    <button id="avisoPrimeraComunion"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="PRIMERA_COMUNION">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoPrimeraComunion"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="PRIMERA_COMUNION"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                    <br>
                @else
                    <div class="row">
                        <div class="input-field col s6">
                            <p>No cuenta con esta partida</p>
                        </div>

                    </div>
                @endif

                <div class="collapsible-header waves-light waves-effect white-text">Partida de Confirma</div>

                @if($actaConfirma != null)
                    <div class="row">
                        <div class="input-field col s6"></div>
                        <div class="input-field col s6">
                            <label>Fecha de Confirma:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="lugarConfirma" name="lugarConfirma" type="text"
                                   value="{{ $actaConfirma -> LugarConfirma }}" readonly>
                            <label for="lugarConfirma"> Confirmado en:</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaConfir" name="fechaConfirma"
                                   pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                   class="" type="text" title="Formato de fecha: dd/mm/aaaa"
                                   value="{{ $actaConfirma -> FechaConfirma }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s8">
                            <input id="nombrePadrino1" name="nombrePadrinoC1" type="text"
                                   value="{{ $actaConfirma -> PadrinoCon1 }}" readonly>
                            <label for="nombrePadrino1">Nombre del padrino o madrina:</label>
                        </div>
                        <div class="input-field col s8">
                            <label for="informacion">Esta información consta en:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-num col s4">
                            <input id="numLibroC" name="numLibroC" type="number"
                                   value="{{ $UbicacionActaConfirma->Libro }}" readonly>
                            <label for="numLibroC">Número de Libro:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numFolioC" name="numFolioC" type="number"
                                   value="{{ $UbicacionActaConfirma->Folio }}" readonly>
                            <label for="numFolioC">Número de Folio:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numAsientoC" name="numAsientoC" type="number"
                                   value="{{ $UbicacionActaConfirma->Asiento }}" readonly>
                            <label for="numAsientoC">Número de Asiento:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="notasMarginalesConfEdit" name='notasMarginalesConfEdit' type="text"
                                   value="{{ $actaConfirma->NotasMarginales }}" readonly>
                            <label for="notasMarginalesConfEdit">Notas Marginales:</label>
                        </div>
                    </div>

                    <div class="div-creado-por">
                        <span class="p-creado-por">Creada por: {{ $nomParroquiaConfRegistra }}</span>
                    </div>
                    <br>
                    <div class="row" style="text-align: left">
                        <button id="Descargar" class="waves-effect waves-light btn left modal-trigger"
                                data-target="modalPDFDetalleConfirma"><i
                                class="material-icons left">file_download</i>Constancia de Confirma
                        </button>
                    </div>
                    @if($actaConfirma->IDParroquiaRegistra == $parroquiaUser)
                        <div class="row" style="text-align: left">
                            @if($actaBautismo != null && $actaBautismo->IDParroquiaRegistra != $parroquiaUser)
                                @if ($actaConfirma->AvisoEnviado == 0)
                                    <button id="avisoConfirma" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="CONFIRMA">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoConfirma" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="CONFIRMA"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @elseif ($actaBautismo == null)
                                @if ($actaConfirma->AvisoEnviado == 0)
                                    <button id="avisoConfirma" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="CONFIRMA">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoConfirma" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="CONFIRMA"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                    <br>
                @else
                    <div class="row">
                        <div class="input-field col s6">
                            <p>No cuenta con esta partida</p>
                        </div>

                    </div>

                @endif


                <div class="collapsible-header waves-light waves-effect white-text">Partida de Matrimonio</div>

                @if($actaMatrimonio != null)
                    <div class="row">
                        <div class="input-field col s6"></div>
                        <div class="input-field col s6">
                            <label>Fecha del Matrimonio:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="lugarMatrimonio" name="lugarMatrimonio" type="text"
                                   value="{{ $actaMatrimonio -> LugarMatrimonio }}" readonly>
                            <label for="lugarMatrimonio"> Matrimonio en:</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaMatrimonio" name="fechaMatrimonio"
                                   pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                   class="" type="text" title="Formato de fecha: dd/mm/aaaa"
                                   value="{{ $actaMatrimonio -> FechaMatrimonio }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s8">
                            <input id="nombreConyuge" name="nombreConyuge" type="text"
                                   value="{{ $actaMatrimonio -> NombreConyugue }}" readonly>
                            <label for="nombreConyuge">Nombre del cónyuge:</label>
                        </div>
                        <div class="input-field col s8">
                            <label for="informacion">Esta información consta en:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-num col s4">
                            <input id="numLibroM" name="numLibroM" type="number"
                                   value="{{ $UbicacionActaMatrimonio->Libro }}" readonly>
                            <label for="numLibroM">Número de Libro:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numFolioM" name="numFolioM" type="number"
                                   value="{{ $UbicacionActaMatrimonio->Folio }}" readonly>
                            <label for="numFolioM">Número de Folio:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numAsientoM" name="numAsientoM" type="number"
                                   value="{{ $UbicacionActaMatrimonio->Asiento }}" readonly>
                            <label for="numAsientoM">Número de Asiento:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="notasMarginalesMatEdit" name='notasMarginalesMatEdit' type="text"
                                   value="{{ $actaMatrimonio->NotasMarginales }}" readonly>
                            <label for="notasMarginalesMatEdit">Notas Marginales:</label>
                        </div>
                    </div>

                    <div class="div-creado-por">
                        <span class="p-creado-por">Creada por: {{ $nomParroquiaMatRegistra }}</span>
                    </div>
                    <br>
                    <div class="row" style="text-align: left">
                        <button id="Descargar" class="waves-effect waves-light btn left modal-trigger"
                                data-target="modalPDFDetalleMatrimonio"><i
                                class="material-icons left">file_download</i>Constancia de Matrimonio
                        </button>
                    </div>
                    @if($actaMatrimonio->IDParroquiaRegistra == $parroquiaUser)
                        <div class="row" style="text-align: left">
                            @if($actaBautismo != null && $actaBautismo->IDParroquiaRegistra != $parroquiaUser)
                                @if ($actaMatrimonio->AvisoEnviado == 0)
                                    <button id="avisoMatrimonio" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="MATRIMONIO">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoMatrimonio" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="MATRIMONIO"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @elseif ($actaBautismo == null)
                                @if ($actaMatrimonio->AvisoEnviado == 0)
                                    <button id="avisoMatrimonio" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="MATRIMONIO">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoMatrimonio" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="MATRIMONIO"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                    <br>
                @else
                    <div class="row">
                        <div class="input-field col s6">
                            <p>No cuenta con esta partida</p>
                        </div>

                    </div>

                @endif

                @foreach ($matrimoniosInfo as $info)
                    <hr/><hr/>
                    <div class="row">
                        <div class="input-field col s6"></div>
                        <div class="input-field col s6">
                            <label>Fecha del Matrimonio:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="lugarMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="lugarMatrimonio" type="text"
                                   value="{{ $info['actaMatrimonio']->LugarMatrimonio }}" readonly>
                            <label for="lugarMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"> Matrimonio en:</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="fechaMatrimonio"
                                   class="" type="text"
                                   value="{{ $info['actaMatrimonio']->FechaMatrimonio }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s8">
                            <input id="nombreConyuge_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="nombreConyuge" type="text"
                                   value="{{ $info['actaMatrimonio']->NombreConyugue }}" readonly>
                            <label for="nombreConyuge_{{ $info['actaMatrimonio']->IDMatrimonio }}">Nombre del cónyuge:</label>
                        </div>
                        <div class="input-field col s8">
                            <label for="informacion">Esta información consta en:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-num col s4">
                            <input id="numLibroM_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="numLibroM" type="number"
                                   value="{{ $info['UbicacionActaMatrimonio']->Libro }}" readonly>
                            <label for="numLibroM_{{ $info['actaMatrimonio']->IDMatrimonio }}">Número de Libro:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numFolioM_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="numFolioM" type="number"
                                   value="{{ $info['UbicacionActaMatrimonio']->Folio }}" readonly>
                            <label for="numFolioM_{{ $info['actaMatrimonio']->IDMatrimonio }}">Número de Folio:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numAsientoM_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="numAsientoM" type="number"
                                   value="{{ $info['UbicacionActaMatrimonio']->Asiento }}" readonly>
                            <label for="numAsientoM_{{ $info['actaMatrimonio']->IDMatrimonio }}">Número de Asiento:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="notasMarginalesMatEdit_{{ $info['actaMatrimonio']->IDMatrimonio }}" name='notasMarginalesMatEdit' type="text"
                                   value="{{ $info['actaMatrimonio']->NotasMarginales }}" readonly>
                            <label for="notasMarginalesMatEdit_{{ $info['actaMatrimonio']->IDMatrimonio }}">Notas Marginales:</label>
                        </div>
                    </div>

                    <div class="div-creado-por">
                        <span class="p-creado-por">Creada por: {{ $info['nomParroquiaMatRegistra'] }}</span>
                    </div>
                    <br>
                    <div class="row" style="text-align: left">
                        <button id="Descargar_{{ $info['actaMatrimonio']->IDMatrimonio }}" class="waves-effect waves-light btn left modal-trigger"
                                data-target="modalPDFDetalleMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"><i
                                class="material-icons left">file_download</i>Constancia de Matrimonio
                        </button>
                    </div>

                    @if($info['actaMatrimonio']->IDParroquiaRegistra == $parroquiaUser)
                        <div class="row" style="text-align: left">
                            @if($actaBautismo != null && $actaBautismo->IDParroquiaRegistra != $parroquiaUser)
                                @if ($info['actaMatrimonio']->AvisoEnviado == 0)
                                    <button id="avisoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="MATRIMONIO_ADICIONAL" mat_id="{{ $info['actaMatrimonio']->IDMatrimonio }}">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="MATRIMONIO_ADICIONAL"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @elseif ($actaBautismo == null)
                                @if ($info['actaMatrimonio']->AvisoEnviado == 0)
                                    <button id="avisoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="MATRIMONIO_ADICIONAL" mat_id="{{ $info['actaMatrimonio']->IDMatrimonio }}">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                            class="avisoBtn waves-effect waves-light btn left modal-trigger"
                                            tipo="MATRIMONIO_ADICIONAL"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                    <br>
                @endforeach

                <div class="collapsible-header waves-light waves-effect white-text">Partida de Defunción</div>

                @if($actaDefuncion != null)
                    <div class="row">
                        <div class="input-field col s6"></div>
                        <div class="input-field col s6">
                            <label>Fecha de la defunción:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="lugarDefuncion" name="lugarDefuncion" type="text"
                                   value="{{ $actaDefuncion -> LugarDefuncion }}" readonly>
                            <label for="lugarDefuncion"> Defunción en:</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="fechaDefuncion" name="fechaDefuncion"
                                   pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                   class="" type="text" title="Formato de fecha: dd/mm/aaaa"
                                   value="{{ $actaDefuncion -> FechaDefuncion }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s8">
                            <input id="causaDefuncion" name="causaDefuncion" type="text"
                                   value="{{ $actaDefuncion -> CausaMuerte }}" readonly>
                            <label for="causaDefuncion">Causa de la muerte:</label>
                        </div>
                        <div class="input-field col s8">
                            <label for="informacion">Esta información consta en:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-num col s4">
                            <input id="numLibroD" name="numLibroD" type="number"
                                   value="{{ $UbicacionActaDefuncion->Libro }}" readonly>
                            <label for="numLibroD">Número de Libro:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numFolioD" name="numFolioD" type="number"
                                   value="{{ $UbicacionActaDefuncion->Folio }}" readonly>
                            <label for="numFolioD">Número de Folio:</label>
                        </div>
                        <div class="input-num col s4">
                            <input id="numAsientoD" name="numAsientoD" type="number"
                                   value="{{ $UbicacionActaDefuncion->Asiento }}" readonly>
                            <label for="numAsientoD">Número de Asiento:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="notasMarginalesDefEdit" name='notasMarginalesDefEdit' type="text"
                                   value="{{ $actaDefuncion->NotasMarginales }}" readonly>
                            <label for="notasMarginalesDefEdit">Notas Marginales:</label>
                        </div>
                    </div>

                    <div class="div-creado-por">
                        <span class="p-creado-por">Creada por: {{ $nomParroquiaDefRegistra }}</span>
                    </div>
                    <br>
                    <div class="row" style="text-align: left">
                        <button id="Descargar" class="waves-effect waves-light btn left modal-trigger"
                                data-target="modalPDFDetalleDefuncion"><i
                                class="material-icons left">file_download</i>Constancia de Defunción
                        </button>
                    </div>
                    @if($actaDefuncion->IDParroquiaRegistra == $parroquiaUser)
                        <div class="row" style="text-align: left">
                            @if($actaBautismo != null && $actaBautismo->IDParroquiaRegistra != $parroquiaUser)
                                @if ($actaDefuncion->AvisoEnviado == 0)
                                    <button id="avisoDefuncion" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="DEFUNCION">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoDefuncion" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="DEFUNCION"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @elseif ($actaBautismo == null)
                                @if ($actaDefuncion->AvisoEnviado == 0)
                                    <button id="avisoDefuncion" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="DEFUNCION">
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @else
                                    <button id="avisoDefuncion" class="avisoBtn waves-effect waves-light btn left modal-trigger" tipo="DEFUNCION"
                                            disabled>
                                        <i class="material-icons left">info</i>
                                        Enviar Aviso
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                    <br>
                @else
                    <div class="row">
                        <div class="input-field col s6">
                            <p>No cuenta con esta partida</p>
                        </div>

                    </div>
                @endif


                <div class="row"><br>
                    <hr><br></div>

                <div class="row">
                    <button id="Descargar" class="waves-effect waves-light btn right modal-trigger" data-target="modalPDFDetalle"><i
                            class="material-icons left">file_download</i>Descargar CSR
                    </button>
                </div>
            </div>

            <input type="hidden" name="IDPersona" id="IDPersona" value="{{ $persona->IDPersona }}"/>
        </form>
    </div>
    <div class="col s12 m4 l2"></div>

    <!-- Modal Structure Sacramentos Recibidos -->
    <div id="modalPDFDetalle" class="modal modal-fixed-footer">
        <form id="pdfForm" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <input id="codigo" name="codigo" type="text" required
                               oninvalid="this.setCustomValidity('Campo requerido')"
                               oninput="setCustomValidity('')">
                        <label for="codigo">Código de referencia</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <select name="motivo" id="motivo" required>
                            <option value="0" selected>--</option>
                            <option value="1">Personales</option>
                            <option value="2">Padrino de Bautizo</option>
                            <option value="3">Madrina de Bautizo</option>
                            <option value="4">Padrino de Confirma</option>
                            <option value="5">Madrina de Confirma</option>
                            <option value="6">Sacramento de la Confirmación</option>
                            <option value="7">Matrimonio</option>
                            <option value="8">Segundas Nupcias</option>
                            <option value="9">Nulidad Matrimonial</option>
                            <option value="10">Catequesis Prematrimonial</option>
                        </select>
                        <label>Seleccione el motivo de la constancia:</label>
                    </div>
                </div>
                <div class="row">
                    <p>
                        <input name="incluirNotasMarginales" type="checkbox" id="incluirNotasMarginales"/>
                        <label for="incluirNotasMarginales">¿Desea incluir notas marginales?</label>
                    </p>
                </div>
                <div class="input-field">
                    <input id="idActa" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtn" onclick="closeModal();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtn" type="submit" class="modal-action waves-effect waves-green btn-flat ">
                    Descargar
                </button>
            </div>
            <div id="loadingDiv" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    <!-- Modal Structure Bautismo -->
    <div id="modalPDFDetalleBautismo" class="modal modal-fixed-footer">
        <form id="pdfFormBautismo" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <input id="codigoBautismo" name="codigo" type="text" required
                               oninvalid="this.setCustomValidity('Campo requerido')"
                               oninput="setCustomValidity('')">
                        <label for="codigo">Código de referencia</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <select name="motivo" id="motivoBautismo" required>
                            <option value="0" selected>--</option>
                            <option value="1">Personales</option>
                            <option value="2">Padrino de Bautizo</option>
                            <option value="3">Madrina de Bautizo</option>
                            <option value="4">Ingreso a Catequesis</option>
                            <option value="5">Sacramento de la Confirmación</option>
                        </select>
                        <label>Seleccione el motivo de la constancia:</label>
                    </div>
                </div>
                <div class="input-field">
                    <input id="idActaBautismo" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtnBautismo" onclick="closeModal();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtnBautismo" type="submit" class="modal-action waves-effect waves-green btn-flat ">
                    Descargar
                </button>
            </div>
            <div id="loadingDivBautismo" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    <!-- Modal Structure Primera Comunion -->
    <div id="modalPDFDetallePrimeraComunion" class="modal modal-fixed-footer">
        <form id="pdfFormPrimeraComunion" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <input id="codigoPrimeraComunion" name="codigo" type="text" required
                               oninvalid="this.setCustomValidity('Campo requerido')"
                               oninput="setCustomValidity('')">
                        <label for="codigo">Código de referencia</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <select name="motivo" id="motivoPrimeraComunion" required>
                            <option value="0" selected>--</option>
                            <option value="1">Personales</option>
                        </select>
                        <label>Seleccione el motivo de la constancia:</label>
                    </div>
                </div>
                <div class="input-field">
                    <input id="idActaPrimeraComunion" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtnPrimeraComunion" onclick="closeModal();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtnPrimeraComunion" type="submit"
                        class="modal-action waves-effect waves-green btn-flat ">
                    Descargar
                </button>
            </div>
            <div id="loadingDivPrimeraComunion" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    <!-- Modal Structure Confirma -->
    <div id="modalPDFDetalleConfirma" class="modal modal-fixed-footer">
        <form id="pdfFormConfirma" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <input id="codigoConfirma" name="codigo" type="text" required
                               oninvalid="this.setCustomValidity('Campo requerido')"
                               oninput="setCustomValidity('')">
                        <label for="codigo">Código de referencia</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <select name="motivo" id="motivoConfirma" required>
                            <option value="0" selected>--</option>
                            <option value="1">Personales</option>
                            <option value="2">Padrino de Bautizo</option>
                            <option value="3">Madrina de Bautizo</option>
                            <option value="4">Padrino de Confirma</option>
                            <option value="5">Madrina de Confirma</option>
                        </select>
                        <label>Seleccione el motivo de la constancia:</label>
                    </div>
                </div>
                <div class="input-field">
                    <input id="idActaConfirma" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtnConfirma" onclick="closeModal();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtnConfirma" type="submit" class="modal-action waves-effect waves-green btn-flat ">
                    Descargar
                </button>
            </div>
            <div id="loadingDivConfirma" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    <!-- Modal Structure Matrimonio -->
    <div id="modalPDFDetalleMatrimonio" class="modal modal-fixed-footer">
        <form id="pdfFormMatrimonio" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <input id="codigoMatrimonio" name="codigo" type="text" required
                               oninvalid="this.setCustomValidity('Campo requerido')"
                               oninput="setCustomValidity('')">
                        <label for="codigo">Código de referencia</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <select name="motivo" id="motivoMatrimonio" required>
                            <option value="0" selected>--</option>
                            <option value="1">Personales</option>
                            <option value="2">Registro Civil</option>
                            <option value="3">Nulidad Matrimonial</option>
                            <option value="4">Segundas Nupcias</option>
                        </select>
                        <label>Seleccione el motivo de la constancia:</label>
                    </div>
                </div>
                <div class="input-field">
                    <input id="idActaMatrimonio" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtnMatrimonio" onclick="closeModal();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtnMatrimonio" type="submit" class="modal-action waves-effect waves-green btn-flat ">
                    Descargar
                </button>
            </div>
            <div id="loadingDivMatrimonio" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    @foreach ($matrimoniosInfo as $index => $info)
        <!-- Modal Structure Matrimonio para cada actaMatrimonio -->
        <div id="modalPDFDetalleMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" class="modal modal-fixed-footer">
            <form id="pdfFormMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" method="POST" action="/pdf">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div>
                        <h4>Descargar Constancia</h4>
                    </div>
                    <br>
                    <div class="row">
                        <div class="input-field">
                            <input id="codigoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="codigo" type="text" required
                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                   oninput="setCustomValidity('')">
                            <label for="codigoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}">Código de referencia</label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="input-field">
                            <select name="motivo" id="motivoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" required>
                                <option value="0" selected>--</option>
                                <option value="1">Personales</option>
                                <option value="2">Registro Civil</option>
                                <option value="3">Nulidad Matrimonial</option>
                                <option value="4">Segundas Nupcias</option>
                            </select>
                            <label for="motivoMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}">Seleccione el motivo de la constancia:</label>
                        </div>
                    </div>
                    <div class="input-field">
                        <input id="idActaMatrimonioActa_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                        <input id="idActaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="idActa" value="{{ $info['actaMatrimonio']->IDMatrimonio }}" type="text" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <a onclick="closeModal();" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                    <button type="submit" class="modal-action waves-effect waves-green btn-flat ">Descargar</button>
                </div>
                <div id="loadingDivMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" class="progress">
                    <div class="indeterminate"></div>
                </div>
            </form>
        </div>
    @endforeach

    <!-- Modal Structure Defuncion -->
    <div id="modalPDFDetalleDefuncion" class="modal modal-fixed-footer">
        <form id="pdfFormDefuncion" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <input id="codigoDefuncion" name="codigo" type="text" required
                               oninvalid="this.setCustomValidity('Campo requerido')"
                               oninput="setCustomValidity('')">
                        <label for="codigo">Código de referencia</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field">
                        <select name="motivo" id="motivoDefuncion" required>
                            <option value="0" selected>--</option>
                            <option value="1">Personales</option>
                        </select>
                        <label>Seleccione el motivo de la constancia:</label>
                    </div>
                </div>
                <div class="input-field">
                    <input id="idActaDefuncion" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtnDefuncion" onclick="closeModal();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtnDefuncion" type="submit" class="modal-action waves-effect waves-green btn-flat ">
                    Descargar
                </button>
            </div>
            <div id="loadingDivDefuncion" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    <!-- Modal Structure Aviso -->
    <div id="modalAviso" class="modal modal-fixed-footer">
        <form id="enviarAviso" method="POST" action="/enviarAviso">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Enviar Aviso</h4>
                </div>
                <hr><br><br>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <select id="idParroquiaAvisar" name='idParroquiaAvisar'>
                                <option value="-1">Archivo Diocesano de Alajuela</option>
                                @foreach ($parroquias as $paAviso)
                                    <option
                                        value="{{ $paAviso->IDParroquia }}">{{ $paAviso->NombreParroquia }}</option>
                                @endforeach
                            </select>
                            <label>Seleccione la parroquia que desea notificar:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="idDescripcion" class="materialize-textarea" data-length="500" name="descripcion"></textarea>
                            <label for="idDescripcion">Ingrese información adicional (en caso de ser necesario)</label>
                        </div>
                    </div>
                    <input id="sacramento" name="sacramento" value="" type="text" hidden>
                    <input id="idActaAvisar" name="idActaAvisar" value="" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtnAviso" onclick="closeModalAviso();"
                   class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalEnviarAvisoBtn" type="submit" class="modal-action waves-effect waves-green btn-flat ">
                    Enviar Aviso
                </button>
            </div>
        </form>
    </div>

    <script>
        function closeModal() {
            $('.modal').modal('close');
            $('#codigo').val('');
            $('#codigoBautismo').val('');
            $('#codigoPrimeraComunion').val('');
            $('#codigoConfirma').val('');
            $('#codigoMatrimonio').val('');
            $('#codigoDefuncion').val('');
        }

        function closeModalAviso() {
            $('.modal').modal('close');
            location.reload();
        }

        window.onload = function () {
            $('#loadingDiv').hide();
            $('#loadingDivBautismo').hide();
            $('#loadingDivPrimeraComunion').hide();
            $('#loadingDivConfirma').hide();
            $('#loadingDivMatrimonio').hide();
            $('[id^="loadingDivMatrimonio_"]').hide();
            $('#loadingDivDefuncion').hide();

            $('#detalleForm').on('submit', function (e) {
                e.preventDefault();
            });

            // funcion Enviar Avisos
            $('.avisoBtn').on('click', function (e) {
                e.preventDefault();

                var actaBautismo = {!! json_encode($actaBautismo) !!};
                if (actaBautismo == null) {
                    $('#sacramento').val(e.currentTarget.attributes.getNamedItem("tipo").value);
                    $('#idActaAvisar').val($('#idActa').val());
                    $('#modalAviso').modal('open');
                } else {
                    var answer = confirm("¿Seguro que desea enviar el aviso?");
                    if (answer) {
                        var sacramento = e.currentTarget.attributes.getNamedItem("tipo").value;
                        var formData = new FormData();
                        formData.append("idActaAvisar", $('#idActa').val());
                        formData.append("idParroquiaAvisar", actaBautismo.IDParroquiaRegistra);
                        formData.append("sacramento", sacramento);
                        formData.append("_token", "{{ csrf_token() }}");

                        if (sacramento === "MATRIMONIO_ADICIONAL") {
                            console.log("MATRIMONIO_ADICIONAL: " + e.currentTarget.attributes.getNamedItem("mat_id").value);
                            formData.append("matrimonioId", e.currentTarget.attributes.getNamedItem("mat_id").value);
                        }

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '/enviarAviso');
                        xhr.responseType = 'arraybuffer';
                        xhr.onload = function (e) {
                            if (this.status == 200) {
                                location.reload();
                            }
                        }
                        xhr.send(formData);
                    }
                }
            });

            // PDF Sacramentos Recibidos
            $('#pdfForm').on('submit', function (e) {
                e.preventDefault();

                if ($('#motivo').val() == '0') {
                    return;
                }

                $('#modalCancelBtn').attr('disabled', true);
                $('#modalDescargarBtn').attr('disabled', true);
                $('#loadingDiv').show();

                var formData = new FormData();
                formData.append("codigo", $('#codigo').val());
                formData.append("motivo", $('#motivo').val());
                formData.append("incluirNotasMarginales", $('#incluirNotasMarginales').prop('checked'));
                formData.append("idActa", $('#idActa').val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdf');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigo').val() + ".pdf";
                        link.click();

                        $('#modalCancelBtn').attr('disabled', false);
                        $('#modalDescargarBtn').attr('disabled', false);
                        $('#loadingDiv').hide();
                        $('#codigo').val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            // PDF Bautismo
            $('#pdfFormBautismo').on('submit', function (e) {
                e.preventDefault();

                if ($('#motivoBautismo').val() == '0') {
                    return;
                }

                $('#modalCancelBtnBautismo').attr('disabled', true);
                $('#modalDescargarBtnBautismo').attr('disabled', true);
                $('#loadingDivBautismo').show();

                var formData = new FormData();
                formData.append("codigo", $('#codigoBautismo').val());
                formData.append("motivo", $('#motivoBautismo').val());
                formData.append("idActa", $('#idActaBautismo').val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdfBautismo');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigoBautismo').val() + ".pdf";
                        link.click();

                        $('#modalCancelBtnBautismo').attr('disabled', false);
                        $('#modalDescargarBtnBautismo').attr('disabled', false);
                        $('#loadingDivBautismo').hide();
                        $('#codigoBautismo').val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            // PDF Primera Comunion
            $('#pdfFormPrimeraComunion').on('submit', function (e) {
                e.preventDefault();

                if ($('#motivoPrimeraComunion').val() == '0') {
                    return;
                }

                $('#modalCancelBtnPrimeraComunion').attr('disabled', true);
                $('#modalDescargarBtnPrimeraComunion').attr('disabled', true);
                $('#loadingDivPrimeraComunion').show();

                var formData = new FormData();
                formData.append("codigo", $('#codigoPrimeraComunion').val());
                formData.append("motivo", $('#motivoPrimeraComunion').val());
                formData.append("idActa", $('#idActaPrimeraComunion').val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdfPrimeraComunion');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigoPrimeraComunion').val() + ".pdf";
                        link.click();

                        $('#modalCancelBtnPrimeraComunion').attr('disabled', false);
                        $('#modalDescargarBtnPrimeraComunion').attr('disabled', false);
                        $('#loadingDivPrimeraComunion').hide();
                        $('#codigoPrimeraComunion').val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            // PDF Confirma
            $('#pdfFormConfirma').on('submit', function (e) {
                e.preventDefault();

                if ($('#motivoConfirma').val() == '0') {
                    return;
                }

                $('#modalCancelBtnConfirma').attr('disabled', true);
                $('#modalDescargarBtnConfirma').attr('disabled', true);
                $('#loadingDivConfirma').show();

                var formData = new FormData();
                formData.append("codigo", $('#codigoConfirma').val());
                formData.append("motivo", $('#motivoConfirma').val());
                formData.append("idActa", $('#idActaConfirma').val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdfConfirma');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigoConfirma').val() + ".pdf";
                        link.click();

                        $('#modalCancelBtnConfirma').attr('disabled', false);
                        $('#modalDescargarBtnConfirma').attr('disabled', false);
                        $('#loadingDivConfirma').hide();
                        $('#codigoConfirma').val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            // PDF Matrimonio
            $('#pdfFormMatrimonio').on('submit', function (e) {
                e.preventDefault();

                if ($('#motivoMatrimonio').val() == '0') {
                    return;
                }

                $('#modalCancelBtnMatrimonio').attr('disabled', true);
                $('#modalDescargarBtnMatrimonio').attr('disabled', true);
                $('#loadingDivMatrimonio').show();

                var formData = new FormData();
                formData.append("codigo", $('#codigoMatrimonio').val());
                formData.append("motivo", $('#motivoMatrimonio').val());
                formData.append("idActa", $('#idActaMatrimonio').val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdfMatrimonio');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigoMatrimonio').val() + ".pdf";
                        link.click();

                        $('#modalCancelBtnMatrimonio').attr('disabled', false);
                        $('#modalDescargarBtnMatrimonio').attr('disabled', false);
                        $('#loadingDivMatrimonio').hide();
                        $('#codigoMatrimonio').val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            $('[id^="pdfFormMatrimonio_"]').on('submit', function (e) {
                e.preventDefault();

                var formId = $(this).attr('id');
                var matrimonioId = formId.split('_')[1];

                if ($('#motivoMatrimonio_' + matrimonioId).val() == '0') {
                    return;
                }

                $('#modalCancelBtnMatrimonio_' + matrimonioId).attr('disabled', true);
                $('#modalDescargarBtnMatrimonio_' + matrimonioId).attr('disabled', true);
                $('#loadingDivMatrimonio_' + matrimonioId).show();

                var formData = new FormData();
                formData.append("codigo", $('#codigoMatrimonio_' + matrimonioId).val());
                formData.append("motivo", $('#motivoMatrimonio_' + matrimonioId).val());
                formData.append("idActa", $('#idActaMatrimonioActa_' + matrimonioId).val());
                formData.append("idMatrimonio", $('#idActaMatrimonio_' + matrimonioId).val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdfMatrimonioAdicional');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigoMatrimonio_' + matrimonioId).val() + ".pdf";
                        link.click();

                        $('#modalCancelBtnMatrimonio_' + matrimonioId).attr('disabled', false);
                        $('#modalDescargarBtnMatrimonio_' + matrimonioId).attr('disabled', false);
                        $('#loadingDivMatrimonio_' + matrimonioId).hide();
                        $('#codigoMatrimonio_' + matrimonioId).val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            // PDF Defuncion
            $('#pdfFormDefuncion').on('submit', function (e) {
                e.preventDefault();

                if ($('#motivoDefuncion').val() == '0') {
                    return;
                }

                $('#modalCancelBtnDefuncion').attr('disabled', true);
                $('#modalDescargarBtnDefuncion').attr('disabled', true);
                $('#loadingDivDefuncion').show();

                var formData = new FormData();
                formData.append("codigo", $('#codigoDefuncion').val());
                formData.append("motivo", $('#motivoDefuncion').val());
                formData.append("idActa", $('#idActaDefuncion').val());
                formData.append("_token", "{{ csrf_token() }}");

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/pdfDefuncion');
                xhr.responseType = 'arraybuffer';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {type: "application/pdf"});
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = $('#codigoDefuncion').val() + ".pdf";
                        link.click();

                        $('#modalCancelBtnDefuncion').attr('disabled', false);
                        $('#modalDescargarBtnDefuncion').attr('disabled', false);
                        $('#loadingDivDefuncion').hide();
                        $('#codigoDefuncion').val('');
                        $('.modal').modal('close');
                    }
                };
                xhr.send(formData);
            });

            $(document).ready(function () {
                $('.modal').modal({
                    dismissible: false
                });

                $('#parroquia > option[value="{{ $acta->IDParroquia }}"]').attr('selected', 'selected');
                $("input[name=tipoHijo][value= {{ $laico->IDTipo_Hijo }} ]").prop('checked', true);
            });

            $("#tipoH2").change(function () {
                if ($("#tipoH2").is(':checked')) {
                    $("#nombrePadreEdit").prop('disabled', false);
                    $("#nombreMadreEdit").prop('disabled', false);
                }
            });

            $("#tipoH1").change(function () {
                if ($("#tipoH1").is(':checked')) {
                    $("#nombrePadreEdit").prop('disabled', true);
                    $("#nombreMadreEdit").prop('disabled', false);
                }
            });

            $("#checkBautismo").change(function () {
                if ($("#checkBautismo").is(':checked')) {
                    $("#contentBautismo").css("display", "block");
                } else {
                    $("#contentBautismo").css("display", "none");
                }
            });

            $("#checkPrimeraComunion").change(function () {
                if ($("#checkPrimeraComunion").is(':checked')) {
                    $("#contentPrimeraComunion").css("display", "block");
                } else {
                    $("#contentPrimeraComunion").css("display", "none");
                }
            });

            $("#checkConfirma").change(function () {
                if ($("#checkConfirma").is(':checked')) {
                    $("#contentConfirma").css("display", "block");
                } else {
                    $("#contentConfirma").css("display", "none");
                }
            });

            $("#checkMatrimonio").change(function () {
                if ($("#checkMatrimonio").is(':checked')) {
                    $("#contentMatrimonio").css("display", "block");
                } else {
                    $("#contentMatrimonio").css("display", "none");
                }
            });

            $("#checkDefuncion").change(function () {
                if ($("#checkDefuncion").is(':checked')) {
                    $("#contentDefuncion").css("display", "block");
                } else {
                    $("#contentDefuncion").css("display", "none");
                }
            });

            $('select').material_select();

        }

    </script>

@endsection
