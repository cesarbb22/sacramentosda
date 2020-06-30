@extends('layouts.masterPage')

@section('content')
<style type="text/css">
  /*body {
    background-color: #fff3e0;
}*/

#n {
  padding-top:2px;
}

td, th {
    padding: 8px 5px;
    text-align: center;
}
.btn:focus, .btn-large:focus, .btn-floating:focus {
    background-color:#af771f;
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
          <div class="col s12 m4 l3"></div>

          <div class="col s12 m4 l6"><h4 class="center-align">Centro de Notificaciones</h4></div>

          <div class="col s12 m4 l3">
             <div class="row">
                 <br>
                <button id="reload" class="waves-effect waves-light btn right" type="button"><i class="material-icons left">loop</i>Actualizar</button>
            </div>
          </div>
        </div>
<br>
       <table id='miTabla' class="bordered">
        </table>
    </div>
</div>

  <!--Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Descripción de la solicitud</h4>
      <hr>
      <p id='descripcion'></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
    </div>
  </div>


<script type="text/javascript">

    function description(id) {
            $('#descripcion').html( $('#desc'+id).html() );
            $('#modal1').modal('open');
        }

    window.onload = function(e){
        setTimeout(function() {
            $("#reload").trigger('click');
        },1);

        $('.modal').modal();


        $("#reload").click(function() {
            $.ajax({
                type: "POST",
                url: "/obtenerSolicitudesUsuario",
                //data: ", // serializes the form's elements.
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#miTabla').empty();
                    var content = "<thead><tr><th>Tipo de Solicitud</th><th>Remitente</th><th>Parroquia</th><th>Estado</th><th>Detalles</th><th>Ver partida</th><th>Aceptar respuesta</th></tr></thead><tbody>"
                    for(i=0; i<data.length; i++){

                        if (data[i].IDTipo_Solicitud == 3) { // nuevo usuario
                            content += '<tr><td>' + data[i].tipo.NombreTipo_Solicitud + '</td>'
                                    + '<td>' + data[i].user.Nombre + ' '+ data[i].user.PrimerApellido + ' ' + data[i].user.SegundoApellido + '</td>'
                                    + '<td>' + data[i].user.parroquia.NombreParroquia+ '</td>'
                                    + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>'
                                    + '<td><a class="desc" href="#" onClick = "description('+i+');"><i class="material-icons">description</i></a></td>'
                                    + '<td><a class="desc" href="#" disabled><i class="material-icons">description</i></a></td>'
                                    + '<td><a href="/aceptarSolicitud/'+data[i].IDSolicitud+'"><i class="material-icons">done</i></a></td>'
                                    + '<td id="desc'+i+'" hidden></td> </tr>';
                        } else if (data[i].IDTipo_Solicitud == 2) { //editar
                            content += '<tr><td>' + data[i].tipo.NombreTipo_Solicitud + '</td>'
                                    + '<td>' + data[i].user.Nombre + ' '+ data[i].user.PrimerApellido + ' ' + data[i].user.SegundoApellido + '</td>'
                                    + '<td>' + data[i].user.parroquia.NombreParroquia+ '</td>'
                                    + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>'
                                    + '<td><a class="desc" href="#" onClick = "description('+i+');"><i class="material-icons">description</i></a></td>'
                                    + '<td><a class="desc" href="DetalleUsuario/'+data[i].actas[0].IDPersona+'"><i class="material-icons">description</i></a></td>'
                                    + '<td><a href="/aceptarSolicitud/'+data[i].IDSolicitud+'"><i class="material-icons">done</i></a></td>'
                                    + '<td id="desc'+i+'" hidden>'+data[i].actas[0].pivot.Descripcion+'</td> </tr>';
                        } else { // eliminar
                            content += '<tr><td>' + data[i].tipo.NombreTipo_Solicitud + '</td>'
                                + '<td>' + data[i].user.Nombre + ' '+ data[i].user.PrimerApellido + ' ' + data[i].user.SegundoApellido + '</td>'
                                + '<td>' + data[i].user.parroquia.NombreParroquia+ '</td>'
                                + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>'
                                + '<td></td>'
                                + '<td></td>'
                                + '<td><a href="/aceptarSolicitud/'+data[i].IDSolicitud+'"><i class="material-icons">done</i></a></td>';
                        }
                    }
                    content += "</tbody>"

                    $('#miTabla').append(content);
                }
            });
        });
    }
</script>

@endsection
