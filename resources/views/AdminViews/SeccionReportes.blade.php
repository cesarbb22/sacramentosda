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
                                                <option value="otro">Otro</option>
                                            </select>
                                            <label>Seleccione parroquia de bautizo:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="annio" name="annio" type="text">
                                            <label for="annio">Ingrese el año de búsqueda</label>
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
                </ul>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        window.onload = function () {
            $('select').material_select();

            $('#queryForm').on('submit', function (e) {
                e.preventDefault();
                getData();
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
        }

    </script>


@endsection
