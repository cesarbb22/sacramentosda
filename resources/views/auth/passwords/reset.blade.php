@extends('layouts.masterPageAdmin')

@section('content')

<link type="text/css" rel="stylesheet" href="css/masterPage.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">

<style> 
            nav {
                background-image: url("style/img/head.jpeg");
                background-position:  center center;
                background-repeat: no-repeat;
                background-size: 100% 65px;
                background-color: #51091C;
                /*height:130px;*/
            }
            
            #footer, .btn, .collapsible-header {
                background-color: #51091C;
            }
            
            #tamanoFooter { height: 50px; }
            
            .btn:hover {
                background-color: #840f2d; 
            }
            
            .dropdown-content li > a, .dropdown-content li > span {
              color: #840f2d;
            }
            
            #tablaConsulta td .material-icons {
              color: #840f2d;
            }
            
            .nav-wrapper li > a:hover {
              color: #EDB35B;
              font-weight: bold;
              font-size: 120%;
            }
            
            [type="radio"]:checked + label:before,
            [type="radio"]:checked + label:after {
              border: 2px solid #840f2d;
              background-color: #840f2d;
            }
            
            input:not([type]):focus:not([readonly]), input[type=password]:focus:not([readonly]), input[type=email]:focus:not([readonly]) {
              border-bottom: 1px solid #51091C;
              box-shadow: 0 1px 0 0 #51091C;
            }
            
            input:not([type]):focus:not([readonly]), input[type=text]:focus:not([readonly]), input[type=password]:focus:not([readonly]), input[type=email]:focus:not([readonly]), input[type=date]:focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly]) {
              border-bottom: 1px solid #51091C;
              box-shadow: 0 1px 0 0 #51091C;
            }
            
            input:not([type]):focus:not([readonly]) + label, input[type=text]:focus:not([readonly]) + label, input[type=password]:focus:not([readonly]) + label, input[type=email]:focus:not([readonly]) + label, input[type=date]:focus:not([readonly]) + label, textarea.materialize-textarea:focus:not([readonly]) + label {
              color: #51091C;
            }

            [type="checkbox"]:checked + label:before {
              border-right: 2px solid #51091C;
              border-bottom: 2px solid #51091C;
            }
            
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
                background-color: #f9f3e3;
            }
            
            main {
                flex: 1 0 auto;
            }
        </style>

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

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        
                         <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <br>
                            <button type="submit" class="waves-effect waves-light btn right">
                                Restablecer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>

@endsection
