<?php

use App\Examen;
use Illuminate\Database\Seeder;

class ExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        Examen::create(array(
            'fecha'      => '12/08/2005', 
            'categoria'  =>  15, 
            'user_id'	=>	1,
        ));

        Examen::create(array(
            'fecha'      => '10/06/2012', 
            'categoria'  =>  21, 
            'user_id'	=>	2,
        ));
    }
}
