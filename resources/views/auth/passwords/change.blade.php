@extends('layouts.masterPageAdmin')

@section('content')

    <div class="row">
        <br>
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
    
         <div class="col m3 l3"></div>
          <div class="col s16 m3 l6">
        <div class="card-panel z-depth-5">
            
            <h3 class="center-align">Cambiar contraseña</h3>
                <br>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="/guardarContrasena">
                        {{ csrf_field() }}

                        <div class="input-field {{ $errors->has('mypassword') ? ' has-error' : '' }}">
                            <label for="mypassword" >Contraseña actual</label>
                            <input id="mypassword" type="password" class="validate" name="mypassword" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Nueva contraseña</label>
                            <input id="password" type="password" class="validate" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="input-field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="row">
                            <br>
                            <button class="waves-effect waves-light btn right" type="submit"><i class="material-icons left">save</i>Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
