@extends('layouts.masterPageAdmin')

@section('content')

    <style type="text/css">

        td, th {
            padding: 8px 5px;
            text-align: center;
        }

    </style>

    <div class="row" style="padding-left:1em;padding-right:1em">
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

        <div class="col s12 m4 l3 card-panel z-depth-2">

            <form id="queryForm" method="POST" autocomplete="off">
                {{ csrf_field() }}

                <div class="row align-center"><h5>Criterios de búsqueda</h5></div>

                <div class="row">

                    <div class="col s12">
                        <p>
                            <input name="buscCed" type="checkbox" id="buscCed"/>
                            <label for="buscCed">Buscar por cédula</label>
                        </p>
                    </div>
                    <div class="input-field col s12">
                        <input placeholder="Número de Cédula" id="numCed" type="text" required name="numCed" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input name='nombre' id="nombre" type="text" class="validate">
                        <label for="nombre">Nombre:</label>
                    </div>

                    <div class="input-field col s12">
                        <select name="parroquia" id="parroquia">
                            <option value="">---</option>
                            @foreach ($parroquias as $pa)
                                <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                            @endforeach
                            <option value="otro">Otro</option>
                        </select>
                        <label>Parroquia Bautismo:</label>
                    </div>

                    <div class="row" id="lugarDiv">
                        <div class="input-field col s12">
                            <input id="lugar" name="lugar" type="text" required>
                            <label for="lugar"> Bautizado en:</label>
                        </div>
                    </div>

                    <div class="col s12">
                        <div class="input-field col s12">
                            <input id="fechaInicio" name='fechaInicio'
                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                   oninput="setCustomValidity('')">
                            <label for="fechaInicio">Fecha Nacimiento (Desde):</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="fechaFin" name='fechaFin'
                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa" size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                   oninput="setCustomValidity('')">
                            <label for="fechaFin">Fecha Nacimiento (Hasta):</label>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <button id="buscar" class="waves-effect waves-light btn right" type="submit"><i
                                class="material-icons left">search</i>Buscar
                    </button>
                </div>
            </form>

        </div>


        <div class="col s12 m4 l9 card-panel z-depth-2">


            <table id='tablaConsulta' class="bordered">
                <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre Completo</th>
                    <th>Lugar de Bautismo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Detalle</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">

        window.onload = function () {
            $(".datepicker").datepicker({ maxDate: new Date(), dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ]
            }).val()

            $('select').material_select();

            $("#buscCed").change(function () {
                if ($("#buscCed").is(':checked')) {
                    $("#numCed").prop('disabled', false);
                    $("#nombre").prop('disabled', true);
                    $("#parroquia").prop('disabled', true);
                    $("#fechaInicio").prop('disabled', true);
                    $("#fechaFin").prop('disabled', true);

                    $('select').material_select();
                } else {
                    $('#queryForm').trigger("reset");
                    $("#numCed").prop('disabled', true);
                    $("#nombre").prop('disabled', false);
                    $("#parroquia").prop('disabled', false);
                    $("#fechaInicio").prop('disabled', false);
                    $("#fechaFin").prop('disabled', false);

                    $('select').material_select();
                }
            });

            $("#lugarDiv").css("display", "none");
            $("#lugar").prop('disabled', true);
            $("#parroquia").change(function () {
                var valor = $("#parroquia").val();
                if (valor === "otro") {
                    $("#lugar").prop('required', true);
                    $("#lugar").prop('disabled', false);
                    $("#lugarDiv").css("display", "block");
                    $("#lugar").val("");
                } else {
                    $("#lugar").prop('required', false);
                    $("#lugar").prop('disabled', true);
                    $("#lugarDiv").css("display", "none");
                    $("#lugar").val("");
                }
            });

            $('#queryForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/queryPersonas",
                    data: $("#queryForm").serialize(), // serializes the form's elements.
                    success: function (data) {
                        $("#tablaConsulta td").parent().remove();

                        console.log(data);
                        var len = data.length;
                        for (var i = 0; i < len; i++) {
                            var idPersona = data[i].IDPersona;
                            var cedula = data[i].persona.Cedula;
                            var nombre = data[i].persona.Nombre;
                            var primerApellido = data[i].persona.PrimerApellido;
                            var segundoApellido = data[i].persona.SegundoApellido;

                            var lugarBautismo = null;
                            if (data[i].bautismo !== null && data[i].bautismo.IDParroquiaBautismo !== null) {
                                lugarBautismo = $("#parroquia").find(":selected").text();
                            } else if (data[i].bautismo !== null) {
                                lugarBautismo = data[i].bautismo.LugarBautismo;
                            }

                            var fechaNacimiento = formatDateToString(data[i].persona.laico.FechaNacimiento);

                            var iconDetalle = "<i class='material-icons'>description</i>";
                            var detalle = "<a id='" + idPersona + "Detalle'>" + iconDetalle + "</a>";

                            var iconEditar = "<i class='material-icons'>mode_edit</i>";
                            var editar = "<a id='" + idPersona + "Editar'>" + iconEditar + "</a>";

                            var iconEliminar = "<i class='material-icons'>delete</i>";
                            var eliminar = "<a id='" + idPersona + "Eliminar'>" + iconEliminar + "</a>";

                            $('#tablaConsulta tbody').append('<tr><td>' + cedula + '</td><td>' + nombre + ' ' + primerApellido + ' ' + segundoApellido + '</td>' +
                                '<td>' + lugarBautismo + '</td><td>' + fechaNacimiento + '</td><td>' + detalle + '</td><td>' + editar + '</td><td>' + eliminar + '</td><td id hidden>' + idPersona + '</td></tr>');


                            document.getElementById(idPersona + "Editar").setAttribute('href', window.location.origin + '/Editar/' + idPersona);
                            document.getElementById(idPersona + "Eliminar").setAttribute('href', window.location.origin + '/Eliminar' + idPersona);
                            document.getElementById(idPersona + "Detalle").setAttribute('href', window.location.origin + '/Detalle/' + idPersona);


                        }
                    }
                });
            });
        };

        function formatDateToString(dateString)
        {
            var yyyy = dateString.slice(0, 4);
            var mm = dateString.slice(5, 7);
            var dd = dateString.slice(8, 10);
            return dd + '/' + mm + '/' + yyyy;
        }
    </script>

@endsection
