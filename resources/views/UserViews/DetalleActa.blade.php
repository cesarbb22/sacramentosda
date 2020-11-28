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
                            <span class="p-creado-por">Creado por: {{ $nomParroquiaBauRegistra }}</span>
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
                        <span class="p-creado-por">Creado por: {{ $nomParroquiaConfRegistra }}</span>
                    </div>
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
                        <span class="p-creado-por">Creado por: {{ $nomParroquiaMatRegistra }}</span>
                    </div>
                    <br>
                @else
                    <div class="row">
                        <div class="input-field col s6">
                            <p>No cuenta con esta partida</p>
                        </div>

                    </div>

                @endif


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
                        <span class="p-creado-por">Creado por: {{ $nomParroquiaDefRegistra }}</span>
                    </div>
                    <br>

                @else
                    <div class="row">
                        <div class="input-field col s6">
                            <p>No cuenta con esta partida</p>
                        </div>

                    </div>
                @endif


                <div class="row"><br><br></div>

                <div class="row">
                    <button id="Descargar" class="waves-effect waves-light btn right modal-trigger" data-target="modalPDFDetalle"><i
                            class="material-icons left">file_download</i>Descargar Constancia
                    </button>
                </div>
            </div>

            <input type="hidden" name="IDPersona" id="IDPersona" value="{{ $persona->IDPersona }}"/>
        </form>
    </div>
    <div class="col s12 m4 l2"></div>


    <!-- Modal Structure -->
    <div id="modalPDFDetalle" class="modal modal-fixed-footer">
        <form id="pdfForm" method="POST" action="/pdf">
            {{ csrf_field() }}
            <div class="modal-content">
                <div>
                    <h4>Descargar Constancia</h4>
                </div>
                <div class="input-field">
                    <input id="codigo" name="codigo" placeholder="Código de referencia" required
                           oninvalid="this.setCustomValidity('Campo requerido')"
                           oninput="setCustomValidity('')">
                </div>
                <br>
                <div class="input-field">
                    <select name="motivo" id="motivo" required>
                        <option value="0" selected>--</option>
                        <option value="1">Personales</option>
                        <option value="2">Padrino de Bautizo</option>
                        <option value="3">Madrina de Bautizo</option>
                        <option value="4">Padrino de Confirma</option>
                        <option value="5">Madrina de Confirma</option>
                        <option value="6">Matrimonio</option>
                        <option value="7">Segundas Nupcias</option>
                    </select>
                    <label>Seleccione el motivo de la constancia:</label>
                </div>
                <div class="input-field">
                    <input id="idActa" name="idActa" value="{{ $acta->IDActa }}" type="text" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalCancelBtn" onclick="closeModal();" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                <button id="modalDescargarBtn" type="submit" class="modal-action waves-effect waves-green btn-flat ">Descargar</button>
            </div>
            <div id="loadingDiv" class="progress">
                <div class="indeterminate"></div>
            </div>
        </form>
    </div>

    <script>
        function closeModal() {
            $('.modal').modal('close');
            $('#codigo').val('');
        }

        window.onload = function () {
            $('#loadingDiv').hide();

            $('#detalleForm').on('submit', function (e) {
                e.preventDefault();
            });

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
