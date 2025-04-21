@extends('layouts.plantillabase')

@section('informacio')

    <div class="container">

        <p>El Rover ha fet <strong>{{$moviments}} moviment/s </strong> de forma satisfactoria.
        <br><br>

        @if(isset($posnova))

            El Rover s'ha trobat un obstacle en les coordenades <strong>({{$posnova[0]}},{{$posnova[1]}})</strong>. L'ultima ordre erronea era: {{$ordrefinal}}<br><br>

        @endif

         Actualment es troba a les coordenades <strong>({{$posx}},{{$posy}})</strong> mirant en direcció <strong>{{$direccio}}</strong>.</p>
         
    </div>
    @if ($maxx * $maxy < 40500)
    <div class="containergrid">
    
        <div class="contenidorllegenda">
            <div class="item-llegenda ">
                <div class="quadrat actual"></div> Posició actual del Rover 
            </div>
            <div class="item-llegenda ">
                <div class="quadrat primera"></div>Posició d'origen Rover 
            </div>
        </div>
        <br>
        <div class="contenidorllegenda"> 
            <div class="item-llegenda ">
                <div class="quadrat selected"></div> Moviment del Rover
            </div>
            <div class="item-llegenda ">
                <div class="quadrat obstacle"></div> Obstacles coneguts
            </div>
             
        </div>
    <div class="grid" style="grid-template-columns: repeat({{$maxx}}, 5px); 
            grid-template-rows: repeat({{$maxy-1}}, 5px)";> <!--aquest estil es posa aqui perque s'ha d'editar segons les dimensions de la matriu-->
    @php
        $firstCoord = $desplacaments[0] ?? null; 
    @endphp        
    
        @for ($i = 0; $i < $maxx; $i++) <!--fila-->
            @for ($j = 0; $j < $maxy; $j++)<!--Columna-->
                <!--A continuació es calcula quin tipus de casella és i se li assigna una classe concreta-->
                <div class="cell 
                    @foreach ($desplacaments as $coordenada)
                        @if ($coordenada[1] === $i && $coordenada[0] === $j) 
                            @if ($posx==$j && $posy==$i ) actual

                            @else
                                @if ($coordenada==$firstCoord)
                                    primera
                                @else
                                    selected
                                @endif
                            @endif
                        @endif
                    @endforeach
                    @foreach ($obstacles as $obstacle)
                        @if ($obstacle[1] === $i && $obstacle[0] === $j)
                            obstacle
                        @endif
                    @endforeach">
                </div>
            @endfor
        @endfor
      
    </div>

  </div>@endif 
    <div class="containerform">
        <form method="POST" action="{{url('/calculamoviment')}}">
            {{csrf_field()}}

            <p >Vols seguir movent el rover?<br><br></p>
            <p >Introdueix la sequencia desitjada:<br><br></p>
            <input type="hidden" name="direccio" value="{{$direccio}}">
            <input type="hidden" name="posx" value="{{$posx}}">
            <input type="hidden" name="posy" value="{{$posy}}">
            <input type="hidden" name="maxx" value="{{$maxx}}">
            <input type="hidden" name="maxy" value="{{$maxy}}">
            <input name="moviment" type="text"style="text-transform: uppercase;" pattern="[FLRflr]*"><br><br>
            <button type="submit"class="buttoninici" style="padding:5px; margin-left:6%" type="button">Moure Rover</button>
        </form>           
    </div>
    <div class="container">
        <p>Vols viatjar a un nou planeta?</p>
        <a href="/"><button class="buttoninici" style="padding:5px;"type="button">Viatjar a un nou planeta</button></a>
    </div>
    <br><br>


@endsection
