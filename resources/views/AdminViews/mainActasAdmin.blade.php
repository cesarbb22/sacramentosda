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
                    <div class="input-field col s3">
                            <input name='tipoCedula' type="radio" id="tipoCed1"/>
                            <label for="tipoCed1">Nacional</label>
                            <input name='tipoCedula' type="radio" id="tipoCed2"/>
                            <label for="tipoCed2">Extranjero</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="numCedula" name='numCedula' type="text" class="validate" disabled
                               oninvalid="this.setCustomValidity('Formato incorrecto')"
                               oninput="setCustomValidity('')">
                        <label for="numCedula">Número de identificación:</label>
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
                        <input id="apellido2" name='apellido2' type="text">
                        <label for="apellido2">Segundo apellido:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH1"/>
                            <label for="tipoH1">Hijo no reconocido</label>
                        </p>
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH2"/>
                            <label for="tipoH2">Hijo legítimo</label>
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
                        <input id="lugarNac" name='lugarNac' type="text">
                        <label for="LugarNac">Lugar de nacimiento:</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="fechaNac" name='fechaNac'
                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" required size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                               oninput="setCustomValidity('')">
                    </div>
                </div>


                <div class="row"></div>

                <div class="row">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Bautizo
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>
                                            <input type="checkbox" id="checkBautizo" name="checkBautizo"/>
                                            <label for="checkBautizo">Agregar Bautizo</label>
                                        </p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <label>Fecha de Bautizo:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="parroquiaBautismo" name='parroquiaBautismo' disabled>
                                            @foreach ($parroquias as $pa)
                                                <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                            @endforeach
{{--                                            <option value="otro">Otro</option>--}}
                                        </select>
                                        <label>Seleccione la Parroquia:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaBaut" name='fechaBautizo'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10" required
                                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarBautizoDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarBautizo" name="lugarBautizo" type="text" class=""
                                               disabled>
                                        <label for="lugarBautizo"> Bautizado en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreAbuelosPaternos" name="nombreAbuelosPaternos" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
                                        <label for="nombreAbuelosPaternos">Nombre de abuelos paternos:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombreAbuelosMaternos" name="nombreAbuelosMaternos" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
                                        <label for="nombreAbuelosMaternos">Nombre de abuelos maternos:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreMadrina" name="nombreMadrinaB" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
                                        <label for="nombreMadrina">Nombre de la madrina:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino" name="nombrePadrinoB" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
                                        <label for="nombrePadrino">Nombre del padrino:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input id="nombreSacerdoteBau" name="nombreSacerdoteBau" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
                                        <label for="nombreSacerdoteBau">Nombre de sacerdote que bautiza:</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-num col s4">
                                        <input id="numLibroB" name="numLibroB" type="number" class="validate"
                                               disabled required>
                                        <label for="numLibroB">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioB" name="numFolioB" type="number" class="validate"
                                               disabled required>
                                        <label for="numFolioB">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoB" name="numAsientoB" type="number" class="validate"
                                               disabled required>
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
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Primera Comunión
                            </div>
                            <div class="collapsible-body">

                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>
                                            <input type="checkbox" id="checkPrimeraComunion" name="checkPrimeraComunion"/>
                                            <label for="checkPrimeraComunion">Agregar Primera Comunión</label>
                                        </p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="input-field col s6">
                                    </div>
                                    <div class="input-field col s6">
                                        <label>Fecha de Primera Comunión:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select id="parroquiaPrimeraComunion" name='parroquiaPrimeraComunion' disabled>
                                            @foreach ($parroquias as $pa)
                                                <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                            @endforeach
                                            <option value="otro">Otro</option>
                                        </select>
                                        <label>Seleccione la Parroquia:</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="fechaPrimeraComunion" name='fechaPrimeraComunion'
                                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" disabled size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10" required
                                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarPrimeraComunionDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarPrimeraComunion" name="lugarPrimeraComunion" type="text" class=""
                                               disabled>
                                        <label for="lugarPrimeraComunion"> Bautizado en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <label for="informacion">Esta información consta en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-num col s4">
                                        <input id="numLibroPC" name="numLibroPC" type="number" class="validate"
                                               disabled required>
                                        <label for="numLibroPC">Número de Libro:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numFolioPC" name="numFolioPC" type="number" class="validate"
                                               disabled required>
                                        <label for="numFolioPC">Número de Folio:</label>
                                    </div>
                                    <div class="input-num col s4">
                                        <input id="numAsientoPC" name="numAsientoPC" type="number" class="validate"
                                               disabled required>
                                        <label for="numAsientoPC">Número de Asiento:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="notasMarginalesPrimeraC" name="notasMarginalesPrimeraC" class="materialize-textarea" disabled></textarea>
                                        <label for="notasMarginalesPrimeraC">Notas Marginales:</label>
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
                                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarConfirmaDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarConfirma" name="lugarConfirma" type="text" class=""
                                               disabled>
                                        <label for="lugarConfirma"> Confirmado en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombrePadrino1" name="nombrePadrinoC1" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
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
                                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarMatrimonioDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarMatrimonio" name="lugarMatrimonio" type="text" class=""
                                               disabled>
                                        <label for="lugarMatrimonio"> Matrimonio en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="nombreConyuge" name="nombreConyuge" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
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
                                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="row" id="lugarDefuncionDiv">
                                    <div class="input-field col s6">
                                        <input id="lugarDefuncion" name="lugarDefuncion" type="text" class=""
                                               disabled>
                                        <label for="lugarDefuncion"> Defunción en:</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s8">
                                        <input id="causaDefuncion" name="causaDefuncion" type="text" class="validate"
                                               required disabled
                                               oninvalid="this.setCustomValidity('Campo requerido')"
                                               oninput="setCustomValidity('')">
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
            var today = new Date();
            today.setDate(today.getDate() + 15);
            $(".datepicker").datepicker({ maxDate: today, dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ]
            }).val()

            $('#parroquiaBautismo > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
            $('#parroquiaPrimeraComunion > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
            $('#parroquiaConfirma > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
            $('#parroquiaMatrimonio > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
            $('#parroquiaDefuncion > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');

            // radio button para cedula
            $("#tipoCed1").change(function () {
                if ($("#tipoCed1").is(':checked')) {
                    $("#numCedula").prop('pattern', '^[0-9]{9}$');
                    $("#numCedula").prop('minlength', '9');
                    $("#numCedula").prop('maxlength', '9');
                    $("#numCedula").prop('disabled', false);
                    $("#numCedula").focus();
                    $("#numCedula").blur();
                }
            });

            $("#tipoCed2").change(function () {
                if ($("#tipoCed2").is(':checked')) {
                    $("#numCedula").prop('pattern', '^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+){11,16}|[0-9]{11,16}$');
                    $("#numCedula").prop('minlength', '11');
                    $("#numCedula").prop('maxlength', '16');
                    $("#numCedula").prop('disabled', false);
                    $("#numCedula").focus();
                    $("#numCedula").blur();
                }
            });

            // radio button para tipo de hijo
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

            $("#checkPrimeraComunion").change(function () {
                if ($("#checkPrimeraComunion").is(':checked')) {
                    $("#parroquiaPrimeraComunion").prop('disabled', false);
                    $("#lugarPrimeraComunion").prop('disabled', false);
                    $("#fechaPrimeraComunion").prop('disabled', false);
                    $("#numLibroPC").prop('disabled', false);
                    $("#numFolioPC").prop('disabled', false);
                    $("#numAsientoPC").prop('disabled', false);
                    $("#notasMarginalesPrimeraC").prop('disabled', false);
                } else {
                    $("#parroquiaPrimeraComunion").prop('disabled', true);
                    $("#lugarPrimeraComunion").val("");
                    $("#lugarPrimeraComunion").prop('disabled', true);
                    $("#fechaPrimeraComunion").prop('disabled', true);
                    $("#numLibroPC").prop('disabled', true);
                    $("#numFolioPC").prop('disabled', true);
                    $("#numAsientoPC").prop('disabled', true);
                    $("#notasMarginalesPrimeraC").prop('disabled', true);
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
            $("#lugarPrimeraComunionDiv").css("display", "none");
            $("#lugarConfirmaDiv").css("display", "none");
            $("#lugarMatrimonioDiv").css("display", "none");
            $("#lugarDefuncionDiv").css("display", "none");

            $("#parroquiaBautismo").change(function () {
                var valor = $("#parroquiaBautismo").val();
                if (valor === "otro") {
                    $("#lugarBautizo").prop('required', true);
                    $("#lugarBautizoDiv").css("display", "block");
                    $("#lugarBautizo").val("");
                    $("#numLibroB").prop('required', false);
                    $("#numFolioB").prop('required', false);
                    $("#numAsientoB").prop('required', false);
                } else {
                    $("#lugarBautizo").prop('required', false);
                    $("#lugarBautizoDiv").css("display", "none");
                    $("#lugarBautizo").val("");
                    $("#numLibroB").prop('required', true);
                    $("#numFolioB").prop('required', true);
                    $("#numAsientoB").prop('required', true);
                }
            });
            $("#parroquiaPrimeraComunion").change(function () {
                var valor = $("#parroquiaPrimeraComunion").val();
                if (valor === "otro") {
                    $("#lugarPrimeraComunion").prop('required', true);
                    $("#lugarPrimeraComunionDiv").css("display", "block");
                    $("#lugarPrimeraComunion").val("");
                    $("#numLibroPC").prop('required', false);
                    $("#numFolioPC").prop('required', false);
                    $("#numAsientoPC").prop('required', false);
                } else {
                    $("#lugarPrimeraComunion").prop('required', false);
                    $("#lugarPrimeraComunionDiv").css("display", "none");
                    $("#lugarPrimeraComunion").val("");
                    $("#numLibroPC").prop('required', true);
                    $("#numFolioPC").prop('required', true);
                    $("#numAsientoPC").prop('required', true);
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


            // Fecha Nacimiento autocompletado
            $("#fechaNac").keypress(function (e) {
                e.preventDefault();
                var fecNac = $('#fechaNac').val();
                if (fecNac.length <= 9) {
                    fecNac = fecNac + e.key;
                    if (fecNac.length === 2 || fecNac.length === 5) {
                        fecNac = fecNac + '/';
                    }
                    $('#fechaNac').val(fecNac);
                }
            });

            // Fecha Bautizo autocompletado
            $("#fechaBaut").keypress(function (e) {
                e.preventDefault();
                var fecha = $('#fechaBaut').val();
                if (fecha.length <= 9) {
                    fecha = fecha + e.key;
                    if (fecha.length === 2 || fecha.length === 5) {
                        fecha = fecha + '/';
                    }
                    $('#fechaBaut').val(fecha);
                }
            });

            // Fecha primera comunion autocompletado
            $("#fechaPrimeraComunion").keypress(function (e) {
                e.preventDefault();
                var fecha = $('#fechaPrimeraComunion').val();
                if (fecha.length <= 9) {
                    fecha = fecha + e.key;
                    if (fecha.length === 2 || fecha.length === 5) {
                        fecha = fecha + '/';
                    }
                    $('#fechaPrimeraComunion').val(fecha);
                }
            });

            // Fecha Confirma autocompletado
            $("#fechaConfir").keypress(function (e) {
                e.preventDefault();
                var fecha = $('#fechaConfir').val();
                if (fecha.length <= 9) {
                    fecha = fecha + e.key;
                    if (fecha.length === 2 || fecha.length === 5) {
                        fecha = fecha + '/';
                    }
                    $('#fechaConfir').val(fecha);
                }
            });

            // Fecha Matrimonio autocompletado
            $("#fechaMatrimonio").keypress(function (e) {
                e.preventDefault();
                var fecha = $('#fechaMatrimonio').val();
                if (fecha.length <= 9) {
                    fecha = fecha + e.key;
                    if (fecha.length === 2 || fecha.length === 5) {
                        fecha = fecha + '/';
                    }
                    $('#fechaMatrimonio').val(fecha);
                }
            });

            // Fecha defuncion autocompletado
            $("#fechaDefuncion").keypress(function (e) {
                e.preventDefault();
                var fecha = $('#fechaDefuncion').val();
                if (fecha.length <= 9) {
                    fecha = fecha + e.key;
                    if (fecha.length === 2 || fecha.length === 5) {
                        fecha = fecha + '/';
                    }
                    $('#fechaDefuncion').val(fecha);
                }
            });

            $('select').material_select();

        }

    </script>

@endsection
