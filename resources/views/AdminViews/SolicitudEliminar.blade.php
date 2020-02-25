@extends('layouts.masterPageAdmin')

@section('content')
<style type="text/css">
#n {
  padding-top:5px;
}

</style>

<div id='n' class="row">
    <div class="col s12 m4 l2"></div>
    <div class=" col s12 m4 l8 card-panel z-depth-5">

        <div class="row">
          <div class="col s12 m4 l4"></div>

          <div class="col s12 m4 l4"><h4 class="center-align">Solicitud Eliminar</h4></div>

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

<form id="formSolicitudEli" method="POST" action="/crearSolicitudEliminar">
          {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s4">
                 <input id="nombre" name='nombre' type="text" class="validate" required>
                  <label for="nombree">Nombre completo del solicitante:</label>
                 </div>

                <div class="input-field col s3">
                 <select name="parroquia" id="parroquias">
                     <option value="">---</option>
                  @foreach ($parroquias as $pa)
                    <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                  @endforeach
                 </select>
                     <label>Seleccione la Parroquia:</label>
                </div>

       </div>

            <div class="row">
                <div class="input-field col s8">
                  <input id="email" name='email' type="text" class="validate" required>
                  <label for="emaill">Correo Electrónico :</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                  <textarea id="descripcion" name="descripcion" class="materialize-textarea"></textarea>
                  <label for="descripcion">Motivo para solicitar eliminar partida:</label>
                </div>
           </div>
        <div class="row"></br></br></div>
        <div class="row">
                <button id="guardarActa" class="waves-effect waves-light btn right" type="submit"><i class="material-icons left">save</i>Guardar</button>
            </div>

    </form>
     </div>
     <div class="col s12 m4 l2"></div>
    </div>


@endsection
