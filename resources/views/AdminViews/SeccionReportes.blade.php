@extends('layouts.masterPageAdmin')

@section('content')

    <style>
        .border-right {
            border-right: 2px solid #51081C;
        }
    </style>

    <div class="row">
        <div class="col s12 m4 l2"></div>
        <div class=" col s12 m4 l8 card-panel z-depth-5">

            <div class="row">
                <div class="col s12 m4 l4"></div>
                <div class="col s12 m4 l4"><h4 class="center-align">Reportes</h4></div>
                <div class="col s12 m4 l4"></div>
            </div>

            <div class="row">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header waves-light waves-effect white-text">Total bautizos de parroquias por año</div>
                        <div class="collapsible-body row">
                            <div class="col s6 border-right">
                                <form id="queryForm" method="POST" action="/crearActa" autocomplete="off">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select name="parroquia" id="parroquia">
                                                <option value="">---</option>
                                                @foreach ($parroquias as $pa)
                                                    <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                                @endforeach
                                            </select>
                                            <label>Seleccione parroquia:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <p>
                                            <input name="bautismo" type="checkbox" id="bautismo"/>
                                            <label for="bautismo">Bautismo</label>
                                        </p>
                                        <p>
                                            <input name="pcomunion" type="checkbox" id="pcomunion"/>
                                            <label for="pcomunion">Primera Comunion</label>
                                        </p>
                                        <p>
                                            <input name="confirma" type="checkbox" id="confirma"/>
                                            <label for="confirma">Confirma</label>
                                        </p>
                                        <p>
                                            <input name="matrimonio" type="checkbox" id="matrimonio"/>
                                            <label for="matrimonio">Matrimonio</label>
                                        </p>
                                        <p>
                                            <input name="defuncion" type="checkbox" id="defuncion"/>
                                            <label for="defuncion">Defuncion</label>
                                        </p>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="fechaInicio" name='fechaInicio'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa"
                                                   size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                            <label for="fechaInicio">Fecha Desde:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaFin" name='fechaFin'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa"
                                                   size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                            <label for="fechaFin">Fecha Hasta:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button id="buscar" class="waves-effect waves-light btn left" type="submit"><i
                                                class="material-icons left">search</i>Buscar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col s6">
                                <h5>Resultado:</h5>
                                <h4 id="resultado"></h4>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header waves-light waves-effect white-text">Total por Fecha del Sacramento</div>
                        <div class="collapsible-body row">
                            <div class="col s6 border-right">
                                <form id="queryFormFecha" method="POST" action="/crearActa" autocomplete="off">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select name="parroquia" id="parroquia_fecha">
                                                <option value="">---</option>
                                                @foreach ($parroquias as $pa)
                                                    <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                                                @endforeach
                                            </select>
                                            <label>Seleccione parroquia:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <p>
                                            <input name="bautismo" type="checkbox" id="bautismo_f"/>
                                            <label for="bautismo_f">Bautismo</label>
                                        </p>
                                        <p>
                                            <input name="pcomunion" type="checkbox" id="pcomunion_f"/>
                                            <label for="pcomunion_f">Primera Comunion</label>
                                        </p>
                                        <p>
                                            <input name="confirma" type="checkbox" id="confirma_f"/>
                                            <label for="confirma_f">Confirma</label>
                                        </p>
                                        <p>
                                            <input name="matrimonio" type="checkbox" id="matrimonio_f"/>
                                            <label for="matrimonio_f">Matrimonio</label>
                                        </p>
                                        <p>
                                            <input name="defuncion" type="checkbox" id="defuncion_f"/>
                                            <label for="defuncion_f">Defuncion</label>
                                        </p>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="fechaInicio_f" name='fechaInicio'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa"
                                                   size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                            <label for="fechaInicio_f">Fecha Desde:</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="fechaFin_f" name='fechaFin'
                                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa"
                                                   size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                                   pattern="^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$"
                                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                                   oninput="setCustomValidity('')">
                                            <label for="fechaFin_f">Fecha Hasta:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button id="buscar_f" class="waves-effect waves-light btn left" type="submit"><i
                                                class="material-icons left">search</i>Buscar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col s6">
                                <h5>Resultado:</h5>
                                <h4 id="resultadoFecha"></h4>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        window.onload = function () {
            var today = new Date();
            today.setDate(today.getDate() + 15);
            $(".datepicker").datepicker({
                maxDate: today, dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"]
            }).val()

            $('select').material_select();

            $('#queryForm').on('submit', function (e) {
                e.preventDefault();
                getData();
            });

            $('#queryFormFecha').on('submit', function (e) {
                e.preventDefault();
                getDataFecha();
            });

            function getData() {
                $.ajax({
                    type: "POST",
                    url: "/queryBautizosAnnio",
                    data: $("#queryForm").serialize(), // serializes the form's elements.
                    success: function (data) {
                        document.getElementById("resultado").innerHTML = "total " + data + " partidas";
                    }
                });
            }

            function getDataFecha() {
                $.ajax({
                    type: "POST",
                    url: "/queryBautizosFechaSacramento",
                    data: $("#queryFormFecha").serialize(), // serializes the form's elements.
                    success: function (data) {
                        document.getElementById("resultadoFecha").innerHTML = "total " + data + " partidas";
                    }
                });
            }
        }

    </script>


@endsection
