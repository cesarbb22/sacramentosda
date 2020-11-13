@extends('layouts.masterPage')

@section('content')

    <style type="text/css">

        td, th {
            padding: 8px 5px;
            text-align: center;
        }

        .btn:focus, .btn-large:focus, .btn-floating:focus {
            background-color: #af771f;
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

            <form id="queryForm" method="POST">
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
                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa"
                                   size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
                                   pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$"
                                   oninvalid="this.setCustomValidity('Debe ingresar fecha con el formato: dd/mm/yyyy')"
                                   oninput="setCustomValidity('')">
                            <label for="fechaInicio">Fecha Nacimiento (Desde):</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="fechaFin" name='fechaFin'
                                   class="datepicker validate" type="text" title="Formato de fecha: dd/mm/aaaa"
                                   size="10" placeholder="dd/mm/aaaa" minlength="10" maxlength="10"
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
                    <th>Nombre</th>
                    <th>Lugar de Bautismo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Detalle</th>
                    <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div style="text-align: center">
                <ul class="pagination">
                </ul>
            </div>
        </div>
    </div>


    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
        <form id="editarForm" class="col s12" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <h4>Describa el cambio que desea solicitar y el motivo. Además, agregue información que considere
                    necesaria</h4>
                <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea" data-length="300" required></textarea>
                </div>
                <div class="input-field col s12">
                    <input id="idPersona" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button type="submit" class="modal-action waves-effect waves-green btn-flat ">Aceptar</button>
            </div>
        </form>
    </div>



    <!-- Modal Structure -->
    <div id="modal2" class="modal modal-fixed-footer">
        <form id="eliminarForm" class="col s12" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <h4>Escriba el motivo y descripción de la solicitud, además de la información que considere
                    necesaria</h4>
                <div class="input-field col s12">
                    <textarea id="textarea2" class="materialize-textarea" data-length="300" required></textarea>
                </div>
                <div class="input-field col s12">
                    <input id="idPersona2" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button type="submit" class="modal-action waves-effect waves-green btn-flat ">Aceptar</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function setIdEditar(id) {
            $('#idPersona').val(id);
            $('#modal1').modal('open');
        }

        function setIdEliminar(id) {
            $('#idPersona2').val(id);
            $('#modal2').modal('open');
        }

        window.onload = function () {
            $(".datepicker").datepicker({ maxDate: new Date(), dateFormat: "dd/mm/yy", autoSize: true,
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ]
            }).val()

            $('select').material_select();
            $('.modal').modal();
            $('input#input_text, textarea#textarea1').characterCounter();
            $('input#input_text, textarea#textarea2').characterCounter();

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

            $('#editarForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/EditarUsuario",
                    data: {
                        "descripcion": $('#textarea1').val(),
                        "idPersona": $('#idPersona').val(),
                        "_token": "{{ csrf_token() }}"
                    }, // serializes the form's elements.
                    success: function (data) {
                        window.location.replace(window.location.origin + '/consulta');
                    }
                });
            });


            $('#eliminarForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/EliminarUsuario",
                    data: {
                        "descripcion": $('#textarea2').val(),
                        "idPersona": $('#idPersona2').val(),
                        "_token": "{{ csrf_token() }}"
                    }, // serializes the form's elements.
                    success: function (data) {
                        window.location.replace(window.location.origin + '/consulta');
                    }
                });
            });

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            });

            $('#queryForm').on('submit', function (e) {
                e.preventDefault();
                getData(1);
            });

            function getData(page) {
                $.ajax({
                    type: "POST",
                    url: "/queryPersonasUsuario?page=" + page,
                    data: $("#queryForm").serialize(), // serializes the form's elements.
                    success: function (data) {
                        $("#tablaConsulta td").parent().remove();

                        var len = data.data.length;
                        for (var i = 0; i < len; i++) {
                            idPersona = data.data[i].IDPersona;
                            cedula = data.data[i].persona.Cedula != null ? data.data[i].persona.Cedula : "---";
                            nombre = data.data[i].persona.Nombre != null ? data.data[i].persona.Nombre : "";
                            primerApellido = data.data[i].persona.PrimerApellido != null ? data.data[i].persona.PrimerApellido : "";
                            segundoApellido = data.data[i].persona.SegundoApellido != null ? data.data[i].persona.SegundoApellido : "";

                            var lugarBautismo = "---";
                            if (data.data[i].bautismo !== null && data.data[i].bautismo.parroquia !== null) {
                                lugarBautismo = data.data[i].bautismo.parroquia.NombreParroquia;
                            } else if (data.data[i].bautismo !== null) {
                                lugarBautismo = data.data[i].bautismo.LugarBautismo;
                            }

                            var fechaNacimiento = '---';
                            if (data.data[i].persona.laico.FechaNacimiento !== null) {
                                fechaNacimiento = formatDateToString(data.data[i].persona.laico.FechaNacimiento);
                            }

                            var iconDetalle = "<i class='material-icons'>description</i>";
                            var detalle = "<a id='" + idPersona + "Detalle'>" + iconDetalle + "</a>";

                            var iconEditar = "<i class='material-icons'>mode_edit</i>";
                            var editar = "<a id='" + idPersona + "Editar'>" + iconEditar + "</a>";

                            $('#tablaConsulta tbody').append('<tr><td>' + cedula + '</td><td>' + nombre + ' ' + primerApellido + ' ' + segundoApellido + '</td>' +
                                '<td>' + lugarBautismo + '</td><td>' + fechaNacimiento + '</td><td>' + detalle + '</td><td>' + editar + '</td><td id hidden>' + idPersona + '</td></tr>');



                            document.getElementById(idPersona + "Editar").setAttribute('href', window.location.origin + '/EditarUsuario/' + idPersona);
                            document.getElementById(idPersona + "Detalle").setAttribute('href', window.location.origin + '/DetalleUsuario/' + idPersona);
                        }

                        // pagination
                        var from = data.from;
                        var last = data.last_page;
                        $(".pagination").empty();
                        if (from == data.current_page) {
                            $(".pagination").append("<li class='disabled'><a href='#!'><i class='material-icons'>chevron_left</i></a></li>");
                        } else {
                            $(".pagination").append("<li class='waves-effect'><a href='"+ data.prev_page_url +"'><i class='material-icons'>chevron_left</i></a></li>");
                        }
                        for (var i = 1; i <= last; i++) {

                            if (i == data.current_page) {
                                $(".pagination").append("<li class='active'><a href='http://127.0.0.1:8000/queryPersonas?page="+ i +"'>"+ i +"</a></li>");
                            } else {
                                $(".pagination").append("<li class='waves-effect'><a href='http://127.0.0.1:8000/queryPersonas?page="+ i +"'>"+ i +"</a></li>");
                            }
                        }
                        if (last == data.current_page) {
                            $(".pagination").append("<li class='disabled'><a href='#!'><i class='material-icons'>chevron_right</i></a></li>");
                        } else {
                            $(".pagination").append("<li class='waves-effect'><a href='"+ data.next_page_url +"'><i class='material-icons'>chevron_right</i></a></li>");
                        }
                    }
                });
            }
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
