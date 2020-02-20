@extends('layouts.masterPageAdmin')

@section('content')
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
    <div class="col s12 m4 l8 card-panel z-depth-2">

        <div class="row">
          <div class="col s12 m4 l2"></div>
          <div class="col s12 m4 l8"><h4 class="center-align">Mantenimiento Usuarios</h4></div>
          <div class="col s12 m4 l2"></div>
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
        
      <form method="POST" action="/">
            
          {{ csrf_field() }}

      
        <table id='tablaConsulta' class="bordered centered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Segundo apellido</th>
                    <th>Email</th>
                    <th>Editar</th>

                </tr>
            </thead>
            
            @foreach($usuarios as $usuario)
                <tbody>
                    <td>{{$usuario->Nombre}}</td>
                    <td>{{$usuario->PrimerApellido}}</td>
                    <td>{{$usuario->SegundoApellido}}</td>
                    <td>{{$usuario->email}}</td>
                    <td><a href="{{route('/EditarUsuario', $usuario->IDUser)}}"><i class='material-icons'>mode_edit</i></a></td>
                </tbody>
            @endforeach
        </table>
        
         <div class="row">
          <br>
          <button id="nuevoUser" class="waves-effect waves-light btn right" type="submit"><a class="white-text" href="{{ url('agregarUsuario') }}"><i class="material-icons left">add</i>Nuevo Usuario</a></button>
        </div>
        
      </form>
    </div>
    <div class="col s12 m4 l2"></div>
</div>

@endsection
