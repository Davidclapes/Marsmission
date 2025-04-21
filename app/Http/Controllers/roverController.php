<?php

namespace App\Http\Controllers;


use App\Providers\Dadesmarsrover;
use Illuminate\Http\Request;

class RoverController extends Controller
{

    public function formulari(Request $request){
       
        $maxims=$request->session()->only(['maxx','maxy']);
        
        $maxx=$maxims["maxx"];
        $maxy=$maxims["maxy"];
        $request->session()->forget('desplacaments');
        $request->session()->forget('obstacles');
        
       
        return view('Form',compact('maxx','maxy'));

    }

    /**
     * CalculaMoviment
     * 
     * Calcular realitza les comparacions de les posicions per coneixer si hi ha obstacle.
     * @param request: Recuperar variables del formulari o sessió.
     * @return view: Crida la plantilla de blade i li passa els valors de les variables assignades
     */

    public function calculaMoviment(Request $request){

        $posx=intval($request->input("posx"));
        $posy=intval($request->input("posy"));
        $maxx=$request->input("maxx");
        $maxy=$request->input("maxy");
        $direccio=$request->input("direccio");
        $direccio=strtoupper($direccio);                        //Assegurem que la direcció sigui majuscula
        $moviment=$request->input("moviment");
        $ordres=str_split($moviment);
        $estat=0;
        $matriu=$request->session()->only(['Matriu']);          //Recuperem la matriu guardada
        $matriu=$matriu['Matriu'];
        $matriu[$posx][$posy]=0;                                //inicialitzem la primera posició com a 0
        session(['Matriu'=>$matriu]); 
        $desplacaments=$request->session()->only(['desplacaments']);  //Recupera la llista de desplaçaments d'aquest planeta
        $obstacles=$request->session()->only(['obstacles']);          //Recupera la llista d'obstacles d'aquest planeta
        
        if(count($desplacaments)==0){                           //Si la llista està buida li asignarem la posició inicial
            $desplacaments=array([$posx,$posy]);
        }else{

           $desplacaments=$desplacaments['desplacaments']; 
        }
        if(count($obstacles)==0){                               //Si la llista està buida l'inicialitza
            $obstacles=array();
        }else{

           $obstacles=$obstacles['obstacles']; 
        }
       
        for($i=0;$i<count($ordres);$i++){                       //Per a cada instrucció s'han de fer les comprovacions de direcció i seguent posició 
            $direccio=$this->calculaDireccio($direccio,$ordres[$i]);
            $posnova=$this->calculaPosicio($direccio,$posx,$posy,$maxx,$maxy); 
            if($matriu[$posnova[0]][$posnova[1]]==1){           //Comprovació d'obstacle
                $estat=1;
                $obstacles[]=[$posnova[0],$posnova[1]];
                session(['obstacles'=>$obstacles]);
                break;
                
            }else{
                $desplacaments[]=[$posnova[0],$posnova[1]];
                $posx=$posnova[0];
                $posy=$posnova[1];
            }
        }

        session(['desplacaments'=>$desplacaments]);
        $moviments=$i;

       

       
        if($estat==1){
            $ordrefinal=$ordres[$i];
            return view('calculamoviment', compact('moviments','desplacaments','obstacles','ordrefinal','posx','posy','maxx','maxy','posnova','direccio'));
        }else{
            return view('calculamoviment', compact('moviments','i','desplacaments','obstacles','posx','posy','maxx','maxy','direccio'));
        }
    }

    /**
     * CalculaPosicio
     * 
     * Calcular nova posició del rover donada una ordre dintre de la matriu actual.
     * @param direccio: Direcció cap a la que es mourà el Rover
     * @param posx: posició X actual
     * @param posy: posició Y actual
     * @param maxx: Dimensions X de la matriu
     * @param maxy: Dimensions Y de la matriu
     * @return posxnova: Nova posició X
     * @return posynova: Nova posició Y
     */

    public function calculaPosicio(string $direccio, int $posx, int $posy, int $maxx, int $maxy ){

            switch ($direccio) {                                        //Reconeixer quina serà la següent posició
                case 'N':
                $posynova=$posy-1;
                $posxnova=$posx;
                if($posynova<0){
                   $posynova=$maxy;
                }
                break;
                case 'S':
                $posynova=$posy+1;
                $posxnova=$posx;
                if($posynova>$maxy){
                   $posynova=0;
                }
                break;
                case 'W':
                    $posynova=$posy;
                    $posxnova=$posx-1;
                    if($posxnova<0){
                       $posxnova=$maxx;
                    }
                break;
                case 'E':
                    $posynova=$posy;
                    $posxnova=$posx+1;
                    if($posxnova>$maxx){
                       $posxnova=0;
                    }
                    break;
            }

            return [$posxnova,$posynova];


    }
    /**
     * CalculaDireccio
     * 
     * Calcular nova direccio del rover donada una ordre.
     * @param direccio: Direcció actual
     * @param ordre: Ordre actual
     * @return direccio: Nova direcció
     */

    public function calculaDireccio(string $direccio,string $ordre){
        $direccionsR=['N','E','S','W'];
        $direccionsL=['N','W','S','E'];

        switch ($ordre) {                                           //Comprovació de la nova direcció
                case 'f':
                case 'F':
                break;
                case 'l':
                case 'L':
                    $direc=array_search($direccio,$direccionsL);    //Es busca en l'array la direcció inicial 
                    $posicioarray = ($direc + 1 )%4;                //Es calcula el módul per a saber la posició en l'array de la nova direcció
                    $direccio=$direccionsL[$posicioarray];
                break;
                case 'r':
                case 'R':
                    $direc=array_search($direccio,$direccionsR);
                    $posicioarray = ($direc + 1) % 4;
                    $direccio=$direccionsR[$posicioarray];
                break;
         }
        return $direccio;

    }

  
}
