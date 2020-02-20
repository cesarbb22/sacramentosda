@extends('layouts.masterPageAdmin')

@section('content')
    <div class="row">
        <br>
         <div class="col m3 l3"></div>
         <div class="col s16 m3 l6">
        <div class="card-panel z-depth-5">
            
            <h3 class="center-align">Restablecer contraseña</h3>
                <br>
        
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Correo electrónico</label>
                            <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="row">
                            <br>
                            <button type="submit" class="waves-effect waves-light btn right">
                                Enviar Link
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
