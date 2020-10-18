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
                               required
                               oninvalid="this.setCustomValidity('Debe ingresar cédula con el formato: 101230456')"
                               oninput="setCustomValidity('')">
                        <label for="numCedula">Número de cédula:</label>
                    </div>
                    <div class="input-field col s8">
                        <select name='parroquia'>
                            @foreach ($parroquias as $pa)
                                <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                            @endforeach
                        </select>
                        <label>Seleccione la Parroquia:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombre" name='nombre' type="text" class="validate" required>
                        <label for="nombree">Nombre:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido1" name='apellido1' type="text" class="validate" required>
                        <label for="apellido1">Primer apellido:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido2" name='apellido2' type="text" class="validate" required>
                        <label for="apellido2">Segundo apellido:</label>
                    </div>
                </div>
                <div class="row">

                    <div class="col s8">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombreMadre" name='nombreMadre' type="text" class="validate" required>
                                <label for="nombreMadre">Nombre completo de la madre:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombrePadre" name='nombrePadre' type="text" class="validate">
                                <label for="nombrePadre">Nombre completo del padre:</label>
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


                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="notasMarginales" name="notasMarginales" class="materialize-textarea"></textarea>
                        <label for="notasMarginales">Notas Marginales:</label>
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
                                            <input type="checkbox" id="checkB"/>
                                            <label for="checkB">Agregar Bautismo</label>
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
                                        <input id="lugarBautizo" name="lugarBautizo" type="text" class="validate"
                                               required disabled>
                                        <label for="lugarBautizo"> Bautizado en:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaBaut" name='fechaBautizo'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreMadrina" name="nombreMadrinaB" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreMadrina">Nombre completo de la madrina:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino" name="nombrePadrinoB" type="text" class="validate"
                                               required disabled>
                                        <label for="nombrePadrino">Nombre completo del padrino:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta Información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroB" name="numLibroB" type="number" class="validate" required
                                               disabled>
                                        <label for="numLibroB">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioB" name="numFolioB" type="number" class="validate" required
                                               disabled>
                                        <label for="numFolioB">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoB" name="numAsientoB" type="number" class="validate"
                                               required disabled>
                                        <label for="numAsientoB">Número de Asiento:</label>
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
                                            <input type="checkbox" id="checkC"/>
                                            <label for="checkC">Agregar Confirma</label>
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
                                        <input id="lugarConfirma" name="lugarConfirma" type="text" class="validate"
                                               required disabled>
                                        <label for="lugarConfirma"> Confirmado en:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaConfir" name='fechaConfirma'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino1" name="nombrePadrinoC1" type="text" class="validate"
                                               required disabled>
                                        <label for="nombrePadrino1">Nombre completo del padrino o madrina:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino2" name="nombrePadrinoC2" type="text" class="validate"
                                               disabled>
                                        <label for="nombrePadrino2">Nombre completo del padrino o madrina:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta Información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroC" name="numLibroC" type="number" class="validate" required
                                               disabled>
                                        <label for="numLibroC">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioC" name="numFolioC" type="number" class="validate" required
                                               disabled>
                                        <label for="numFolioC">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoC" name="numAsientoC" type="number" class="validate"
                                               required disabled>
                                        <label for="numAsientoC">Número de Asiento:</label>
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
                                            <input type="checkbox" id="checkM"/>
                                            <label for="checkM">Agregar Matrimonio</label>
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
                                        <input id="lugarMatrimonio" name="lugarMatrimonio" type="text" class="validate"
                                               required disabled>
                                        <label for="lugarMatrimonio"> Matrimonio en:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaMatrimonio" name='fechaMatrimonio'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreConyuge" name="nombreConyuge" type="text" class="validate"
                                               required disabled>
                                        <label for="nombreConyuge">Nombre completo del cónyuge:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta Información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroM" name="numLibroM" type="number" class="validate" required
                                               disabled>
                                        <label for="numLibroM">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioM" name="numFolioM" type="number" class="validate" required
                                               disabled>
                                        <label for="numFolioM">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoM" name="numAsientoM" type="number" class="validate"
                                               required disabled>
                                        <label for="numAsientoM">Número de Asiento:</label>
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
                                            <input type="checkbox" id="checkD"/>
                                            <label for="checkD">Agregar Defunción</label>
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
                                        <input id="lugarDefuncion" name="lugarDefuncion" type="text" class="validate"
                                               required disabled>
                                        <label for="lugarDefuncion"> Defunción en:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaDefuncion" name='fechaDefuncion'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                               pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="causaDefuncion" name="causaDefuncion" type="text" class="validate"
                                               required disabled>
                                        <label for="causaDefuncion">Causa de la muerte:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta Información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-num col s4">
                                        <input id="numLibroD" name="numLibroD" type="number" class="validate" required
                                               disabled>
                                        <label for="numLibroD">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioD" name="numFolioD" type="number" class="validate" required
                                               disabled>
                                        <label for="numFolioD">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoD" name="numAsientoD" type="number" class="validate"
                                               required disabled>
                                        <label for="numAsientoD">Número de Asiento:</label>
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

            $("#checkB").change(function () {
                if ($("#checkB").is(':checked')) {
                    $("#lugarBautizo").prop('disabled', false);
                    $("#fechaBaut").prop('disabled', false);
                    $("#nombreMadrina").prop('disabled', false);
                    $("#nombrePadrino").prop('disabled', false);
                    $("#numLibroB").prop('disabled', false);
                    $("#numFolioB").prop('disabled', false);
                    $("#numAsientoB").prop('disabled', false);
                } else {
                    $("#lugarBautizo").prop('disabled', true);
                    $("#fechaBaut").prop('disabled', true);
                    $("#nombreMadrina").prop('disabled', true);
                    $("#nombrePadrino").prop('disabled', true);
                    $("#numLibroB").prop('disabled', true);
                    $("#numFolioB").prop('disabled', true);
                    $("#numAsientoB").prop('disabled', true);
                }
            });

            $("#checkC").change(function () {
                if ($("#checkC").is(':checked')) {
                    $("#lugarConfirma").prop('disabled', false);
                    $("#fechaConfir").prop('disabled', false);
                    $("#nombrePadrino1").prop('disabled', false);
                    $("#nombrePadrino2").prop('disabled', false);
                    $("#numLibroC").prop('disabled', false);
                    $("#numFolioC").prop('disabled', false);
                    $("#numAsientoC").prop('disabled', false);
                } else {
                    $("#lugarConfirma").prop('disabled', true);
                    $("#fechaConfir").prop('disabled', true);
                    $("#nombrePadrino1").prop('disabled', true);
                    $("#nombrePadrino2").prop('disabled', true);
                    $("#numLibroC").prop('disabled', true);
                    $("#numFolioC").prop('disabled', true);
                    $("#numAsientoC").prop('disabled', true);
                }
            });

            $("#checkM").change(function () {
                if ($("#checkM").is(':checked')) {
                    $("#lugarMatrimonio").prop('disabled', false);
                    $("#fechaMatrimonio").prop('disabled', false);
                    $("#nombreConyuge").prop('disabled', false);
                    $("#numLibroM").prop('disabled', false);
                    $("#numFolioM").prop('disabled', false);
                    $("#numAsientoM").prop('disabled', false);
                } else {
                    $("#lugarMatrimonio").prop('disabled', true);
                    $("#fechaMatrimonio").prop('disabled', true);
                    $("#nombreConyuge").prop('disabled', true);
                    $("#numLibroM").prop('disabled', true);
                    $("#numFolioM").prop('disabled', true);
                    $("#numAsientoM").prop('disabled', true);
                }
            });

            $("#checkD").change(function () {
                if ($("#checkD").is(':checked')) {
                    $("#lugarDefuncion").prop('disabled', false);
                    $("#fechaDefuncion").prop('disabled', false);
                    $("#causaDefuncion").prop('disabled', false);
                    $("#numLibroD").prop('disabled', false);
                    $("#numFolioD").prop('disabled', false);
                    $("#numAsientoD").prop('disabled', false);
                } else {
                    $("#lugarDefuncion").prop('disabled', true);
                    $("#fechaDefuncion").prop('disabled', true);
                    $("#causaDefuncion").prop('disabled', true);
                    $("#numLibroD").prop('disabled', true);
                    $("#numFolioD").prop('disabled', true);
                    $("#numAsientoD").prop('disabled', true);
                }
            });

            $('select').material_select();

        }

    </script>

@endsection
