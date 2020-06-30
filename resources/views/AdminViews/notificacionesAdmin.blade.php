@extends('layouts.masterPageAdmin')

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


</style>

 <div id='n' class="row">
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
        var content = "<thead><tr><th>Tipo de Solicitud</th><th>Remitente</th><th>Parroquia</th><th>Estado</th><th>Detalles</th><th>Ver Partida</th><th>Aceptar</th><th>Rechazar</th></tr></thead><tbody>";
        content += "</tbody>"
        $('#miTabla').append(content);

        setTimeout(function() {
            $("#reload").trigger('click');
        },1);

        $('.modal').modal();


        $("#reload").click(function() {
            $.ajax({
                type: "POST",
                url: "/obtenerSolicitudes",
                //data: ", // serializes the form's elements.
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#miTabla').empty();
                    var content = "<thead><tr><th>Tipo de Solicitud</th><th>Remitente</th><th>Parroquia</th><th>Estado</th><th>Detalles</th><th>Ver Partida</th><th>Aceptar</th><th>Rechazar</th></tr></thead><tbody>"
                    for(i=0; i<data.length; i++){

                        if (data[i].IDTipo_Solicitud == 3) { // Nuevo Usuario
                            content += '<tr><td>' + data[i].tipo.NombreTipo_Solicitud + '</td>'
                                + '<td>' + data[i].user.Nombre + ' ' + data[i].user.PrimerApellido + ' ' + data[i].user.SegundoApellido + '</td>'
                                + '<td>' + data[i].user.parroquia.NombreParroquia + '</td>'
                                + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>'
                                + '<td></td>'
                                + '<td></td>'
                                + '<td><a href="/solicitudAceptadaAdmin/' + data[i].IDSolicitud + '"><i class="material-icons">done</i></a></td>'
                                + '<td><a href="/solicitudRechazadaAdmin/' + data[i].IDSolicitud + '"><i class="material-icons">shuffle</i></a></td> </tr>'
                                + '<td id="desc' + i + '" hidden></td> </tr>';
                        } else if (data[i].IDTipo_Solicitud == 2) { // Editar
                            content += '<tr><td>' + data[i].tipo.NombreTipo_Solicitud + '</td>'
                                + '<td>' + data[i].user.Nombre + ' '+ data[i].user.PrimerApellido + ' ' + data[i].user.SegundoApellido + '</td>'
                                + '<td>' + data[i].user.parroquia.NombreParroquia+ '</td>'
                                + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>'
                                + '<td><a class="desc" href="#" onClick = "description('+i+');"><i class="material-icons">description</i></a></td>'
                                + '<td><a class="desc" href="/Detalle'+data[i].actas[0].IDPersona+'"><i class="material-icons">description</i></a><</td>'
                                + '<td><a href="/Editar/notificaciones/'+data[i].IDSolicitud+'"><i class="material-icons">done</i></a></td>'
                                + '<td><a href="/solicitudRechazadaAdmin/'+data[i].IDSolicitud+'"><i class="material-icons">shuffle</i></a></td> </tr>'
                                + '<td id="desc'+i+'" hidden>'+data[i].actas[0].pivot.Descripcion+'</td> </tr>';
                        } else { // Eliminar
                            content += '<tr><td>' + data[i].tipo.NombreTipo_Solicitud + '</td>'
                                    + '<td>' + data[i].user.Nombre + ' '+ data[i].user.PrimerApellido + ' ' + data[i].user.SegundoApellido + '</td>'
                                    + '<td>' + data[i].user.parroquia.NombreParroquia+ '</td>'
                                    + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>'
                                    + '<td><a class="desc" href="#" onClick = "description('+i+');"><i class="material-icons">description</i></a></td>'
                                    + '<td><a class="desc" href="/Detalle'+data[i].actas[0].IDPersona+'"><i class="material-icons">description</i></a></td>'
                                    + '<td><a href="/solicitudAceptadaAdmin/'+data[i].IDSolicitud+'"><i class="material-icons">done</i></a></td>'
                                    + '<td><a href="/solicitudRechazadaAdmin/'+data[i].IDSolicitud+'"><i class="material-icons">shuffle</i></a></td> </tr>'
                                    + '<td id="desc'+i+'" hidden>'+data[i].actas[0].pivot.Descripcion+'</td> </tr>';
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
