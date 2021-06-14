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
            <div class="col s12 m4 l4">
                <div class="row">
                    <br>
                    <div class="switch">
                        <label>
                            <strong>Recibidos</strong>
                            <input id="switch-tipo" type="checkbox">
                            <span class="lever"></span>
                            <strong>Enviados</strong>
                        </label>
                    </div>
                </div>
            </div>

          <div class="col s12 m4 l4"><h4 class="center-align">Avisos Sacramentales</h4></div>

          <div class="col s12 m4 l4">
             <div class="row">
                 <br>
                <button id="reload" class="waves-effect waves-light btn right" type="button"><i class="material-icons left">loop</i>Actualizar</button>
            </div>
              <div class="row">
                  <a id="enviarAviso" class="waves-effect waves-light btn modal-trigger right" href="#modalEnviarAviso"><i class="material-icons left">email</i>Enviar Aviso</a>
              </div>
          </div>
        </div>
<br>
       <table id='miTabla' class="bordered">
        </table>
    </div>
</div>

  <!--Modal Descripcion -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Información Adicional</h4>
      <hr>
      <p id='descripcion'></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
    </div>
  </div>


<!--Modal Enviar Aviso -->
<div id="modalEnviarAviso" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Enviar Aviso</h4>
        <hr>
        <form id="enviarAviso" method="POST" action="/buscarCedulaAviso">
            {{ csrf_field() }}
            <br>
            <div class="row">
                <h5>Ingrese el número de identificación de la persona que desea buscar para enviar el aviso:</h5>
            </div>
            <div class="row" style="text-align: center">
                <div class="col s4"></div>
                <div class="input-field col s4">
                    <div class="row">
                        <input id="numCedula" name='numCedula' type="text" class="validate" required
                               oninvalid="this.setCustomValidity('Información requerida')"
                               oninput="setCustomValidity('')">
                        <label for="numCedula">Número de identificación</label>
                    </div>
                    <div class="row">
                        <button id="btnBuscarCed" class="waves-effect waves-light btn">Buscar</button>
                    </div>
                </div>
                <div class="col s4"></div>
            </div>

            <div class="row" style="text-align: center">
                <a id="verActaBtn" class="waves-effect waves-light btn modal-trigger" target="_blank" disabled>Ver Acta</a>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" onclick="closeModalAviso();" class="waves-effect waves-light btn-flat ">Cerrar</a>
    </div>
</div>

<script type="text/javascript">

    function description(id) {
            $('#descripcion').html( $('#desc'+id).html() );
            $('#modal1').modal('open');
        }

    function closeModalAviso() {
        $('#numCedula').val("");
        $('#verActaBtn').attr('disabled', true);
        $('#modalEnviarAviso').modal('close');
    }

    window.onload = function(e){
        $('.modal').modal();

        // funcion buscar cedula
        $('#btnBuscarCed').on('click', function (e) {
            e.preventDefault();
            $('#verActaBtn').attr('disabled', true);

            var numCedula = $('#numCedula').val();
            if (numCedula != null && numCedula != '') {
                $.ajax({
                    type: "POST",
                    url: "/buscarCedulaAvisoAdmin",
                    //data: ", // serializes the form's elements.
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "numCedula": numCedula
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            btn = document.getElementById('verActaBtn');
                            btn.setAttribute("href", "/Detalle/" + data[0].IDPersona);
                            $('#verActaBtn').attr('disabled', false);
                        }
                    }
                });
            }

        });

        $("#switch-tipo").change(function () {
            ajaxCall();
        });

        setTimeout(function() {
            $("#reload").trigger('click');
        },1);

        $("#reload").click(function() {
            ajaxCall();
        });

        function ajaxCall() {
            // enviado -> 4, recibido -> 5
            var isTipoEnviado = $("#switch-tipo").is(':checked');
            var tipo_solicitud = isTipoEnviado ? 4 : 5;

            $.ajax({
                type: "POST",
                url: "/obtenerSolicitudesAdmin",
                //data: ", // serializes the form's elements.
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tipo": tipo_solicitud
                },
                success: function(data) {
                    $('#miTabla').empty();
                    var content = "";
                    content = "<thead><tr><th>Parroquia Remitente</th><th>Fecha de Aviso</th><th>Sacramento</th><th>Estado</th><th>Información Adicional</th><th>Ver partida</th><th>Finalizar</th></tr></thead><tbody>"
                    if (isTipoEnviado) {
                        content = "<thead><tr><th>Parroquia a la que se envia aviso</th><th>Fecha de Aviso</th><th>Sacramento</th><th>Estado</th><th>Información Adicional</th><th>Ver partida</th><th>Finalizar</th></tr></thead><tbody>"
                    }

                    for(i=0; i<data.length; i++){
                        var nombreParroquia = data[i].user.parroquia.NombreParroquia;
                        if (isTipoEnviado) {
                            nombreParroquia = data[i].IDParroquia == -1 ? "Archivo Diocesano de Alajuela" : data[i].parroquia.NombreParroquia;
                        } else {
                            if (data[i].user.IDPuesto < 3) {
                                nombreParroquia = "Archivo Diocesano de Alajuela";
                            }
                        }
                        content += '<tr>'
                            + '<td>' + nombreParroquia + '</td>'
                            + '<td>' + formatDateToString(data[i].Fecha_Solicitud) + '</td>'
                            + '<td>' + data[i].Sacramento + '</td>'
                            + '<td><strong><em>' + data[i].estado.NombreEstado_Solicitud + '</em></strong></td>';
                        if (data[i].Descripcion != null) {
                            content += '<td><a class="desc" href="#" onClick = "description('+i+');"><i class="material-icons">comment</i></a></td>';
                        } else {
                            content += '<td></td>';
                        }
                        content += '<td><a class="desc" target="_blank" href="Detalle/'+data[i].acta.IDPersona+'"><i class="material-icons">description</i></a></td>';
                        if (!isTipoEnviado) {
                            //content += '<td><a href="javascript:DoPost('+data[i].IDSolicitud+')"><i class="material-icons">done</i></a></td>';
                            if (data[i].estado.IDEstado_Solicitud != 4) {
                                content += '<td><a readonly href="/aceptarSolicitudAdmin/'+data[i].IDSolicitud+'"><i class="material-icons">done</i></a></td>';
                            }
                        }
                        content += '<td id="desc'+i+'" hidden>'+data[i].Descripcion+'</td>';
                        content += '</tr>';
                    }
                    content += "</tbody>"

                    $('#miTabla').append(content);
                }
            });
        }
    }

    function formatDateToString(dateString)
    {
        var yyyy = dateString.slice(0, 4);
        var mm = dateString.slice(5, 7);
        var dd = dateString.slice(8, 10);
        return dd + '/' + mm + '/' + yyyy;
    }
</script>

@endsection
