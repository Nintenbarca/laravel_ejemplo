<?php

namespace App\Http\Controllers;

use App\Post;
use App\Examen;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchController extends Controller{
    
    public function search(){

    	$query = isset($_GET['query'])?$_GET['query']:'';

    	$searchType = (isset($_GET['searchType']))?strtolower($_GET['searchType']):'posts';
    	return ($searchType == 'posts')?$this->postSearch($query):$this->examSearch($query);

    }

    private function postSearch($query)
    {
    	$posts = Post::all();
        $posts = $this->postFilter($posts, $query);
        if (Auth::guest() || (Auth::user() && !Auth::user()->hasRole('Admin'))) {
            return view('post/lista', ['posts' => $posts]);
        }elseif(Auth::user()->hasRole('Admin')){
            return view('admin/post/lista', ['posts' => $posts]);
        }          
    }

    private function examSearch($query)
    {
    	$examenes = Examen::all();
        $examenes = $this->examFilter($examenes, $query);
        if (Auth::user()->hasRole('Admin')) {
            return view('admin/examen/lista', ['examenes' => $examenes]);
        }else{
            return view('examen/lista', ['examenes' => $examenes]);
        }        
    }

    private function postFilter($posts, $query){
        $query = strtolower($query);
        $result = array();
        foreach ($posts as $post) {
            $categoria = Categoria::findOrFail($post->categoria)->getNombreCompleto();
            $categoria = strtolower($categoria);
            if(strpos($categoria, $query) !== false){
                array_push($result, $post);
            }
        }
        return $result;
    }

    private function examFilter($examenes, $query){
        $query = strtolower($query);
        $result = array();
        foreach ($examenes as $examen) {
            $categoria = Categoria::findOrFail($examen->categoria)->getNombreCompleto();
            $categoria = strtolower($categoria);
            if(strpos($categoria, $query) !== false){
                array_push($result, $examen);
            }
        }
        return $result;
    }
}
