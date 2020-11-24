@extends('layouts.masterPageAdmin')

@section('content')
    <style>
        .cuadro {
            border-left-color: #51081C;
            border-left-style: solid;
            border-left-width: 5px;
        }

        .centrar {
            height: 112px !important;
            margin: auto !important;
            vertical-align: middle;
            text-align: right;
            color: darkgray;
        }
    </style>

<div class="row">
    <div class="col m3 l3"></div>
    <div class="col s16 m3 l6">
        <div class="card-panel z-depth-5">
            <h3 class="center-align">Curia Diocesana de Alajuela</h3>
            <br><br>
            <div class="panel-body">
                <div class="row">
                    <div class="col s4 centrar">
                        <div class="row centrar">
                            <h5>Contactenos</h5>
                        </div>
                    </div>
                    <div class="col s8 cuadro">
                        <div class="col s12"><strong>Correo electrónico: </strong>   archivocuriaalajuela@hotmail.com</div>
                        <div class="col s12"><strong>Tel:</strong> 2433-6005 ext 3</div>
                        <div class="col s12"><strong>WA:</strong> 6106-0262</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
