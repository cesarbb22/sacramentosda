@extends('layouts.masterPage')

@section('content')

<style type="text/css">

td, th {
    padding: 8px 5px;
    text-align: center;
}

  .btn:focus, .btn-large:focus, .btn-floating:focus {
    background-color:#af771f;
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

        <div class="col s12 m4 l3 card-panel z-depth-2" >

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
                        <input placeholder="Número de Cédula" id="numCed" type="text" class="validate" minlength="9" maxlength="9" required oninvalid="this.setCustomValidity('Debe ingresar cedula con el formato: 101230456')"
    oninput="setCustomValidity('')" name="numCed" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input name='nombre' id="nombre" type="text" class="validate">
                        <label for="nombre">Nombre:</label>
                    </div>

                    <div class="input-field col s12">
                  <select name="parroquia" id="parroquias">
                      <option value="">---</option>
                    @foreach ($parroquias as $pa)
                      <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                    @endforeach
                  </select>
                  <label>Seleccione la Parroquia:</label>
                </div>

                <div class="col s12">
                    <div class="input-field col s12">
                        <input id="fechaInicio" name="fechaInicio" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" class="datepicker" type="date" title="Formato de fecha: dd/mm/aaaa">
                        <label for="fechaInicio">Desde:</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="fechaFin" name="fechaFin" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" class="datepicker" type="date" title="Formato de fecha: dd/mm/aaaa">
                        <label for="fechaFin">Hasta:</label>
                    </div>
                </div>


                </div>

                <div class="row">
                <button id="buscar" class="waves-effect waves-light btn right" type="submit"><i class="material-icons left">search</i>Buscar</button>
            </div>
            </form>

            </div>


    <div class="col s12 m4 l9 card-panel z-depth-2">


        <table id='tablaConsulta' class="bordered">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Detalle</th>
                    <th>Solicitar edición</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
      <form id="editarForm" class="col s12" method="POST">
          {{ csrf_field() }}
    <div class="modal-content">
      <h4>Describa el cambio que desea solicitar y el motivo. Además, agregue información que considere necesaria</h4>
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
      <h4>Escriba el motivo y descripción de la solicitud, además de la información que considere necesaria</h4>
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
        $('#idPersona').val( id );
        $('#modal1').modal('open');
    }

    function setIdEliminar(id) {
        $('#idPersona2').val( id );
        $('#modal2').modal('open');
    }

    window.onload = function() {
        $('.datepicker').pickadate({
            format: 'dd/mm/yyyy',
            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
            selectMonths: true,
            selectYears: 300, // Puedes cambiarlo para mostrar más o menos años
            today: 'Hoy',
            clear: 'Limpiar',
            close: 'Ok',
            labelMonthNext: 'Siguiente mes',
            labelMonthPrev: 'Mes anterior',
            labelMonthSelect: 'Selecciona un mes',
            labelYearSelect: 'Selecciona un año',
            max: new Date(),
            autoClose: true,
            setDefaultDate: true,
            defaultDate: new Date()
        });

        $('select').material_select();
        $('.modal').modal();
        $('input#input_text, textarea#textarea1').characterCounter();
        $('input#input_text, textarea#textarea2').characterCounter();

        $("#buscCed").change(function() {
        if($("#buscCed").is(':checked')) {
            $("#numCed").prop('disabled', false);
            $("#nombre").prop('disabled', true);
            $("#parroquias").prop('disabled', true);
            $("#fechaInicio").prop('disabled', true);
            $("#fechaFin").prop('disabled', true);

            $('select').material_select();
        } else {
            $('#queryForm').trigger("reset");
            $("#numCed").prop('disabled', true);
            $("#nombre").prop('disabled', false);
            $("#parroquias").prop('disabled', false);
            $("#fechaInicio").prop('disabled', false);
            $("#fechaFin").prop('disabled', false);

            $('select').material_select();
        }
    });


    $('#editarForm').on('submit' ,function(e){
            e.preventDefault();

        $.ajax({
                type: "POST",
                url: "/EditarUsuario",
                data: {"descripcion" : $('#textarea1').val(), "idPersona" : $('#idPersona').val(), "_token": "{{ csrf_token() }}"}, // serializes the form's elements.
                success: function(data) {
                    window.location.replace(window.location.origin + '/consulta');
                }
            });
    });


    $('#eliminarForm').on('submit' ,function(e){
            e.preventDefault();

        $.ajax({
                type: "POST",
                url: "/EliminarUsuario",
                data: {"descripcion" : $('#textarea2').val(), "idPersona" : $('#idPersona2').val(), "_token": "{{ csrf_token() }}"}, // serializes the form's elements.
                success: function(data) {
                    window.location.replace(window.location.origin + '/consulta');
                }
            });
    });


        $('#queryForm').on('submit' ,function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/queryPersonasUsuario",
                data: $("#queryForm").serialize(), // serializes the form's elements.
                success: function(data) {
                    $("#tablaConsulta td").parent().remove();

                    var len = data.length;
                    for (var i = 0; i < len; i++) {
                        var idPersona = data[i].IDPersona;
                        var cedula = data[i].persona.Cedula;
                        var nombre  = data[i].persona.Nombre;
                        var primerApellido = data[i].persona.PrimerApellido;
                        var segundoApellido = data[i].persona.SegundoApellido;

                        var iconDetalle = "<i class='material-icons'>description</i>";
                        var detalle = "<a id='"+idPersona+"Detalle'>"+iconDetalle+"</a>";

                        var iconEditar = "<i class='material-icons'>mode_edit</i>";
                        var editar = "<a id='"+idPersona+"Editar' href='#' onClick='setIdEditar("+idPersona+");'>"+iconEditar+"</a>";

                        var iconEliminar = "<i class='material-icons'>delete</i>";
                        var eliminar = "<a id='"+idPersona+"Eliminar' href='#' onClick='setIdEliminar("+idPersona+");'>"+iconEliminar+"</a>";

                        $('#tablaConsulta tbody').append('<tr><td>'+cedula+'</td><td>'+nombre+'</td><td>'+primerApellido+'</td><td>'
                        +segundoApellido+'</td><td>'+detalle+'</td><td>'+editar+'</td><td>'+eliminar+'</td><td id hidden>'+idPersona+'</td></tr>');


                       // document.getElementById(idPersona + "Eliminar").setAttribute('href', window.location.origin + '/EliminarUsuario/' + idPersona);
                         document.getElementById(idPersona + "Detalle").setAttribute('href', window.location.origin + '/DetalleUsuario/'+ idPersona );

                       //window.location.origin + '/EditarUsuario/' + idPersona


                    }
                }
            });
        });
    };
</script>

@endsection
