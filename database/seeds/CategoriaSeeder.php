<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

    	Categoria::create(array(
            'nombre'      => 'Primaria', 
            'is_parent_category' => true,
            'is_leaf_category'  =>  false,
        ));

        Categoria::create(array(
            'nombre'      => 'ESO', 
            'is_parent_category' => false,  
            'is_leaf_category'  =>  false,                               
        ));

        Categoria::create(array(
            'nombre'      => 'Bachiller', 
            'is_parent_category' => false, 
            'is_leaf_category'  =>  false,                           
        ));

        Categoria::create(array(
            'nombre'      => '1º', 
            'categoria_id'	=> 2,   
            'is_parent_category' => true,
            'is_leaf_category'  =>  false,
        ));

        Categoria::create(array(
            'nombre'      => '2º', 
            'categoria_id'	=> 2,  
            'is_parent_category' => true,
            'is_leaf_category'  =>  false,                   
        ));

        Categoria::create(array(
            'nombre'      => '3º', 
            'categoria_id'	=> 2,  
            'is_parent_category' => true, 
            'is_leaf_category'  =>  false,                     
        ));

        Categoria::create(array(
            'nombre'      => '4º', 
            'categoria_id'	=> 2,  
            'is_parent_category' => true,
            'is_leaf_category'  =>  false,                     
        ));

        Categoria::create(array(
            'nombre'      => '1º', 
            'categoria_id'	=> 3,  
            'is_parent_category' => true,  
            'is_leaf_category'  =>  false,                   
        ));

        Categoria::create(array(
            'nombre'      => '2º', 
            'categoria_id'	=> 3,  
            'is_parent_category' => true,
            'is_leaf_category'  =>  false,                     
        ));

        Categoria::create(array(
            'nombre'      => 'Lengua', 
            'categoria_id'	=> 1,   
            'is_parent_category' => false,
            'is_leaf_category'  =>  true,                    
        ));

        for ($i = 4; $i < 10 ; $i++) { 
        	Categoria::create(array(
           		'nombre'      => 'Lengua', 
            	'categoria_id'	=> $i,   
                'is_parent_category' => false,
                'is_leaf_category'  =>  true,                   
        	));
        }

        Categoria::create(array(
            'nombre'      => 'Matematicas', 
            'categoria_id'	=> 1,     
            'is_parent_category' => false,
            'is_leaf_category'  =>  true,                 
        ));

        for ($i = 4; $i < 10 ; $i++) { 
        	Categoria::create(array(
           		'nombre'      => 'Matematicas', 
            	'categoria_id'	=> $i,  
                'is_parent_category' => false,
                'is_leaf_category'  =>  true,                    
        	));
        }
        
        
    }
}
