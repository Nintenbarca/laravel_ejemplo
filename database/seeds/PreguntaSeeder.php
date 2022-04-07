<?php

use App\Pregunta;
use Illuminate\Database\Seeder;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        Pregunta::create(array(
            'enunciado'      => 'fdsfkdsjdfsklf', 
            'solucion'  =>  'vxckjvckvjcxvckxj', 
            'examen_id'	=>	1,
        ));

        Pregunta::create(array(
            'enunciado'      => 'bvchfhgfgh', 
            'solucion'  =>  'operoipojgflkgf', 
            'examen_id'	=>	1,
        ));

        Pregunta::create(array(
            'enunciado'      => '4 + 2 =', 
            'solucion'  =>  6, 
            'examen_id'	=>	2,
        ));

        Pregunta::create(array(
            'enunciado'      => '2 x 4 =', 
            'solucion'  =>  8, 
            'examen_id'	=>	2,
        ));
    }
}
