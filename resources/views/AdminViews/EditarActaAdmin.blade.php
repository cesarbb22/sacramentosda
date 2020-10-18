@extends('layouts.masterPageAdmin')

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
        <div class=" col s12 m4 l8 card-panel z-depth-5">

            <div class="row">
                <div class="col s12 m4 l4"></div>
                <div class="col s12 m4 l4"><h4 class="center-align">Editar Partida</h4></div>
                <div class="col s12 m4 l4"></div>
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



            <form method="POST" action="/actualizarActa" autocomplete="off">

                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s4">
                        <input id="numCedulaEdit" name='numCedulaEdit' type="text" class="validate"
                               value="{{ $persona->Cedula }}" maxlength="9">
                        <label for="numCedulaEdit">Número de cédula:</label>
                    </div>

                    <div class="input-field col s8">
                        <select name='parroquia' id="parroquia">
                            @foreach ($parroquias as $pa)
                                <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                            @endforeach
                        </select>
                        <label>Parroquia:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombreEdit" name='nombreEdit' type="text" class="validate"
                               value="{{ $persona->Nombre }}">
                        <label for="nombreEdit">Nombre:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido1Edit" name='apellido1Edit' type="text" class="validate"
                               value="{{ $persona->PrimerApellido }}">
                        <label for="apellido1Edit">Primer apellido:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido2Edit" name='apellido2Edit' type="text" class="validate"
                               value="{{ $persona->SegundoApellido }}">
                        <label for="apellido2Edit">Segundo apellido:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH1" value="1"/>
                            <label for="tipoH1">Hijo Natural</label>
                        </p>
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH2" value="2"/>
                            <label for="tipoH2">Hijo Legítimo</label>
                        </p>
                    </div>
                    <div class="col s8">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombrePadreEdit" name='nombrePadreEdit' type="text" class="validate"
                                       value="{{ $laico->NombrePadre }}">
                                <label for="nombrePadreEdit">Nombre completo del padre:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombreMadreEdit" name='nombreMadreEdit' type="text" class="validate"
                                       value="{{ $laico->NombreMadre }} ">
                                <label for="nombreMadreEdit">Nombre completo de la madre:</label>
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
                        <input id="lugarNacEdit" name='lugarNacEdit' type="text" class="validate"
                               value="{{ $laico->LugarNacimiento }}">
                        <label for="LugarNacEdit">Lugar de nacimiento:</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="fechaNacEdit" name='fechaNacEdit'
                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                               oninput="setCustomValidity('')">
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="notasMarginalesEdit" name='notasMarginalesEdit' type="text" class="validate"
                               value="{{ $acta->NotasMarginales }}">
                        <label for="notasMarginalesEdit">Notas Marginales:</label>
                    </div>
                </div>

                <div class="row"></div>

                <div class="row">

                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Bautismo</div>
                            <div class="collapsible-body">
                                @if($actaBautismo != null)

                                    <div class="row">
                                        <div class="input-field col s6"></div>
                                        <div class="input-field col s6">
                                            <label>Fecha de Bautismo:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="lugarBautizo" name="lugarBautizo" type="text" class="validate"
                                                   value="{{ $actaBautismo->LugarBautismo }}">
                                            <label for="lugarBautizo"> Bautizado en:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaBaut" name='fechaBautizo'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombreMadrina" name="nombreMadrinaB" type="text" class="validate"
                                                   value="{{ $actaBautismo->PadrinoBau1 }}">
                                            <label for="nombreMadrina">Nombre completo de la madrina:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <input id="nombrePadrino" name="nombrePadrinoB" type="text" class="validate"
                                                   value="{{ $actaBautismo->PadrinoBau2 }}">
                                            <label for="nombrePadrino">Nombre completo del padrino:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <label for="informacion">Esta Información consta en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-num col s4">
                                            <input id="numLibroB" name="numLibroB" type="number" class="validate"
                                                   value="{{ $UbicacionActaBautismo->Libro }}">
                                            <label for="numLibroB">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioB" name="numFolioB" type="number" class="validate"
                                                   value="{{ $UbicacionActaBautismo->Folio }}">
                                            <label for="numFolioB">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoB" name="numAsientoB" type="number" class="validate"
                                                   value="{{ $UbicacionActaBautismo->Asiento }}">
                                            <label for="numAsientoB">Número de Asiento:</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkBautismo"/>
                                            <label for="checkBautismo">Agregar Bautismo</label>
                                        </div>
                                    </div>

                                    <div id="contentBautismo" style="display: none;">
                                        <div class="row">
                                            <div class="input-field col s6"></div>
                                            <div class="input-field col s6">
                                                <label>Fecha de Bautismo:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="lugarBautizo" name="lugarBautizo" type="text"
                                                       class="validate">
                                                <label for="lugarBautizo"> Bautizado en:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaBaut" name='fechaBautizo'
                                                       class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombreMadrina" name="nombreMadrinaB" type="text"
                                                       class="validate">
                                                <label for="nombreMadrina">Nombre completo de la madrina:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <input id="nombrePadrino" name="nombrePadrinoB" type="text"
                                                       class="validate">
                                                <label for="nombrePadrino">Nombre completo del padrino:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <label for="informacion">Esta Información consta en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-num col s4">
                                                <input id="numLibroB" name="numLibroB" type="number" class="validate">
                                                <label for="numLibroB">Número de Libro:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numFolioB" name="numFolioB" type="number" class="validate">
                                                <label for="numFolioB">Número de Folio:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numAsientoB" name="numAsientoB" type="number"
                                                       class="validate">
                                                <label for="numAsientoB">Número de Asiento:</label>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Confirma</div>
                            <div class="collapsible-body">
                                @if($actaConfirma != null)
                                    <div class="row">
                                        <div class="input-field col s6"></div>
                                        <div class="input-field col s6">
                                            <label>Fecha de Confirma:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="lugarConfirma" name="lugarConfirma" type="text" class="validate"
                                                   value="{{ $actaConfirma -> LugarConfirma }}">
                                            <label for="lugarConfirma"> Confirmado en:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaConfir" name='fechaConfirma'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombrePadrino1" name="nombrePadrinoC1" type="text"
                                                   class="validate" value="{{ $actaConfirma -> PadrinoCon1 }}">
                                            <label for="nombrePadrino1">Nombre completo del padrino o madrina:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <input id="nombrePadrino2" name="nombrePadrinoC2" type="text"
                                                   class="validate" value="{{ $actaConfirma -> PadrinoCon2 }}">
                                            <label for="nombrePadrino2">Nombre completo del padrino o madrina:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <label for="informacion">Esta Información consta en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-num col s4">
                                            <input id="numLibroC" name="numLibroC" type="number" class="validate"
                                                   value="{{ $UbicacionActaConfirma->Libro }}">
                                            <label for="numLibroC">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioC" name="numFolioC" type="number" class="validate"
                                                   value="{{ $UbicacionActaConfirma->Folio }}">
                                            <label for="numFolioC">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoC" name="numAsientoC" type="number" class="validate"
                                                   value="{{ $UbicacionActaConfirma->Asiento }}">
                                            <label for="numAsientoC">Número de Asiento:</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkConfirma"/>
                                            <label for="checkConfirma">Agregar Confirma</label>
                                        </div>
                                    </div>

                                    <div id="contentConfirma" style="display: none;">
                                        <div class="row">
                                            <div class="input-field col s6"></div>
                                            <div class="input-field col s6">
                                                <label>Fecha de Confirma:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="lugarConfirma" name="lugarConfirma" type="text"
                                                       class="validate">
                                                <label for="lugarConfirma"> Confirmado en:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaConfir" name='fechaConfirma'
                                                       class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombrePadrino1" name="nombrePadrinoC1" type="text"
                                                       class="validate">
                                                <label for="nombrePadrino1">Nombre completo del padrino o
                                                    madrina:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <input id="nombrePadrino2" name="nombrePadrinoC2" type="text"
                                                       class="validate">
                                                <label for="nombrePadrino2">Nombre completo del padrino o
                                                    madrina:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <label for="informacion">Esta Información consta en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-num col s4">
                                                <input id="numLibroC" name="numLibroC" type="number" class="validate">
                                                <label for="numLibroC">Número de Libro:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numFolioC" name="numFolioC" type="number" class="validate">
                                                <label for="numFolioC">Número de Folio:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numAsientoC" name="numAsientoC" type="number"
                                                       class="validate">
                                                <label for="numAsientoC">Número de Asiento:</label>
                                            </div>
                                        </div>
                                    </div>
                            @endif

                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Matrimonio</div>
                            <div class="collapsible-body">
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
                                                   class="validate" value="{{ $actaMatrimonio -> LugarMatrimonio }}">
                                            <label for="lugarMatrimonio"> Matrimonio en:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaMatrimonio" name='fechaMatrimonio'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombreConyuge" name="nombreConyuge" type="text" class="validate"
                                                   value="{{ $actaMatrimonio -> NombreConyugue }}">
                                            <label for="nombreConyuge">Nombre completo del cónyuge:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <label for="informacion">Esta Información consta en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-num col s4">
                                            <input id="numLibroM" name="numLibroM" type="number" class="validate"
                                                   value="{{ $UbicacionActaMatrimonio->Libro }}">
                                            <label for="numLibroM">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioM" name="numFolioM" type="number" class="validate"
                                                   value="{{ $UbicacionActaMatrimonio->Folio }}">
                                            <label for="numFolioM">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoM" name="numAsientoM" type="number" class="validate"
                                                   value="{{ $UbicacionActaMatrimonio->Asiento }}">
                                            <label for="numAsientoM">Número de Asiento:</label>
                                        </div>
                                    </div>

                                @else
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkMatrimonio"/>
                                            <label for="checkMatrimonio">Agregar Matrimonio</label>
                                        </div>
                                    </div>

                                    <div id="contentMatrimonio" style="display: none;">
                                        <div class="row">
                                            <div class="input-field col s6"></div>
                                            <div class="input-field col s6">
                                                <label>Fecha del Matrimonio:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="lugarMatrimonio" name="lugarMatrimonio" type="text"
                                                       class="validate">
                                                <label for="lugarMatrimonio"> Matrimonio en:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaMatrimonio" name='fechaMatrimonio'
                                                       class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombreConyuge" name="nombreConyuge" type="text"
                                                       class="validate">
                                                <label for="nombreConyuge">Nombre completo del cónyuge:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <label for="informacion">Esta Información consta en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-num col s4">
                                                <input id="numLibroM" name="numLibroM" type="number" class="validate">
                                                <label for="numLibroM">Número de Libro:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numFolioM" name="numFolioM" type="number" class="validate">
                                                <label for="numFolioM">Número de Folio:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numAsientoM" name="numAsientoM" type="number"
                                                       class="validate">
                                                <label for="numAsientoM">Número de Asiento:</label>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Defunción</div>
                            <div class="collapsible-body">
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
                                                   class="validate" value="{{ $actaDefuncion -> LugarDefuncion }}">
                                            <label for="lugarDefuncion"> Defunción en:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaDefuncion" name='fechaDefuncion'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="causaDefuncion" name="causaDefuncion" type="text"
                                                   class="validate" value="{{ $actaDefuncion -> CausaMuerte }}">
                                            <label for="causaDefuncion">Causa de la muerte:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <label for="informacion">Esta Información consta en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-num col s4">
                                            <input id="numLibroD" name="numLibroD" type="number" class="validate"
                                                   value="{{ $UbicacionActaDefuncion->Libro }}">
                                            <label for="numLibroD">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioD" name="numFolioD" type="number" class="validate"
                                                   value="{{ $UbicacionActaDefuncion->Folio }}">
                                            <label for="numFolioD">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoD" name="numAsientoD" type="number" class="validate"
                                                   value="{{ $UbicacionActaDefuncion->Asiento }}">
                                            <label for="numAsientoD">Número de Asiento:</label>
                                        </div>
                                    </div>
                            </div>

                            @else
                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>No cuenta con esta partido</p>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="checkbox" id="checkDefuncion"/>
                                        <label for="checkDefuncion">Agregar Defunción</label>
                                    </div>
                                </div>

                                <div id="contentDefuncion" style="display: none;">
                                    <div class="row">
                                        <div class="input-field col s6"></div>
                                        <div class="input-field col s6">
                                            <label>Fecha de la defunción:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="lugarDefuncion" name="lugarDefuncion" type="text"
                                                   class="validate">
                                            <label for="lugarDefuncion"> Defunción en:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaDefuncion" name='fechaDefuncion'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="causaDefuncion" name="causaDefuncion" type="text"
                                                   class="validate">
                                            <label for="causaDefuncion">Causa de la muerte:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <label for="informacion">Esta Información consta en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-num col s4">
                                            <input id="numLibroD" name="numLibroD" type="number" class="validate">
                                            <label for="numLibroD">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioD" name="numFolioD" type="number" class="validate">
                                            <label for="numFolioD">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoD" name="numAsientoD" type="number" class="validate">
                                            <label for="numAsientoD">Número de Asiento:</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>

                <div class="row"></br></br></div>

                <div class="row">
                    <button id="guardarActa" class="waves-effect waves-light btn right" type="submit"><i
                                class="material-icons left">save</i>Guardar
                    </button>
                </div>

                <input type="hidden" name="IDPersona" id="IDPersona" value="{{ $persona->IDPersona }}"/>

                <input type="hidden" name="source" id="Source" value="{{ $source }}"/>

                <input type="hidden" name="idSolicitud" id="Source" value="{{ $idSolicitud }}"/>

            </form>
        </div>
        <div class="col s12 m4 l2"></div>
    </div>

    <script>

        window.onload = function () {
            $(".datepicker").datepicker({ maxDate: new Date(), dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ]
            }).val()

            $(document).ready(function () {
                $('#parroquia > option[value="{{ $acta->IDParroquia }}"]').attr('selected', 'selected');
                $("input[name=tipoHijo][value= {{ $laico->IDTipo_Hijo }} ]").prop('checked', true);
                if ($("#tipoH2").is(':checked')) {
                    $("#nombrePadreEdit").prop('disabled', false);
                    $("#nombreMadreEdit").prop('disabled', false);
                }
                if ($("#tipoH1").is(':checked')) {
                    $("#nombrePadreEdit").prop('disabled', true);
                    $("#nombreMadreEdit").prop('disabled', false);
                }

                var laico = {!! json_encode($laico) !!};
                var actaBautismo = {!! json_encode($actaBautismo) !!};
                var actaConfirma = {!! json_encode($actaConfirma) !!};
                var actaMatrimonio = {!! json_encode($actaMatrimonio) !!};
                var actaDefuncion = {!! json_encode($actaDefuncion) !!};

                if (laico != null) {
                    $( "#fechaNacEdit" ).datepicker( "setDate", new Date(laico.FechaNacimiento) );
                }
                if (actaBautismo != null) {
                    $( "#fechaBaut" ).datepicker( "setDate", new Date(actaBautismo.FechaBautismo) );
                }
                if (actaConfirma != null) {
                    $( "#fechaConfir" ).datepicker( "setDate", new Date(actaConfirma.FechaConfirma) );
                }
                if (actaMatrimonio != null) {
                    $( "#fechaMatrimonio" ).datepicker( "setDate", new Date(actaMatrimonio.FechaMatrimonio) );
                }
                if (actaDefuncion != null) {
                    $( "#fechaDefuncion" ).datepicker( "setDate", new Date(actaDefuncion.FechaDefuncion) );
                }
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
                    $("#fechaBaut").prop('required',true);
                } else {
                    $("#contentBautismo").css("display", "none");
                    $("#fechaBaut").prop('required',false);
                }
            });

            $("#checkConfirma").change(function () {
                if ($("#checkConfirma").is(':checked')) {
                    $("#contentConfirma").css("display", "block");
                    $("#fechaConfir").prop('required',true);
                } else {
                    $("#contentConfirma").css("display", "none");
                    $("#fechaConfir").prop('required',false);
                }
            });

            $("#checkMatrimonio").change(function () {
                if ($("#checkMatrimonio").is(':checked')) {
                    $("#contentMatrimonio").css("display", "block");
                    $("#fechaMatrimonio").prop('required',true);
                } else {
                    $("#contentMatrimonio").css("display", "none");
                    $("#fechaMatrimonio").prop('required',false);
                }
            });

            $("#checkDefuncion").change(function () {
                if ($("#checkDefuncion").is(':checked')) {
                    $("#contentDefuncion").css("display", "block");
                    $("#fechaDefuncion").prop('required',true);
                } else {
                    $("#contentDefuncion").css("display", "none");
                    $("#fechaDefuncion").prop('required',false);
                }
            });

            $('select').material_select();
        }

    </script>

@endsection
