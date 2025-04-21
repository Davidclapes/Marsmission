<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index(){

        $Matrix=array();
        $maxx=200;
        $maxy=200;
        $i=0;
        for($i=0;$i<$maxy;$i++){
            $aux=array(); //Inicialització de les files
            for($j=0;$j<$maxx;$j++){ 

                if($i==100 && $j==100){ //Es defineix com la posició inicial

                    $obstacle=0; //Com és on es troba el Rover inicialment no pot haver-hi un obstacle

                }else{
                    $obstacle=rand(0,1);//De forma aleatoria es marca que la posició tindrà o no un obstacle (0=>no hi ha obstacle, 1=>hi ha un obstacle)
                    //print($obstacle);
                }
                $aux[]=$obstacle;
            }
            $Matrix[]=$aux;//assigna la fila completa a la matriu

            session(['Matriu'=>$Matrix]);
            session(['maxx'=>$maxx-1]);
            session(['maxy'=>$maxy-1]);

        }    
        return view('inici');
    }
}
