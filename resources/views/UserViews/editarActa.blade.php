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


            <form method="POST" action="/actualizarActaSol" autocomplete="off">

                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s3">
                        <input name='tipoCedula' type="radio" id="tipoCed1" value="1"/>
                        <label for="tipoCed1">Nacional</label>
                        <input name='tipoCedula' type="radio" id="tipoCed2" value="2"/>
                        <label for="tipoCed2">Extranjero</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="numCedulaEdit" name='numCedulaEdit' type="text" class="validate"
                               value="{{ $persona->Cedula }}" minlength="9" maxlength="9"
                               oninvalid="this.setCustomValidity('Debe ingresar cédula con el formato: 101230456')"
                               oninput="setCustomValidity('')" pattern="^[0-9]{9}$">
                        <label for="numCedulaEdit">Número de cédula:</label>
                    </div>

                    <div class="input-field col s8">
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombreEdit" name='nombreEdit' type="text" class="validate" required
                               value="{{ $persona->Nombre }}">
                        <label for="nombreEdit">Nombre:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido1Edit" name='apellido1Edit' type="text" class="validate" required
                               value="{{ $persona->PrimerApellido }}">
                        <label for="apellido1Edit">Primer apellido:</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="apellido2Edit" name='apellido2Edit' type="text"
                               value="{{ $persona->SegundoApellido }}">
                        <label for="apellido2Edit">Segundo apellido:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH1" value="1"/>
                            <label for="tipoH1">Hijo no reconocido</label>
                        </p>
                        <p>
                            <input name='tipoHijo' type="radio" id="tipoH2" value="2"/>
                            <label for="tipoH2">Hijo legítimo</label>
                        </p>
                    </div>
                    <div class="col s8">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombrePadreEdit" name='nombrePadreEdit' type="text" class="validate"
                                       value="{{ $laico->NombrePadre }}">
                                <label for="nombrePadreEdit">Nombre del padre:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="nombreMadreEdit" name='nombreMadreEdit' type="text" class="validate"
                                       value="{{ $laico->NombreMadre }} ">
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
                        <input id="lugarNacEdit" name='lugarNacEdit' type="text" class="validate"
                               value="{{ $laico->LugarNacimiento }}">
                        <label for="LugarNacEdit">Lugar de nacimiento:</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="fechaNacEdit" name='fechaNacEdit'
                               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" size="10"
                               placeholder="dd/mm/aaaa" minlength="10" maxlength="10" required
                               pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                               oninput="setCustomValidity('')">
                    </div>
                </div>

                <div class="row"></div>

                <div class="row">

                    <ul class="collapsible" data-collapsible="expandable">
                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Bautizo
                            </div>
                            <div class="collapsible-body">
                                @if($actaBautismo != null)
                                    <div class="row">
                                        <div class="input-field col s6"></div>
                                        <div class="input-field col s6">
                                            <label>Fecha de Bautizo:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select id="parroquiaBautismo" name='parroquiaBautismo'>
                                                @foreach ($parroquias as $pa)
                                                    <option
                                                        value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                                @endforeach
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione la Parroquia:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            @if($isEditableArray[0])
                                                <input id="fechaBaut" name='fechaBautizo'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10" required
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            @else
                                                <input id="fechaBaut" name="fechaBautizo"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       class="" type="text" value="{{ $actaBautismo->FechaBautismo }}"
                                                       readonly>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" id="lugarBautizoDiv">
                                        <div class="input-field col s6">
                                            <input id="lugarBautizo" name="lugarBautizo"
                                                   value="{{ $actaBautismo->LugarBautismo }}" type="text">
                                            <label for="lugarBautizo"> Bautizado en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombreAbuelosPaternos" name="nombreAbuelosPaternos" type="text" class="validate"
                                                   value="{{ $actaBautismo->AbuelosPaternos }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="nombreAbuelosPaternos">Nombre de abuelos paternos:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <input id="nombreAbuelosMaternos" name="nombreAbuelosMaternos" type="text" class="validate"
                                                   value="{{ $actaBautismo->AbuelosMaternos }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="nombreAbuelosMaternos">Nombre de abuelos maternos:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombreMadrina" name="nombreMadrinaB" type="text" class="validate"
                                                   value="{{ $actaBautismo->PadrinoBau1 }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="nombreMadrina">Nombre de la madrina:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <input id="nombrePadrino" name="nombrePadrinoB" type="text" class="validate"
                                                   value="{{ $actaBautismo->PadrinoBau2 }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="nombrePadrino">Nombre del padrino:</label>
                                        </div>
                                        <div class="input-field col s8">
                                            <input id="nombreSacerdoteBau" name="nombreSacerdoteBau" type="text" class="validate"
                                                   value="{{ $actaBautismo->SacerdoteBautiza }}" required
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
                                                   value="{{ $UbicacionActaBautismo->Libro }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="numLibroB">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioB" name="numFolioB" type="number" class="validate"
                                                   value="{{ $UbicacionActaBautismo->Folio }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="numFolioB">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoB" name="numAsientoB" type="number" class="validate"
                                                   value="{{ $UbicacionActaBautismo->Asiento }}" required
                                                   oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                            <label for="numAsientoB">Número de Asiento:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="notasMarginalesBauEdit" name='notasMarginalesBauEdit' type="text"
                                                   value="{{ $actaBautismo->NotasMarginales }}">
                                            <label for="notasMarginalesBauEdit">Notas Marginales:</label>
                                        </div>
                                    </div>

                                    <div class="div-creado-por">
                                        <span class="p-creado-por">Creada por: {{ $nomParroquiaBauRegistra }}</span>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkBautismo" name="checkBautismo"/>
                                            <label for="checkBautismo">Agregar Bautizo</label>
                                        </div>
                                    </div>

                                    <div id="contentBautismo" style="display: none;">
                                        <div class="row">
                                            <div class="input-field col s6"></div>
                                            <div class="input-field col s6">
                                                <label>Fecha de Bautizo:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s6">
                                                <select id="parroquiaBautismo" name='parroquiaBautismo'>
                                                    @foreach ($parroquias as $pa)
                                                        <option
                                                            value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                                    @endforeach
                                                    <option value="otro">Otro</option>
                                                </select>
                                                <label>Seleccione la Parroquia:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaBaut" name='fechaBautizo' required disabled
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row" id="lugarBautizoDiv">
                                            <div class="input-field col s6">
                                                <input id="lugarBautizo" name="lugarBautizo" type="text"
                                                       class="validate">
                                                <label for="lugarBautizo"> Bautizado en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombreAbuelosPaternos" name="nombreAbuelosPaternos" type="text"
                                                       class="validate" required disabled
                                                oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                                <label for="nombreAbuelosPaternos">Nombre de abuelos paternos</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <input id="nombreAbuelosMaternos" name="nombreAbuelosMaternos" type="text"
                                                       class="validate" required disabled
                                                oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                                <label for="nombreAbuelosMaternos">Nombre de abuelos maternos</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombreMadrina" name="nombreMadrinaB" type="text"
                                                       class="validate" required disabled
                                                oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                                <label for="nombreMadrina">Nombre de la madrina:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <input id="nombrePadrino" name="nombrePadrinoB" type="text"
                                                       class="validate" required disabled
                                                oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                                <label for="nombrePadrino">Nombre del padrino:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <input id="nombreSacerdoteBau" name="nombreSacerdoteBau" type="text"
                                                       class="validate" required disabled
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
                                                <input id="numLibroB" name="numLibroB" type="number"
                                                       class="validate" required disabled
                                                       oninvalid="this.setCustomValidity('Campo requerido')"
                                                       oninput="setCustomValidity('')">
                                                <label for="numLibroB">Número de Libro:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numFolioB" name="numFolioB" type="number"
                                                       class="validate" required disabled
                                                       oninvalid="this.setCustomValidity('Campo requerido')"
                                                       oninput="setCustomValidity('')">
                                                <label for="numFolioB">Número de Folio:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numAsientoB" name="numAsientoB" type="number"
                                                       class="validate" required disabled
                                                       oninvalid="this.setCustomValidity('Campo requerido')"
                                                       oninput="setCustomValidity('')">
                                                <label for="numAsientoB">Número de Asiento:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="notasMarginalesBau" name="notasMarginalesBauEdit"
                                                          class="materialize-textarea"></textarea>
                                                <label for="notasMarginalesBau">Notas Marginales:</label>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Primera Comunión
                            </div>
                            <div class="collapsible-body">
                                @if($actaPrimeraComunion != null)
                                    <div class="row">
                                        <div class="input-field col s6"></div>
                                        <div class="input-field col s6">
                                            <label>Fecha de Primera Comunión:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select id="parroquiaPrimeraComunion" name='parroquiaPrimeraComunion'>
                                                @foreach ($parroquias as $paPC)
                                                    <option
                                                        value="{{ $paPC->IDParroquia }}">{{ $paPC->NombreParroquia }}</option>
                                                @endforeach
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione la Parroquia:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            @if($isEditableArray[1])
                                                <input id="fechaPrimeraComunion" name='fechaPrimeraComunion'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            @else
                                                <input id="fechaPrimeraComunion" name="fechaPrimeraComunion"
                                                       pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                                       class="" type="text"
                                                       value="{{ $actaPrimeraComunion -> FechaPrimeraComunion }}" readonly>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" id="lugarPrimeraComunionDiv">
                                        <div class="input-field col s6">
                                            <input id="lugarPrimeraComunion" name="lugarPrimeraComunion" type="text"
                                                   value="{{ $actaPrimeraComunion -> LugarPrimeraComunion }}">
                                            <label for="lugarPrimeraComunion"> Primera Comunión en:</label>
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
                                                   value="{{ $UbicacionPrimeraComunion->Libro }}">
                                            <label for="numLibroPC">Número de Libro:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numFolioPC" name="numFolioPC" type="number" class="validate"
                                                   value="{{ $UbicacionPrimeraComunion->Folio }}">
                                            <label for="numFolioPC">Número de Folio:</label>
                                        </div>
                                        <div class="input-num col s4">
                                            <input id="numAsientoPC" name="numAsientoPC" type="number" class="validate"
                                                   value="{{ $UbicacionPrimeraComunion->Asiento }}">
                                            <label for="numAsientoPC">Número de Asiento:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="notasMarginalesPrimeraCEdit" name='notasMarginalesPrimeraCEdit' type="text"
                                                   value="{{ $actaPrimeraComunion->NotasMarginales }}">
                                            <label for="notasMarginalesPrimeraCEdit">Notas Marginales:</label>
                                        </div>
                                    </div>

                                    <div class="div-creado-por">
                                        <span class="p-creado-por">Creada por: {{ $nomParroquiaPrimeraCRegistra }}</span>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkPrimeraComunion" name="checkPrimeraComunion"/>
                                            <label for="checkPrimeraComunion">Agregar Primera Comunión</label>
                                        </div>
                                    </div>

                                    <div id="contentPrimeraComunion" style="display: none;">
                                        <div class="row">
                                            <div class="input-field col s6"></div>
                                            <div class="input-field col s6">
                                                <label>Fecha de Primera Comunión:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s6">
                                                <select id="parroquiaPrimeraComunion" name='parroquiaPrimeraComunion'>
                                                    @foreach ($parroquias as $paPC)
                                                        <option
                                                            value="{{ $paPC->IDParroquia }}">{{ $paPC->NombreParroquia }}</option>
                                                    @endforeach
                                                    <option value="otro">Otro</option>
                                                </select>
                                                <label>Seleccione la Parroquia:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaPrimeraComunion" name='fechaPrimeraComunion'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row" id="lugarPrimeraComunionDiv">
                                            <div class="input-field col s6">
                                                <input id="lugarPrimeraComunion" name="lugarPrimeraComunion" type="text"
                                                       class="validate">
                                                <label for="lugarPrimeraComunion"> Primera Comunión en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <label for="informacion">Esta información consta en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-num col s4">
                                                <input id="numLibroPC" name="numLibroPC" type="number" class="validate">
                                                <label for="numLibroPC">Número de Libro:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numFolioPC" name="numFolioPC" type="number" class="validate">
                                                <label for="numFolioPC">Número de Folio:</label>
                                            </div>
                                            <div class="input-num col s4">
                                                <input id="numAsientoPC" name="numAsientoPC" type="number"
                                                       class="validate">
                                                <label for="numAsientoPC">Número de Asiento:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="notasMarginalesPrimeraC" name="notasMarginalesPrimeraCEdit"
                                                          class="materialize-textarea"></textarea>
                                                <label for="notasMarginalesPrimeraC">Notas Marginales:</label>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Confirma
                            </div>
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
                                            <select id="parroquiaConfirma" name='parroquiaConfirma'>
                                                @foreach ($parroquias as $paConf)
                                                    <option
                                                        value="{{ $paConf->IDParroquia }}">{{ $paConf->NombreParroquia }}</option>
                                                @endforeach
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione la Parroquia:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            @if($isEditableArray[2])
                                                <input id="fechaConfir" name='fechaConfirma'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            @else
                                                <input id="fechaConfir" name="fechaConfirma"
                                                       pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                                       class="" type="text" value="{{ $actaConfirma -> FechaConfirma }}"
                                                       readonly>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" id="lugarConfirmaDiv">
                                        <div class="input-field col s6">
                                            <input id="lugarConfirma" name="lugarConfirma" type="text"
                                                   value="{{ $actaConfirma -> LugarConfirma }}">
                                            <label for="lugarConfirma"> Confirmado en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombrePadrino1" name="nombrePadrinoC1" type="text"
                                                   class="validate" value="{{ $actaConfirma -> PadrinoCon1 }}" required
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

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="notasMarginalesConfEdit" name='notasMarginalesConfEdit'
                                                   type="text"
                                                   value="{{ $actaConfirma->NotasMarginales }}">
                                            <label for="notasMarginalesConfEdit">Notas Marginales:</label>
                                        </div>
                                    </div>

                                    <div class="div-creado-por">
                                        <span class="p-creado-por">Creada por: {{ $nomParroquiaConfRegistra }}</span>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkConfirma" name="checkConfirma"/>
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
                                                <select id="parroquiaConfirma" name='parroquiaConfirma'>
                                                    @foreach ($parroquias as $paConf)
                                                        <option
                                                            value="{{ $paConf->IDParroquia }}">{{ $paConf->NombreParroquia }}</option>
                                                    @endforeach
                                                    <option value="otro">Otro</option>
                                                </select>
                                                <label>Seleccione la Parroquia:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaConfir" name='fechaConfirma'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row" id="lugarConfirmaDiv">
                                            <div class="input-field col s6">
                                                <input id="lugarConfirma" name="lugarConfirma" type="text"
                                                       class="validate">
                                                <label for="lugarConfirma"> Confirmado en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombrePadrino1" name="nombrePadrinoC1" type="text"
                                                       class="validate" required disabled
                                                oninvalid="this.setCustomValidity('Campo requerido')"
                                                   oninput="setCustomValidity('')">
                                                <label for="nombrePadrino1">Nombre del padrino o
                                                    madrina:</label>
                                            </div>
                                            <div class="input-field col s8">
                                                <label for="informacion">Esta información consta en:</label>
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

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="notasMarginalesConf" name="notasMarginalesConfEdit"
                                                          class="materialize-textarea"></textarea>
                                                <label for="notasMarginalesConf">Notas Marginales:</label>
                                            </div>
                                        </div>
                                    </div>
                            @endif

                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Matrimonio
                            </div>
                            <div class="collapsible-body">
                                @if($actaMatrimonio != null)
                                    <div class="row">
                                        <button id="nuevoMatBtn" class="waves-effect waves-light btn right"><i
                                                class="material-icons left">add</i>Nuevo Matrimonio
                                        </button>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6"></div>
                                        <div class="input-field col s6">
                                            <label>Fecha del Matrimonio:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select id="parroquiaMatrimonio" name='parroquiaMatrimonio'>
                                                @foreach ($parroquias as $paMat)
                                                    <option
                                                        value="{{ $paMat->IDParroquia }}">{{ $paMat->NombreParroquia }}</option>
                                                @endforeach
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione la Parroquia:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            @if($isEditableArray[3])
                                                <input id="fechaMatrimonio" name='fechaMatrimonio'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            @else
                                                <input id="fechaMatrimonio" name="fechaMatrimonio"
                                                       pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                                       class="" type="text"
                                                       value="{{ $actaMatrimonio -> FechaMatrimonio }}" readonly>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" id="lugarMatrimonioDiv">
                                        <div class="input-field col s6">
                                            <input id="lugarMatrimonio" name="lugarMatrimonio" type="text"
                                                   value="{{ $actaMatrimonio -> LugarMatrimonio }}">
                                            <label for="lugarMatrimonio"> Matrimonio en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="nombreConyuge" name="nombreConyuge" type="text" class="validate"
                                                   value="{{ $actaMatrimonio -> NombreConyugue }}" required
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

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="notasMarginalesMatEdit" name='notasMarginalesMatEdit' type="text"
                                                   value="{{ $actaMatrimonio->NotasMarginales }}">
                                            <label for="notasMarginalesMatEdit">Notas Marginales:</label>
                                        </div>
                                    </div>

                                    <div class="div-creado-por">
                                        <span class="p-creado-por">Creada por: {{ $nomParroquiaMatRegistra }}</span>
                                    </div>

                                    @foreach ($matrimoniosInfo as $info)
                                        @if($info['actaMatrimonio'] != null)
                                            <hr/><hr/>
                                            <div class="row">
                                                <div class="input-field col s6"></div>
                                                <div class="input-field col s6">
                                                    <label>Fecha del Matrimonio:</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <select
                                                        id="parroquiaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                                        name='parroquiaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}'>
                                                        @foreach ($parroquias as $paMat)
                                                            <option
                                                                value="{{ $paMat->IDParroquia }}">{{ $paMat->NombreParroquia }}</option>
                                                        @endforeach
                                                        <option value="otro">Otro</option>
                                                    </select>
                                                    <label
                                                        for="parroquiaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}">Seleccione
                                                        la Parroquia:</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input id="fechaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}" name='fechaMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}'
                                                           class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                           pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                           oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                           oninput="setCustomValidity('')">
                                                </div>
                                            </div>

                                            <div class="row"
                                                 id="lugarMatrimonioDiv_{{ $info['actaMatrimonio']->IDMatrimonio }}">
                                                <div class="input-field col s6">
                                                    <input
                                                        id="lugarMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                                        name="lugarMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}"
                                                        type="text"
                                                        value="{{ $info['actaMatrimonio']->LugarMatrimonio }}">
                                                    <label for="lugarMatrimonio_{{ $info['actaMatrimonio']->IDMatrimonio }}">Matrimonio en:</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s8">
                                                    <input id="nombreConyuge_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="nombreConyuge_{{ $info['actaMatrimonio']->IDMatrimonio }}" type="text" class="validate"
                                                           value="{{ $info['actaMatrimonio'] -> NombreConyugue }}" required
                                                           oninvalid="this.setCustomValidity('Campo requerido')"
                                                           oninput="setCustomValidity('')">
                                                    <label for="nombreConyuge_{{ $info['actaMatrimonio']->IDMatrimonio }}">Nombre del cónyuge:</label>
                                                </div>
                                                <div class="input-field col s8">
                                                    <label for="informacion">Esta información consta en:</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-num col s4">
                                                    <input id="numLibroM_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="numLibroM_{{ $info['actaMatrimonio']->IDMatrimonio }}" type="number" class="validate"
                                                           value="{{ $info['UbicacionActaMatrimonio']->Libro }}">
                                                    <label for="numLibroM_{{ $info['actaMatrimonio']->IDMatrimonio }}">Número de Libro:</label>
                                                </div>
                                                <div class="input-num col s4">
                                                    <input id="numFolioM_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="numFolioM_{{ $info['actaMatrimonio']->IDMatrimonio }}" type="number" class="validate"
                                                           value="{{ $info['UbicacionActaMatrimonio']->Folio }}">
                                                    <label for="numFolioM_{{ $info['actaMatrimonio']->IDMatrimonio }}">Número de Folio:</label>
                                                </div>
                                                <div class="input-num col s4">
                                                    <input id="numAsientoM_{{ $info['actaMatrimonio']->IDMatrimonio }}" name="numAsientoM_{{ $info['actaMatrimonio']->IDMatrimonio }}" type="number" class="validate"
                                                           value="{{ $info['UbicacionActaMatrimonio']->Asiento }}">
                                                    <label for="numAsientoM_{{ $info['actaMatrimonio']->IDMatrimonio }}">Número de Asiento:</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="notasMarginalesMatEdit_{{ $info['actaMatrimonio']->IDMatrimonio }}" name='notasMarginalesMatEdit_{{ $info['actaMatrimonio']->IDMatrimonio }}' type="text"
                                                           value="{{ $info['actaMatrimonio']->NotasMarginales }}">
                                                    <label for="notasMarginalesMatEdit_{{ $info['actaMatrimonio']->IDMatrimonio }}">Notas Marginales:</label>
                                                </div>
                                            </div>
                                            <div class="div-creado-por">
                                                <span
                                                    class="p-creado-por">Creada por: {{ $info['nomParroquiaMatRegistra'] }}</span>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div id="nuevosMatrimoniosContainer">
                                        <input type="hidden" name="matrimonioCount" id="matrimonioCount" value="{{ count($matrimoniosInfo) }}">
                                    </div>
                                @else
                                    <div class="row">
                                        <button id="nuevoMatBtn" class="waves-effect waves-light btn right"
                                                disabled><i
                                                class="material-icons left">add</i>Nuevo Matrimonio
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <p>No cuenta con esta partida</p>
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="checkbox" id="checkMatrimonio" name="checkMatrimonio"/>
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
                                                <select id="parroquiaMatrimonio" name='parroquiaMatrimonio'>
                                                    @foreach ($parroquias as $paMat)
                                                        <option
                                                            value="{{ $paMat->IDParroquia }}">{{ $paMat->NombreParroquia }}</option>
                                                    @endforeach
                                                    <option value="otro">Otro</option>
                                                </select>
                                                <label>Seleccione la Parroquia:</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="fechaMatrimonio" name='fechaMatrimonio'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="row" id="lugarMatrimonioDiv">
                                            <div class="input-field col s6">
                                                <input id="lugarMatrimonio" name="lugarMatrimonio" type="text"
                                                       class="validate">
                                                <label for="lugarMatrimonio"> Matrimonio en:</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s8">
                                                <input id="nombreConyuge" name="nombreConyuge" type="text"
                                                       class="validate" required disabled
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

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="notasMarginalesMat" name="notasMarginalesMatEdit"
                                                          class="materialize-textarea"></textarea>
                                                <label for="notasMarginalesMat">Notas Marginales:</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="nuevosMatrimoniosContainer">
                                        <input type="hidden" name="matrimonioCount" id="matrimonioCount" value="0">
                                    </div>
                            @endif
                        </li>

                        <li>
                            <div class="collapsible-header waves-light waves-effect white-text">Partida de Defunción
                            </div>
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
                                            <select id="parroquiaDefuncion" name='parroquiaDefuncion'>
                                                @foreach ($parroquias as $paDef)
                                                    <option
                                                        value="{{ $paDef->IDParroquia }}">{{ $paDef->NombreParroquia }}</option>
                                                @endforeach
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione la Parroquia:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            @if($isEditableArray[4])
                                                <input id="fechaDefuncion" name='fechaDefuncion'
                                                       class="datepicker validate" type="text"
                                                       title="Formato de fecha: dd/mm/aaaa" size="10"
                                                       placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                       pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                       oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                       oninput="setCustomValidity('')">
                                            @else
                                                <input id="fechaDefuncion" name="fechaDefuncion"
                                                       pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d"
                                                       class="" type="text"
                                                       value="{{ $actaDefuncion -> FechaDefuncion }}" readonly>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row" id="lugarDefuncionDiv">
                                        <div class="input-field col s6">
                                            <input id="lugarDefuncion" name="lugarDefuncion" type="text"
                                                   value="{{ $actaDefuncion -> LugarDefuncion }}">
                                            <label for="lugarDefuncion"> Defunción en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="causaDefuncion" name="causaDefuncion" type="text"
                                                   class="validate" value="{{ $actaDefuncion -> CausaMuerte }}" required
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

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="notasMarginalesDefEdit" name='notasMarginalesDefEdit' type="text"
                                                   value="{{ $actaDefuncion->NotasMarginales }}">
                                            <label for="notasMarginalesDefEdit">Notas Marginales:</label>
                                        </div>
                                    </div>

                                    <div class="div-creado-por">
                                        <span class="p-creado-por">Creada por: {{ $nomParroquiaDefRegistra }}</span>
                                    </div>
                            </div>

                            @else
                                <div class="row">
                                    <div class="input-field col s6">
                                        <p>No cuenta con esta partida</p>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="checkbox" id="checkDefuncion" name="checkDefuncion"/>
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
                                            <select id="parroquiaDefuncion" name='parroquiaDefuncion'>
                                                @foreach ($parroquias as $paDef)
                                                    <option
                                                        value="{{ $paDef->IDParroquia }}">{{ $paDef->NombreParroquia }}</option>
                                                @endforeach
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione la Parroquia:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaDefuncion" name='fechaDefuncion'
                                                   class="datepicker validate" type="text"
                                                   title="Formato de fecha: dd/mm/aaaa" size="10"
                                                   placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="row" id="lugarDefuncionDiv">
                                        <div class="input-field col s6">
                                            <input id="lugarDefuncion" name="lugarDefuncion" type="text"
                                                   class="validate">
                                            <label for="lugarDefuncion"> Defunción en:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s8">
                                            <input id="causaDefuncion" name="causaDefuncion" type="text"
                                                   class="validate" required disabled
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

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="notasMarginalesDef" name="notasMarginalesDefEdit"
                                                      class="materialize-textarea"></textarea>
                                            <label for="notasMarginalesDef">Notas Marginales:</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>

                <div class="row"><br><br></div>

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
        function obtenerHtmlFormulario(id, parroquias) {
            var opcionesParroquias = parroquias.map(function (paMat) {
                return `<option value="${paMat.IDParroquia}">${paMat.NombreParroquia}</option>`;
            }).join('');

            return `
        <div class="row">
        <hr/><hr/>
                                        <div class="input-field col s6">
                                        </div>
                                        <div class="input-field col s6">
                                            <label>Fecha del Matrimonio:</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <select id="parroquiaMatrimonio_nuevo_${id}" name="parroquiaMatrimonio_nuevo_${id}">
                    ${opcionesParroquias}
                    <option value="otro">Otro</option>
                </select>
        <label>Seleccione la Parroquia:</label>
    </div>
    <div class="input-field col s6">
        <input id="fechaMatrimonio_nuevo_${id}" name='fechaMatrimonio_nuevo_${id}'
               class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
               pattern="^([0-2][0-9]|3[0-1])(\\/|-)(0[1-9]|1[0-2])\\2(\\d{4})$"                                               oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
               oninput="setCustomValidity('')">
    </div>
</div>

<div class="row" id="lugarMatrimonioDiv_nuevo_${id}">
    <div class="input-field col s6">
        <input id="lugarMatrimonio_nuevo_${id}" name="lugarMatrimonio_nuevo_${id}" type="text" class="">
        <label for="lugarMatrimonio_nuevo_${id}"> Matrimonio en:</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s8">
        <input id="nombreConyuge_nuevo_${id}" name="nombreConyuge_nuevo_${id}" type="text" class="validate"
               required
               oninvalid="this.setCustomValidity('Campo requerido')"
               oninput="setCustomValidity('')">
        <label for="nombreConyuge_nuevo_${id}">Nombre del cónyuge:</label>
    </div>
    <div class="input-field col s8">
        <label for="informacion">Esta información consta en:</label>
    </div>
</div>

<div class="row">
    <div class="input-num col s4">
        <input id="numLibroM_nuevo_${id}" name="numLibroM_nuevo_${id}" type="number" class="validate">
        <label for="numLibroM_nuevo_${id}">Número de Libro:</label>
    </div>
    <div class="input-num col s4">
        <input id="numFolioM_nuevo_${id}" name="numFolioM_nuevo_${id}" type="number" class="validate">
        <label for="numFolioM_nuevo_${id}">Número de Folio:</label>
    </div>
    <div class="input-num col s4">
        <input id="numAsientoM_nuevo_${id}" name="numAsientoM_nuevo_${id}" type="number" class="validate">
        <label for="numAsientoM_nuevo_${id}">Número de Asiento:</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <textarea id="notasMarginalesMat_nuevo_${id}" name="notasMarginalesMat_nuevo_${id}" class="materialize-textarea"></textarea>
        <label for="notasMarginalesMat_nuevo_${id}">Notas Marginales:</label>
    </div>
</div>
`;
        }

        window.onload = function () {
            var parroquias = @json($parroquias);
            var contadorNuevosMatId = parseInt($('#matrimonioCount').val()) + 1;

            $('#nuevoMatBtn').on('click', function () {
                contadorNuevosMatId++;
                var nuevoFormulario = obtenerHtmlFormulario(contadorNuevosMatId, parroquias);
                $('#nuevosMatrimoniosContainer').append(nuevoFormulario);
                $("#lugarMatrimonioDiv_nuevo_" + contadorNuevosMatId).css("display", "none");

                // Inicializar
                $('select').material_select();

                var today = new Date();
                today.setDate(today.getDate() + 15);
                $(".datepicker").datepicker({
                    maxDate: today, dateFormat: "dd/mm/yy", autoSize: true,
                    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"]
                }).val()

                // Actualizar el conteo de matrimonios
                $('#matrimonioCount').val(contadorNuevosMatId);
            });

            var today = new Date();
            today.setDate(today.getDate() + 15);
            $(".datepicker").datepicker({
                maxDate: today, dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"]
            }).val()

            $('.collapsible').collapsible({
                accordion: false
            }).val();

            $(document).ready(function () {
                $("input[name=tipoHijo][value= {{ $laico->IDTipo_Hijo }} ]").prop('checked', true);
                if ($("#tipoH2").is(':checked')) {
                    $("#nombrePadreEdit").prop('disabled', false);
                    $("#nombreMadreEdit").prop('disabled', false);
                }
                if ($("#tipoH1").is(':checked')) {
                    $("#nombrePadreEdit").prop('disabled', true);
                    $("#nombreMadreEdit").prop('disabled', false);
                }

                // radio button para cedula
                var cedula = {!! json_encode($persona->Cedula) !!};
                if (cedula != null && cedula.length == 9) {
                    $("input[name=tipoCedula][value='1']").prop('checked', true);
                } else if (cedula != null && cedula.length >= 11) {
                    $("input[name=tipoCedula][value='2']").prop('checked', true);
                } else {
                    $("#numCedulaEdit").prop('disabled', true);
                }
                $("#tipoCed1").change(function () {
                    if ($("#tipoCed1").is(':checked')) {
                        $("#numCedulaEdit").prop('pattern', '^[0-9]{9}$');
                        $("#numCedulaEdit").prop('minlength', '9');
                        $("#numCedulaEdit").prop('maxlength', '9');
                        $("#numCedulaEdit").prop('disabled', false);
                        $("#numCedulaEdit").focus();
                        $("#numCedulaEdit").blur();
                    }
                });

                $("#tipoCed2").change(function () {
                    if ($("#tipoCed2").is(':checked')) {
                        $("#numCedulaEdit").prop('pattern', '^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+){11,16}|[0-9]{11,16}$');
                        $("#numCedulaEdit").prop('minlength', '11');
                        $("#numCedulaEdit").prop('maxlength', '16');
                        $("#numCedulaEdit").prop('disabled', false);
                        $("#numCedulaEdit").focus();
                        $("#numCedulaEdit").blur();
                    }
                });
                //--------------------------------------

                $('[id^="lugarMatrimonioDiv_"]').css("display", "none");

                var laico = {!! json_encode($laico) !!};
                var actaBautismo = {!! json_encode($actaBautismo) !!};
                var actaPrimeraComunion = {!! json_encode($actaPrimeraComunion) !!};
                var actaConfirma = {!! json_encode($actaConfirma) !!};
                var actaMatrimonio = {!! json_encode($actaMatrimonio) !!};
                var matrimoniosList = {!! json_encode($matrimoniosInfo) !!};
                var actaDefuncion = {!! json_encode($actaDefuncion) !!};
                var isEditableArray = {!! json_encode($isEditableArray) !!};

                if (actaBautismo != null && actaBautismo.AbuelosPaternos != null) {
                    $('.collapsible').collapsible('open', 0);
                }
                if (actaPrimeraComunion != null && (actaPrimeraComunion.NombreUserRegistra != null)) {
                    $('.collapsible').collapsible('open', 1);
                }
                if (actaConfirma != null && actaConfirma.PadrinoCon1 != null) {
                    $('.collapsible').collapsible('open', 2);
                }
                if (actaMatrimonio != null && actaMatrimonio.NombreConyugue != null) {
                    $('.collapsible').collapsible('open', 3);
                }
                if (actaDefuncion != null && actaDefuncion.CausaMuerte != null) {
                    $('.collapsible').collapsible('open', 4);
                }

                if (laico != null && laico.FechaNacimiento) {
                    $("#fechaNacEdit").datepicker("setDate", new Date(laico.FechaNacimiento.replace(/-/g, "/")));
                }
                if (actaBautismo != null && actaBautismo.FechaBautismo) {
                    $("#fechaBaut").datepicker("setDate", new Date(actaBautismo.FechaBautismo.replace(/-/g, "/")));
                }
                if (actaPrimeraComunion != null && actaPrimeraComunion.FechaPrimeraComunion) {
                    $( "#fechaPrimeraComunion" ).datepicker( "setDate", new Date(actaPrimeraComunion.FechaPrimeraComunion.replace(/-/g, "/")));
                }
                if (actaConfirma != null && actaConfirma.FechaConfirma) {
                    $("#fechaConfir").datepicker("setDate", new Date(actaConfirma.FechaConfirma.replace(/-/g, "/")));
                }
                if (actaMatrimonio != null && actaMatrimonio.FechaMatrimonio) {
                    $("#fechaMatrimonio").datepicker("setDate", new Date(actaMatrimonio.FechaMatrimonio.replace(/-/g, "/")));
                }

                matrimoniosList.forEach(function(matrimonio) {
                    if (matrimonio.actaMatrimonio != null && matrimonio.actaMatrimonio.FechaMatrimonio) {
                        var fechaMatrimonioId = "#fechaMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio;
                        $(fechaMatrimonioId).datepicker("setDate", new Date(matrimonio.actaMatrimonio.FechaMatrimonio.replace(/-/g, "/")));
                    }
                });

                if (actaDefuncion != null && actaDefuncion.FechaDefuncion) {
                    $("#fechaDefuncion").datepicker("setDate", new Date(actaDefuncion.FechaDefuncion.replace(/-/g, "/")));
                }

                if (!isEditableArray[0]) {
                    $("#lugarBautizo, #nombreAbuelosPaternos, #nombreAbuelosMaternos, #nombreMadrina, #nombrePadrino, #nombreSacerdoteBau, #numLibroB, #numFolioB, #numAsientoB, #notasMarginalesBauEdit").prop("readonly", true);
                    $("#lugarBautizo, #nombreAbuelosPaternos, #nombreAbuelosMaternos, #nombreMadrina, #nombrePadrino, #nombreSacerdoteBau, #numLibroB, #numFolioB, #numAsientoB, #notasMarginalesBauEdit").removeClass("validate");
                    $("#nombreAbuelosPaternos, #nombreAbuelosMaternos, #nombreMadrina, #nombrePadrino, #nombreSacerdoteBau, #numLibroB, #numFolioB, #numAsientoB").prop("required", false);
                    $("#parroquiaBautismo").prop("disabled", true);
                } else {
                    $("#lugarBautizoDiv").css("display", "none");
                }

                if (!isEditableArray[1]) {
                    $("#lugarPrimeraComunion, #numLibroPC, #numFolioPC, #numAsientoPC, #notasMarginalesPrimeraCEdit").prop("readonly", true);
                    $("#lugarPrimeraComunion, #numLibroPC, #numFolioPC, #numAsientoPC, #notasMarginalesPrimeraCEdit").removeClass("validate");
                    $("#parroquiaPrimeraComunion").prop("disabled", true);
                } else {
                    $("#lugarPrimeraComunionDiv").css("display", "none");
                }

                if (!isEditableArray[2]) {
                    $("#lugarConfirma, #nombrePadrino1, #numLibroC, #numFolioC, #numAsientoC, #notasMarginalesConfEdit").prop("readonly", true);
                    $("#lugarConfirma, #nombrePadrino1, #numLibroC, #numFolioC, #numAsientoC, #notasMarginalesConfEdit").removeClass("validate");
                    $("#nombrePadrino1").prop("required", false);
                    $("#parroquiaConfirma").prop("disabled", true);
                } else {
                    $("#lugarConfirmaDiv").css("display", "none");
                }

                if (!isEditableArray[3]) {
                    $("#lugarMatrimonio, #nombreConyuge, #numLibroM, #numFolioM, #numAsientoM, #notasMarginalesMatEdit").prop("readonly", true);
                    $("#lugarMatrimonio, #nombreConyuge, #numLibroM, #numFolioM, #numAsientoM, #notasMarginalesMatEdit").removeClass("validate");
                    $("#nombreConyuge").prop("required", false);
                    $("#parroquiaMatrimonio").prop("disabled", true);
                } else {
                    $("#lugarMatrimonioDiv").css("display", "none");
                }

                if (!isEditableArray[4]) {
                    $("#lugarDefuncion, #causaDefuncion, #numLibroD, #numFolioD, #numAsientoD, #notasMarginalesDefEdit").prop("readonly", true);
                    $("#lugarDefuncion, #causaDefuncion, #numLibroD, #numFolioD, #numAsientoD, #notasMarginalesDefEdit").removeClass("validate");
                    $("#causaDefuncion").prop("required", false);
                    $("#parroquiaDefuncion").prop("disabled", true);
                } else {
                    $("#lugarDefuncionDiv").css("display", "none");
                }

                if (actaBautismo != null && actaBautismo.IDParroquiaBautismo === null) {
                    $('#parroquiaBautismo > option[value="otro"]').attr('selected', 'selected');
                    $("#lugarBautizo").prop('required', true);
                    $("#lugarBautizoDiv").css("display", "block");
                } else if (actaBautismo != null) {
                    $('#parroquiaBautismo > option[value="' + actaBautismo.IDParroquiaBautismo + '"]').attr('selected', 'selected');
                    $("#lugarBautizoDiv").css("display", "none");
                }

                if (actaPrimeraComunion != null && actaPrimeraComunion.IDParroquiaPrimeraComunion === null) {
                    $('#parroquiaPrimeraComunion > option[value="otro"]').attr('selected', 'selected');
                    $("#lugarPrimeraComunion").prop('required', true);
                    $("#lugarPrimeraComunionDiv").css("display", "block");
                } else if (actaPrimeraComunion != null) {
                    $('#parroquiaPrimeraComunion > option[value="'+ actaPrimeraComunion.IDParroquiaPrimeraComunion +'"]').attr('selected', 'selected');
                    $("#lugarPrimeraComunionDiv").css("display", "none");
                }

                if (actaConfirma != null && actaConfirma.IDParroquiaConfirma === null) {
                    $('#parroquiaConfirma > option[value="otro"]').attr('selected', 'selected');
                    $("#lugarConfirma").prop('required', true);
                    $("#lugarConfirmaDiv").css("display", "block");
                } else if (actaConfirma != null) {
                    $('#parroquiaConfirma > option[value="' + actaConfirma.IDParroquiaConfirma + '"]').attr('selected', 'selected');
                    $("#lugarConfirmaDiv").css("display", "none");
                }

                if (actaMatrimonio != null && actaMatrimonio.IDParroquiaMatrimonio === null) {
                    $('#parroquiaMatrimonio > option[value="otro"]').attr('selected', 'selected');
                    $("#lugarMatrimonio").prop('required', true);
                    $("#lugarMatrimonioDiv").css("display", "block");
                } else if (actaMatrimonio != null) {
                    $('#parroquiaMatrimonio > option[value="' + actaMatrimonio.IDParroquiaMatrimonio + '"]').attr('selected', 'selected');
                    $("#lugarMatrimonioDiv").css("display", "none");
                }

                matrimoniosList.forEach(function(matrimonio) {
                    if (matrimonio.actaMatrimonio != null && matrimonio.actaMatrimonio.IDParroquiaMatrimonio === null) {
                        var parroquiaMatrimonioId = "#parroquiaMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio;
                        $(parroquiaMatrimonioId + ' > option[value="otro"]').attr('selected', 'selected');
                        $("#lugarMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio).prop('required', true);
                        $("#lugarMatrimonioDiv_" + matrimonio.actaMatrimonio.IDMatrimonio).css("display", "block");
                    } else if (matrimonio.actaMatrimonio != null) {
                        var parroquiaMatrimonioId = "#parroquiaMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio;
                        $(parroquiaMatrimonioId + ' > option[value="' + matrimonio.actaMatrimonio.IDParroquiaMatrimonio + '"]').attr('selected', 'selected');
                    }
                });

                if (actaDefuncion != null && actaDefuncion.IDParroquiaDefuncion === null) {
                    $('#parroquiaDefuncion > option[value="otro"]').attr('selected', 'selected');
                    $("#lugarDefuncion").prop('required', true);
                    $("#lugarDefuncionDiv").css("display", "block");
                } else if (actaDefuncion != null) {
                    $('#parroquiaDefuncion > option[value="' + actaDefuncion.IDParroquiaDefuncion + '"]').attr('selected', 'selected');
                    $("#lugarDefuncionDiv").css("display", "none");
                }

                // poner la parroquia del usuario cuando el acta no ha sido creada
                if (actaBautismo == null) {
                    $('#parroquiaBautismo > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
                }
                if (actaPrimeraComunion == null) {
                    $('#parroquiaPrimeraComunion > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
                }
                if (actaConfirma == null) {
                    $('#parroquiaConfirma > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
                }
                if (actaMatrimonio == null) {
                    $('#parroquiaMatrimonio > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
                }
                if (actaDefuncion == null) {
                    $('#parroquiaDefuncion > option[value="{{ $parroquiaUser }}"]').attr('selected', 'selected');
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
                    $("#fechaBaut").prop('disabled', false);
                    $("#nombreAbuelosPaternos").prop('disabled', false);
                    $("#nombreAbuelosMaternos").prop('disabled', false);
                    $("#nombreMadrina").prop('disabled', false);
                    $("#nombrePadrino").prop('disabled', false);
                    $("#nombreSacerdoteBau").prop('disabled', false);
                    $("#numLibroB").prop('disabled', false);
                    $("#numAsientoB").prop('disabled', false);
                    $("#numFolioB").prop('disabled', false);
                } else {
                    $("#contentBautismo").css("display", "none");
                    $("#fechaBaut").prop('disabled', true);
                    $("#nombreAbuelosPaternos").prop('disabled', true);
                    $("#nombreAbuelosMaternos").prop('disabled', true);
                    $("#nombreMadrina").prop('disabled', true);
                    $("#nombrePadrino").prop('disabled', true);
                    $("#nombreSacerdoteBau").prop('disabled', true);
                    $("#numLibroB").prop('disabled', true);
                    $("#numAsientoB").prop('disabled', true);
                    $("#numFolioB").prop('disabled', true);
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
                    $("#nombrePadrino1").prop('disabled', false);
                } else {
                    $("#contentConfirma").css("display", "none");
                    $("#nombrePadrino1").prop('disabled', true);
                }
            });

            $("#checkMatrimonio").change(function () {
                if ($("#checkMatrimonio").is(':checked')) {
                    $("#contentMatrimonio").css("display", "block");
                    $("#nombreConyuge").prop('disabled', false);
                } else {
                    $("#contentMatrimonio").css("display", "none");
                    $("#nombreConyuge").prop('disabled', true);
                }
            });

            $("#checkDefuncion").change(function () {
                if ($("#checkDefuncion").is(':checked')) {
                    $("#contentDefuncion").css("display", "block");
                    $("#causaDefuncion").prop('disabled', false);
                } else {
                    $("#contentDefuncion").css("display", "none");
                    $("#causaDefuncion").prop('disabled', true);
                }
            });

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
                } else {
                    $("#lugarPrimeraComunion").prop('required', false);
                    $("#lugarPrimeraComunionDiv").css("display", "none");
                    $("#lugarPrimeraComunion").val("");
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

            var matrimoniosList = {!! json_encode($matrimoniosInfo) !!};
            matrimoniosList.forEach(function(matrimonio) {
                var parroquiaMatrimonioId = "#parroquiaMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio;
                var lugarMatrimonioId = "#lugarMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio;
                var lugarMatrimonioDivId = "#lugarMatrimonioDiv_" + matrimonio.actaMatrimonio.IDMatrimonio;

                $(parroquiaMatrimonioId).change(function () {
                    var valor = $(parroquiaMatrimonioId).val();
                    if (valor === "otro") {
                        $(lugarMatrimonioId).prop('required', true);
                        $(lugarMatrimonioDivId).css("display", "block");
                        $(lugarMatrimonioId).val("");
                    } else {
                        $(lugarMatrimonioId).prop('required', false);
                        $(lugarMatrimonioDivId).css("display", "none");
                        $(lugarMatrimonioId).val("");
                    }
                });
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

            $('#nuevosMatrimoniosContainer').on('change', '[id^=parroquiaMatrimonio_]', function () {
                var valor = $(this).val();
                var id = $(this).attr('id').split('_')[2]; // Obtiene el identificador único del formulario actual

                if (valor === "otro") {
                    $("#lugarMatrimonio_nuevo_" + id).prop('required', true);
                    $("#lugarMatrimonioDiv_nuevo_" + id).css("display", "block");
                    $("#lugarMatrimonio_nuevo_" + id).val("");
                } else {
                    $("#lugarMatrimonio_nuevo_" + id).prop('required', false);
                    $("#lugarMatrimonioDiv_nuevo_" + id).css("display", "none");
                    $("#lugarMatrimonio_nuevo_" + id).val("");
                }
            });

            // Fecha Nacimiento autocompletado
            $("#fechaNacEdit").keypress(function (e) {
                e.preventDefault();
                var fecNac = $('#fechaNacEdit').val();
                if (fecNac.length <= 9) {
                    fecNac = fecNac + e.key;
                    if (fecNac.length === 2 || fecNac.length === 5) {
                        fecNac = fecNac + '/';
                    }
                    $('#fechaNacEdit').val(fecNac);
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

            // Fecha Primera Comunion autocompletado
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

            matrimoniosList.forEach(function(matrimonio) {
                var fechaMatrimonioId = "#fechaMatrimonio_" + matrimonio.actaMatrimonio.IDMatrimonio;
                $(fechaMatrimonioId).keypress(function (e) {
                    e.preventDefault();
                    var fecha = $(fechaMatrimonioId).val();
                    if (fecha.length <= 9) {
                        fecha = fecha + e.key;
                        if (fecha.length === 2 || fecha.length === 5) {
                            fecha = fecha + '/';
                        }
                        $(fechaMatrimonioId).val(fecha);
                    }
                });
            });

            matrimoniosList.forEach(function(matrimonio) {
                var fechaMatrimonioId = "#fechaMatrimonio_nuevo" + matrimonio.actaMatrimonio.IDMatrimonio;
                $(fechaMatrimonioId).keypress(function (e) {
                    e.preventDefault();
                    var fecha = $(fechaMatrimonioId).val();
                    if (fecha.length <= 9) {
                        fecha = fecha + e.key;
                        if (fecha.length === 2 || fecha.length === 5) {
                            fecha = fecha + '/';
                        }
                        $(fechaMatrimonioId).val(fecha);
                    }
                });
            });

            // fecha matrimonio dinamicos
            $('#nuevosMatrimoniosContainer').on('keypress', '[id^=fechaMatrimonio_]', function (e) {
                e.preventDefault();
                var $thisFecha = $(this);
                var fecha = $thisFecha.val();
                if (fecha.length <= 9) {
                    fecha = fecha + e.key;
                    if (fecha.length === 2 || fecha.length === 5) {
                        fecha = fecha + '/';
                    }
                    $thisFecha.val(fecha);
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
