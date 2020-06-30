@extends('layouts.masterPageAdmin')

@section('content')


<div class="row">
    <br>
    @if (Session::has('errorLogin'))
            <div class="col l2"></div>
          <div class="col s12 m8 l8">
            <div class="card-panel red lighten-2 center-align">
              <span class="white-text">{{Session::get('errorLogin')}}</span>
            </div>
          </div>
          <div class="col l2"></div>
    @endif

    @if (Session::has('justLogin'))
            <div class="col l2"></div>
          <div class="col s12 m8 l8">
            <div class="card-panel green darken-3 center-align">
              <span class="white-text">{{Session::get('justLogin')}}</span>
            </div>
          </div>
          <div class="col l2"></div>
    @endif

      <div class="col m3 l4"></div>
      <div class="col s12 m3 l4">
        <div class="card-panel z-depth-4">

            <h3 class="center-align">Iniciar Sesión</h3>
          <br>
          <form class="form-horizontal" role="form" method="POST" action="/login">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

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
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="waves-effect waves-light btn">
                                    Login
                                </button>

                                <a class="btn-link right" href="{{ url('emailRecuperacion') }}">
                                    ¿Olvidó su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>

        </div>
      </div>
      <div class="col m3 l4"></div>
</div>
@endsection
