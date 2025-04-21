@extends('layouts.plantillabase')

@section('informacio')

	
    <!--div id="app">
        <form-moviment></form-moviment>
    </div-->




    <div class="container">
                    <form method="POST" action="{{url('/calculamoviment')}}">
                        {{csrf_field()}}
                        <p>Benvingut al control del Rover. Introdueix les <strong>coordenades d'inici</strong> i la <strong>direcció inicial</strong> :<br><br></p>
                        <input type="hidden" name="maxx" value={{$maxx}}>
                        <input type="hidden" name="maxy" value={{$maxy}}>
                        <table class="taula">
                            <tr>
                                <td><p>Coord. X </p></td>
                                <td><input class="forminfo" name="posx" type="number" min="0" max="{{$maxx}}"  pattern="[0-9]*" required></td>
                                
                            </tr>
                            <tr>
                                <td><p>Coord. Y</p></td>
                                <td><input class="forminfo" name="posy" type="number" min="0" max="{{$maxy}}"  style="text-transform: uppercase;" pattern="[0-9]*" required></td>
                                
                            </tr>
                            <tr>
                                <td><p>Direcció (N,S,E,W)</p></td>
                                <td><input class="forminfo" name="direccio" type="text"style="text-transform: uppercase;" pattern="[NnEeWwSs]" required></td>
                                
                            </tr>
                        </table>
                        <br>
                        
                            <p> El Rover es controla amb les següents directives:
                                <ul><strong>F</strong> => Moviment endavant.</ul>
                                <ul><strong>L</strong> => Moviment a l'esquerra.</ul>
                                <ul><strong>R</strong> => Moviment a la dreta.</ul>
                         </p>   
                         <br><br>

                        
                     
                        <p >Introdueix la sequencia desitjada:<br><br></p>
                        
                            <input class="inputmov" name="moviment" type="text"style="text-transform: uppercase;" pattern="[FLRflr]*" required><br><br>
                            <button type="submit"class="buttonmov" type="button">Moure Rover</button>
                        
                    </form>
    </div>
       
       
</div>

@endsection