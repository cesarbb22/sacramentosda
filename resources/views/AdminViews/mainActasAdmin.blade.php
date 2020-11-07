@extends('layouts.masterPageAdmin')

@section('content')

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

                <div class="col s12 m4 l4"><h4 class="center-align">Nueva Partida</h4></div>

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

            <form id="formActa" method="POST" action="/crearActa" autocomplete="off">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s4">
                        <input id="numCedula" name='numCedula' type="text" class="validate" minlength="9" maxlength="9"
                               oninvalid="this.setCustomValidity('Debe ingresar cédula con el formato: 101230456')"
                               oninput="setCustomValidity('')">
                        <label for="numCedula">Número de cédula:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombre" name='nombre' type="text" class="validate" required
                               oninvalid="this.setCustomValidity('Debe ingresar el nombre')"
                               oninput="setCustomValidity('')">
                        <label for="nombree">Nombre:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido1" name='apellido1' type="text" class="validate" required
                               oninvalid="this.setCustomValidity('Debe ingresar el primer apellido')"
                               oninput="setCustomValidity('')">
                        <label for="apellido1">Primer apellido:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido2" name='apellido2' type="text" class="validate" required
                               oninvalid="this.setCustomValidity('Debe ingresar el segundo apellido')"
                               oninput="setCustomValidity('')">
                        <label for="apellido2">Segundo apellido:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH1"/>
                            <label for="tipoH1">Hijo Natural</label>
                        </p>
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH2"/>
                            <label for="tipoH2">Hijo Legítimo</label>
                        </p>
                    </div>
                    <div class="col s8">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombrePadre" name='nombrePadre' type="text" class="validate" required disabled>
                                <label for="nombrePadre">Nombre del padre:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombreMadre" name='nombreMadre' type="text" class="validate" disabled>
                                <label for="nombreMadre">Nombre de la madre:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                    </div>
                    <div class="input-field col s6">
                        <label>Fecha de nacimiento:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="lugarNac" name='lugarNac' type="text" class="validate" required>
                        <label for="LugarNac">Lugar de nacimiento:</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="fechaNac" name='fechaNac'
                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                               oninput="setCustomValidity('')">
                    </div>
                </div>


                <div class="row"></div>

                <div class="row">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Bautismo
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>
                                            <input type="checkbox" id="checkBautizo" name="checkBautizo"/>
                                            <label for="checkBautizo">Agregar Bautismo</label>
                                        </p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <label>Fecha de Bautismo:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="parroquiaBautismo" name='parroquiaBautismo' disabled>
                                            @foreach ($parroquias as $pa)
                                                <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                            @endforeach
                                            <option value="otro">Otro</option>
                                        </select>
                                        <label>Seleccione la Parroquia:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaBaut" name='fechaBautizo'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarBautizoDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarBautizo" name="lugarBautizo" type="text" class=""
                                               required disabled>
                                        <label for="lugarBautizo"> Bautizado en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreAbuelosPaternos" name="nombreAbuelosPaternos" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreAbuelosPaternos">Nombre de abuelos paternos:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombreAbuelosMaternos" name="nombreAbuelosMaternos" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreAbuelosMaternos">Nombre de abuelos maternos:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreMadrina" name="nombreMadrinaB" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreMadrina">Nombre de la madrina:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino" name="nombrePadrinoB" type="text" class="validate"
                                               required disabled>
                                        <label for="nombrePadrino">Nombre del padrino:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombreSacerdoteBau" name="nombreSacerdoteBau" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreSacerdoteBau">Nombre de sacerdote que bautiza:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-num col s4">
                                        <input id="numLibroB" name="numLibroB" type="number" class="validate"
                                               disabled>
                                        <label for="numLibroB">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioB" name="numFolioB" type="number" class="validate"
                                               disabled>
                                        <label for="numFolioB">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoB" name="numAsientoB" type="number" class="validate"
                                               disabled>
                                        <label for="numAsientoB">Número de Asiento:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="notasMarginalesBau" name="notasMarginalesBau" class="materialize-textarea" disabled></textarea>
                                        <label for="notasMarginalesBau">Notas Marginales:</label>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Confirma
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>
                                            <input type="checkbox" id="checkConfirma" name="checkConfirma"/>
                                            <label for="checkConfirma">Agregar Confirma</label>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <label>Fecha de Confirma:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="parroquiaConfirma" name='parroquiaConfirma' disabled>
                                            @foreach ($parroquias as $paConf)
                                                <option value="{{ $paConf->IDParroquia }}">{{ $paConf->NombreParroquia }}</option>
                                            @endforeach
                                            <option value="otro">Otro</option>
                                        </select>
                                        <label>Seleccione la Parroquia:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaConfir" name='fechaConfirma'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarConfirmaDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarConfirma" name="lugarConfirma" type="text" class=""
                                               required disabled>
                                        <label for="lugarConfirma"> Confirmado en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino1" name="nombrePadrinoC1" type="text" class="validate"
                                               required disabled>
                                        <label for="nombrePadrino1">Nombre del padrino o madrina:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroC" name="numLibroC" type="number" class="validate"
                                               disabled>
                                        <label for="numLibroC">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioC" name="numFolioC" type="number" class="validate"
                                               disabled>
                                        <label for="numFolioC">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoC" name="numAsientoC" type="number" class="validate"
                                               disabled>
                                        <label for="numAsientoC">Número de Asiento:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="notasMarginalesConf" name="notasMarginalesConf" class="materialize-textarea" disabled></textarea>
                                        <label for="notasMarginalesConf">Notas Marginales:</label>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Matrimonio
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>
                                            <input type="checkbox" id="checkMatrimonio" name="checkMatrimonio"/>
                                            <label for="checkMatrimonio">Agregar Matrimonio</label>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <label>Fecha del Matrimonio:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="parroquiaMatrimonio" name='parroquiaMatrimonio' disabled>
                                            @foreach ($parroquias as $paMat)
                                                <option value="{{ $paMat->IDParroquia }}">{{ $paMat->NombreParroquia }}</option>
                                            @endforeach
                                            <option value="otro">Otro</option>
                                        </select>
                                        <label>Seleccione la Parroquia:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaMatrimonio" name='fechaMatrimonio'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarMatrimonioDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarMatrimonio" name="lugarMatrimonio" type="text" class=""
                                               required disabled>
                                        <label for="lugarMatrimonio"> Matrimonio en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreConyuge" name="nombreConyuge" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreConyuge">Nombre del cónyuge:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroM" name="numLibroM" type="number" class="validate"
                                               disabled>
                                        <label for="numLibroM">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioM" name="numFolioM" type="number" class="validate"
                                               disabled>
                                        <label for="numFolioM">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoM" name="numAsientoM" type="number" class="validate"
                                               disabled>
                                        <label for="numAsientoM">Número de Asiento:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="notasMarginalesMat" name="notasMarginalesMat" class="materialize-textarea" disabled></textarea>
                                        <label for="notasMarginalesMat">Notas Marginales:</label>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Defunción
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>
                                            <input type="checkbox" id="checkDefuncion" name="checkDefuncion"/>
                                            <label for="checkDefuncion">Agregar Defunción</label>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <label>Fecha de la defunción:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="parroquiaDefuncion" name='parroquiaDefuncion' disabled>
                                            @foreach ($parroquias as $paDef)
                                                <option value="{{ $paDef->IDParroquia }}">{{ $paDef->NombreParroquia }}</option>
                                            @endforeach
                                            <option value="otro">Otro</option>
                                        </select>
                                        <label>Seleccione la Parroquia:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaDefuncion" name='fechaDefuncion'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarDefuncionDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarDefuncion" name="lugarDefuncion" type="text" class=""
                                               required disabled>
                                        <label for="lugarDefuncion"> Defunción en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="causaDefuncion" name="causaDefuncion" type="text" class="validate"
                                               required disabled>
                                        <label for="causaDefuncion">Causa de la muerte:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroD" name="numLibroD" type="number" class="validate"
                                               disabled>
                                        <label for="numLibroD">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioD" name="numFolioD" type="number" class="validate"
                                               disabled>
                                        <label for="numFolioD">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoD" name="numAsientoD" type="number" class="validate"
                                               disabled>
                                        <label for="numAsientoD">Número de Asiento:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="notasMarginalesDef" name="notasMarginalesDef" class="materialize-textarea" disabled></textarea>
                                        <label for="notasMarginalesDef">Notas Marginales:</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>

                <div class="row">
                    <button id="guardarActa" class="waves-effect waves-light btn right" type="submit"><i
                            class="material-icons left">save</i>Guardar
                    </button>
                </div>
            </form>

        </div>
        <div class="col s12 m4 l2"></div>
    </div>

    <script>

        window.onload = function () {
            $(".datepicker").datepicker({ maxDate: new Date(), dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ]
            }).val()

            $("#tipoH2").change(function () {
                if ($("#tipoH2").is(':checked')) {
                    $("#nombrePadre").prop('disabled', false);
                    $("#nombreMadre").prop('disabled', false);
                }
            });


            $("#tipoH1").change(function () {
                if ($("#tipoH1").is(':checked')) {
                    $("#nombrePadre").prop('disabled', true);
                    $("#nombreMadre").prop('disabled', false);
                }
            });

            $("#checkBautizo").change(function () {
                if ($("#checkBautizo").is(':checked')) {
                    $("#parroquiaBautismo").prop('disabled', false);
                    $("#lugarBautizo").prop('disabled', false);
                    $("#fechaBaut").prop('disabled', false);
                    $("#nombreAbuelosPaternos").prop('disabled', false);
                    $("#nombreAbuelosMaternos").prop('disabled', false);
                    $("#nombreMadrina").prop('disabled', false);
                    $("#nombrePadrino").prop('disabled', false);
                    $("#nombreSacerdoteBau").prop('disabled', false);
                    $("#numLibroB").prop('disabled', false);
                    $("#numFolioB").prop('disabled', false);
                    $("#numAsientoB").prop('disabled', false);
                    $("#notasMarginalesBau").prop('disabled', false);
                } else {
                    $("#parroquiaBautismo").prop('disabled', true);
                    $("#lugarBautizo").val("");
                    $("#lugarBautizo").prop('disabled', true);
                    $("#fechaBaut").prop('disabled', true);
                    $("#nombreAbuelosPaternos").prop('disabled', true);
                    $("#nombreAbuelosMaternos").prop('disabled', true);
                    $("#nombreMadrina").prop('disabled', true);
                    $("#nombrePadrino").prop('disabled', true);
                    $("#nombreSacerdoteBau").prop('disabled', true);
                    $("#numLibroB").prop('disabled', true);
                    $("#numFolioB").prop('disabled', true);
                    $("#numAsientoB").prop('disabled', true);
                    $("#notasMarginalesBau").prop('disabled', true);
                }
                $('select').material_select();
            });

            $("#checkConfirma").change(function () {
                if ($("#checkConfirma").is(':checked')) {
                    $("#parroquiaConfirma").prop('disabled', false);
                    $("#lugarConfirma").prop('disabled', false);
                    $("#fechaConfir").prop('disabled', false);
                    $("#nombrePadrino1").prop('disabled', false);
                    $("#numLibroC").prop('disabled', false);
                    $("#numFolioC").prop('disabled', false);
                    $("#numAsientoC").prop('disabled', false);
                    $("#notasMarginalesConf").prop('disabled', false);
                } else {
                    $("#parroquiaConfirma").prop('disabled', true);
                    $("#lugarConfirma").val("");
                    $("#lugarConfirma").prop('disabled', true);
                    $("#fechaConfir").prop('disabled', true);
                    $("#nombrePadrino1").prop('disabled', true);
                    $("#numLibroC").prop('disabled', true);
                    $("#numFolioC").prop('disabled', true);
                    $("#numAsientoC").prop('disabled', true);
                    $("#notasMarginalesConf").prop('disabled', true);
                }
                $('select').material_select();
            });

            $("#checkMatrimonio").change(function () {
                if ($("#checkMatrimonio").is(':checked')) {
                    $("#parroquiaMatrimonio").prop('disabled', false);
                    $("#lugarMatrimonio").prop('disabled', false);
                    $("#fechaMatrimonio").prop('disabled', false);
                    $("#nombreConyuge").prop('disabled', false);
                    $("#numLibroM").prop('disabled', false);
                    $("#numFolioM").prop('disabled', false);
                    $("#numAsientoM").prop('disabled', false);
                    $("#notasMarginalesMat").prop('disabled', false);
                } else {
                    $("#parroquiaMatrimonio").prop('disabled', true);
                    $("#lugarMatrimonio").val("");
                    $("#lugarMatrimonio").prop('disabled', true);
                    $("#fechaMatrimonio").prop('disabled', true);
                    $("#nombreConyuge").prop('disabled', true);
                    $("#numLibroM").prop('disabled', true);
                    $("#numFolioM").prop('disabled', true);
                    $("#numAsientoM").prop('disabled', true);
                    $("#notasMarginalesMat").prop('disabled', true);
                }
                $('select').material_select();
            });

            $("#checkDefuncion").change(function () {
                if ($("#checkDefuncion").is(':checked')) {
                    $("#parroquiaDefuncion").prop('disabled', false);
                    $("#lugarDefuncion").prop('disabled', false);
                    $("#fechaDefuncion").prop('disabled', false);
                    $("#causaDefuncion").prop('disabled', false);
                    $("#numLibroD").prop('disabled', false);
                    $("#numFolioD").prop('disabled', false);
                    $("#numAsientoD").prop('disabled', false);
                    $("#notasMarginalesDef").prop('disabled', false);
                } else {
                    $("#parroquiaDefuncion").prop('disabled', true);
                    $("#lugarDefuncion").val("");
                    $("#lugarDefuncion").prop('disabled', true);
                    $("#fechaDefuncion").prop('disabled', true);
                    $("#causaDefuncion").prop('disabled', true);
                    $("#numLibroD").prop('disabled', true);
                    $("#numFolioD").prop('disabled', true);
                    $("#numAsientoD").prop('disabled', true);
                    $("#notasMarginalesDef").prop('disabled', true);
                }
                $('select').material_select();
            });

            $("#lugarBautizoDiv").css("display", "none");
            $("#lugarConfirmaDiv").css("display", "none");
            $("#lugarMatrimonioDiv").css("display", "none");
            $("#lugarDefuncionDiv").css("display", "none");

            $("#parroquiaBautismo").change(function () {
                var valor = $("#parroquiaBautismo").val();
                if (valor === "otro") {
                    $("#lugarBautizo").prop('required', true);
                    $("#lugarBautizoDiv").css("display", "block");
                    $("#lugarBautizo").val("");
                } else {
                    $("#lugarBautizo").prop('required', false);
                    $("#lugarBautizoDiv").css("display", "none");
                    $("#lugarBautizo").val("");
                }
            });
            $("#parroquiaConfirma").change(function () {
                var valor = $("#parroquiaConfirma").val();
                if (valor === "otro") {
                    $("#lugarConfirma").prop('required', true);
                    $("#lugarConfirmaDiv").css("display", "block");
                    $("#lugarConfirma").val("");
                } else {
                    $("#lugarConfirma").prop('required', false);
                    $("#lugarConfirmaDiv").css("display", "none");
                    $("#lugarConfirma").val("");
                }
            });
            $("#parroquiaMatrimonio").change(function () {
                var valor = $("#parroquiaMatrimonio").val();
                if (valor === "otro") {
                    $("#lugarMatrimonio").prop('required', true);
                    $("#lugarMatrimonioDiv").css("display", "block");
                    $("#lugarMatrimonio").val("");
                } else {
                    $("#lugarMatrimonio").prop('required', false);
                    $("#lugarMatrimonioDiv").css("display", "none");
                    $("#lugarMatrimonio").val("");
                }
            });
            $("#parroquiaDefuncion").change(function () {
                var valor = $("#parroquiaDefuncion").val();
                if (valor === "otro") {
                    $("#lugarDefuncion").prop('required', true);
                    $("#lugarDefuncionDiv").css("display", "block");
                    $("#lugarDefuncion").val("");
                } else {
                    $("#lugarDefuncion").prop('required', false);
                    $("#lugarDefuncionDiv").css("display", "none");
                    $("#lugarDefuncion").val("");
                }
            });

            $('select').material_select();

        }

    </script>

@endsection
