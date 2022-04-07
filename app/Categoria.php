<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{
    
    protected $fillable = [
        'nombre', 'categoria_id'
    ];

    public function getNombreCompleto(){
    	$nombre = $this->nombre;
		$c=Categoria::find($this->categoria_id);
		while ($c != false) {
			$nombre .= " de ".$c->nombre;
			$c = Categoria::find($c->categoria_id);
		}
		return $nombre;
    }  

    /*
    public static function getAllParent(){ 
    	return Categoria::where('categoria_id', '=', NULL)->get();
	}

	public function getChildren(){
		$directChildren = Categoria::where('categoria_id', '=', $this->id)->get();		

        foreach ($directChildren as $child) {
        	if (count($child->getChildren()) > 0) {
        		$child->children = $child->getChildren();
        	}
        }
        return $directChildren;
	}

	public function getChildrenIdsAsList(){
		$directChildren = Categoria::where('categoria_id', '=', $this->id)->get();		
        $list = array();

        foreach ($directChildren as $child) {
            array_push($list, $child->id);
        	$childrenIds = $child->getChildrenIdsAsList();	
        	if (count($childrenIds) > 0) {
        		$list = array_merge($list, $childrenIds);
        	}
        }
        return $list;
	}

    public static function getTree(){
		$categorias = Categoria::getAllParent();
		foreach ($categorias as $categoria) {
			$categoria->children = $categoria->getChildren();
		}
		return $categorias;
	}
    */
}
