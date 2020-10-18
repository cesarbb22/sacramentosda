@extends('layouts.masterPageAdmin')

@section('content')


<div class="row">
<br>

@if (Session::has('errorEmail'))
            <div class="col l2"></div>
          <div class="col s12 m8 l8">
            <div class="card-panel red lighten-2 center-align">
              <span class="white-text">{{Session::get('errorEmail')}}</span>
            </div>
          </div>
          <div class="col 10"></div>
    @endif

@if (Session::has('errorRegister'))
            <div class="col l2"></div>
          <div class="col s12 m8 l8">
            <div class="card-panel red lighten-2 center-align">
              <span class="white-text">{{Session::get('errorRegister')}}</span>
            </div>
          </div>
          <div class="col l2"></div>
    @endif

      <div class="col m2 l3"></div>
      <div class="col s12 m8 l6">
        <div class="card-panel z-depth-4">

            <h3 class="center-align">Registrarse</h3>
          <br>
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre   *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Primer Apellido *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="pApellido" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Segundo Apellido *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="sApellido" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="input-field">
                  <select name='parroquia'>
                    @foreach ($parroquias as $pa)
                      <option value="{{ $pa->IDParroquia }}">{{ $pa->NombreParroquia }}</option>
                    @endforeach
                  </select>
                  <label>Seleccione la Parroquia:</label>
                </div>

                <div class="input-field">
                  <select name='puesto'>
                    @foreach ($puesto as $pu)
                      <option value="{{ $pu->IDPuesto }}">{{ $pu->NombrePuesto }}</option>
                    @endforeach
                  </select>
                  <label>Seleccione su puesto:</label>
                </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico *</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control validate" name="email" value="{{ old('email') }}" required
                                       oninvalid="this.setCustomValidity('Correo electrónico con formato inválido')"
                                       oninput="setCustomValidity('')">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cel" class="col-md-4 control-label">Número de celular:</label>

                            <div class="col-md-6">
                                <input id="cel" type="text" class="form-control validate" name="numCel"
                                       pattern="^\d{8}$" minlength="8" maxlength="8"
                                       oninvalid="this.setCustomValidity('Debe ingresar número de celular con 8 dígitos')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña *</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        </br>
                        <div class=row>

                        <div class="form-group">
                            <div class="col l8">
                                <button id ='btnFake' type="button" class="waves-effect waves-light btn">
                                    Registrar
                                </button>
                                <button id ='btnForm' type="submit" hidden>

                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col l4 control-label">* Campos obligatorios</label>
                        </div>

                        </div>
                    </form>

        </div>
      </div>
      <div class="col m2 l3"></div>
</div>

<script>

  window.onload = function() {
    $('select').material_select();


    $("#btnFake").click(function(){
        var pass1 = $('#password').val();
        var pass2 = $('#password-confirm').val();

        if (pass1 == pass2) {
            $("#btnForm").click();
        } else {
            Materialize.toast('Las contraseñas deben coincidir!', 5000) // 4000 is the duration of the toast
        }
    });


}

</script>

@endsection
