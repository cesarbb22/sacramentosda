
<!DOCTYPE html>
<html>

    <head>
        <title>Certificado Sacramentos Recibidos <title>
            <link rel="stylesheet" href="css/pdf.css" type="text/css" />

    </head>
    <body>
        <div class = "divimagdioce">
            <img src="style/img/dioce3.PNG"></img>
        </div>
        <div class= "divtitulo">
            <h4>Archivo Histórico de la Curia de Alajuela  <br/> Constancia de Sacramentos Recibidos </h4>
        </div>
        <div class = "divimagcuria">
        <img src="style/img/curia3.PNG"></img>
        </div>


        <div class="container">
        <div class ="divParrafo">
        <p>El suscrito Pbro.Sixto Edo. Varela Santamaría, Canciller de la Curia Diocesana de Alajuela; <br/>
        Certifica que en los libros sacramentales custodiados en el Archivo Histórico se encuentra la siguiente información:</p>
        </div>




        <div class= "Divpersona" >
        <label for="idParroqui"><b> En la Parroquia de: </b>   {{ Auth::user()->parroquia->NombreParroquia }}</label>  <br/>
        <label for="persona"><b>Se encuentra la información de: </b>{{  $personaNom}} {{    $personaAp1 }} {{  $personaAp2 }}</label>   <br/>
        <label for="cedula"> <b>Cédula de identidad: </b>  {{  $numCedulaEdit}}</label><br/>
          @if($tipoHijo == 1 )
          <label for="Hij(o)1"><b> Hij(o): </b> Natural </label>
          @else
           <label for="Hij(o)2"><b> Hij(o): </b>Legítimo </label>
          @endif
        <label for="de"> <b>de: </b>{{  $personamadre }} {{    $personaPadre}}</label>  <br/>
        <label for="Nacido"> <b>Nacido en: </b> {{ $nacidolugar }}  </label> <br/>
        <label for="día"><b>El día: </b> {{ $fechaNacEdit }}  </label><br/>

        </div>
        @if($lugarBautizado != null )
        <div class="DivBautizo" >

            <label for="BAUTIZADO"><b>BAUTIZADO EN: </b>  {{ $lugarBautizado }}</label> <br/>
             <label for="díaB"><b>El día: </b> {{ $fechaBau}}</label><br/>
            <label for="Padrinos"><b>Padrinos: </b> {{  $nombreMadrinaB }} {{  $nombrePadrinoB}} </label> <br/>
            <label for="InfoB"><b>Esta Información consta en el Libro: </b> {{  $numLibroB }}</label><label for="FolioB">   <b>Folio: </b> {{  $numFolioB}}</label><label for="AsientoB">     <b>Asiento: </b>  {{   $numAsientoB}}</label><br/>
        </div>
           @else
                    <div class="Nobautizo">
                  <label for="BAUTIZADO"><b>BAUTIZADO EN: </b>  No cuenta con esta partida</label> <br/>

                    </div>

                @endif

         @if($lugarConfirma != null )
        <div class = "DivConfirma" >
            <label><b>CONFIRMADO EN: </b>{{  $lugarConfirma}}</label><br/>
            <label><b>El día: </b>{{  $fechaConfirma}}</label><br/>
            <label><b>Padrinos: </b> {{  $nombrePadrinoC1}} {{  $nombrePadrinoC2}}</label><br/>
            <label><b>Esta Información consta en el Libro: </b> {{ $numLibroC}}</label> <label>   <b>Folio: </b {{  $numFolioC}}</label> <label>   <b>Asiento: </b>{{  $numAsientoC}}</label><br/>
        </div>
        @else
                <div class="Noconfirma">
                  <label><b>CONFIRMADO EN: </b>  No cuenta con esta partida</label> <br/>
                </div>

                @endif

        @if($lugarMatrimonio != null )
        <div class= "DivMatrimonio" >
            <label><b>MATRIMONIO EN: </b>{{ $lugarMatrimonio}}</label> <br/>
            <label><b>Con: </b>{{  $nombreConyuge}} </label><br/>
            <label><b>El día: </b>{{  $fechaMatrimonio}}</label><br/>
            <label><b>Esta Información consta en el Libro: </b>{{  $numLibroM}} </label> <label>  <b>Folio: </b> {{  $numFolioM}}</label> <label>    <b>Asiento: </b>{{  $numAsientoM}}</label><br/>
        </div>
         @else
                <div class="NoMatrimonio">
                 <label><b>MATRIMONIO EN: </b> No cuenta con esta partida</label> <br/>
                </div>

         @endif

        @if($lugarDefuncion != null )
        <div class= "divdefun" >
            <label for="DEFUNCION"><b>DEFUNCIÓN EN: </b>  {{  $lugarDefuncion}}</label> <br/>
            <label for="díaD"><b>El día: </b> {{  $fechaDefuncion}}</label><br/>
            <label><b>A causa de: </b> {{  $causaDefuncion}}</label><br/>
            <label><b>Esta Información consta en el Libro: </b> {{ $numLibroD}}</label> <label>   <b>Folio: </b> {{  $numFolioD}}</label> <label>   <b>Asiento: </b>{{ $numAsientoD}}</label><br/>
        </div
         @else
                <div class="NoDefuncion">
               <label for="DEFUNCION"><b>DEFUNCIÓN EN: </b> No cuenta con esta partida</label> <br/>
                </div>

         @endif
         @if($notasMarginalesEdit != null )
        <div class="divNotas" >
            <label for="notasMarginales"><b>Notas Marginales: </b>  {{ $notasMarginalesEdit}}</label><br/>

        </div>
          @else
                <div class="NoNotas">
               <label for="notasMarginales"><b>Notas Marginales: </b> No cuenta con ninguna nota</label> <br/>
                </div>

         @endif

       </div>
    </body>
</html>






