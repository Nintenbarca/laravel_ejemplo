<?php

namespace App;

use App\Categoria;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    protected $fillable = [
        'titulo', 'resumen', 'contenido', 'categoria'
    ];

   	/*
    public static function getByCategoria($categoriaId){
   		
   		return Post::where(function ($query){
   			global $categoriaId;
   			$ids = (Categoria::findOrFail($categoriaId))->getChildrenIdsAsList();
   			$query->where('categoria_id', '=', $categoriaId);
   			foreach ($ids as $id) {
   				$query->orWhere('categoria_id', '=', $id);
   			}
   		})->get();		
   }
   */
}
