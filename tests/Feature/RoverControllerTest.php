<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\RoverController;

class RoverControllerTest extends TestCase
{
    /**
     * @test
     * @dataProvider direccionsProvider
     */
    public function verifica_direccio($direccioIni,$ordre,$esperat)
    {
        
        $direccions= new RoverController();

        $resultat= $direccions->calculaDireccio($direccioIni,$ordre);

        $this->assertEquals($esperat,$resultat);
       
    }
    public static function direccionsProvider()
    {
        return [
            ['N', 'l', 'W'],  // Girar a l'esquerra des del Nord → Oest
            ['N', 'r', 'E'],  // Girar a la dreta des del Nord → Est
            ['W', 'l', 'S'],  // Girar a l'esquerra des de l'Oest → Sud
            ['E', 'r', 'S'],  // Girar a la derecha des de l'Est → Sud
            ['S', 'f', 'S'],  // Avançar sense canvi en la direcció
            ['W', 'R', 'N'],  // Girar a la dreta des de l'Oest → Nord
            ['E', 'L', 'N'],  // Girar a l'esquerra des de l'Est → Nord
        ];
    }


    /**
     * @test
     * @dataProvider posicionsProvider
     */
    public function verifica_posicio($direccioIni,$posiciox,$posicioy,$maxx,$maxy,$esperatx,$esperaty)
    {
        
        $direccions= new RoverController();

        $resultat= $direccions->calculaPosicio($direccioIni,$posiciox,$posicioy,$maxx,$maxy);

        $this->assertEquals($esperatx,$resultat[0]);
        $this->assertEquals($esperaty,$resultat[1]);
       
    }
    public static function posicionsProvider()
    {
        return [
            ['N', '0', '0','199','199','0','199'],  // Girar a l'esquerra des del Nord → Oest
            ['S', '0', '0','199','199','0','1'],  // Girar a la dreta des del Nord → Est
            ['W', '0', '50','199','199','199','50'],  // Girar a l'esquerra des de l'Oest → Sud
            ['E', '199', '40','199','199','0','40'],  // Girar a la derecha des de l'Est → Sud
            ['S', '199', '40','199','199','199','41'],  // Girar a la derecha des de l'Est → Sud
            ['S', '20', '20','20','20','20','0'],  // Canviant les dimensions de la matriu
           
        ];
    }
}
