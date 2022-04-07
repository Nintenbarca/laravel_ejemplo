<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
	    Post::create(array(
	        'titulo'      => 'fdsfdsfsd', 
	        'resumen'  =>  'kjkdgjgl',
	        'contenido'	=>	'fdsfdsfddfdsgf', 
	        'user_id'	=>	1,
	        'categoria'	=>	12,
	    ));

	    Post::create(array(
	        'titulo'      => 'fdhgf', 
	        'resumen'  =>  'sdggfd',
	        'contenido'	=>	'bnbvcnfkggf', 
	        'user_id'	=>	2,
	        'categoria'	=>	22,
	    ));
    }
}
