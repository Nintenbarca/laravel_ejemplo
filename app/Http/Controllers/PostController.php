<?php

namespace App\Http\Controllers;

use App\Post;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $posts = Post::all();
        
        return view('post/lista', compact('posts'));
        
       
    }

    public function categoria($categoriaId){        
            
        $posts = Post::where('categoria', '=', $categoriaId)->get();

        return view('post/lista', compact('posts'));             
    }
       

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
        if (!Auth::guest()) {

            $categorias = Categoria::where('is_leaf_category', '=', true)->get();
        
            return view('post/nuevo', compact('categorias'));
        }else{

            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        if (!Auth::guest()) {
            
            $datos = $request->validate([
                'titulo' => 'required|string|max:50', 
                'resumen' => 'required|string|max:100', 
                'contenido' => 'required|string|max:255', 
                'categoria' => 'required'
            ]);

            $post = new Post();
            $post->titulo = $datos['titulo'];           
            $post->resumen = $datos['resumen'];
            $post->contenido = $datos['contenido'];
            $post->user_id = Auth::user()->id;
            $post->categoria = $datos['categoria'];             
            $post->save();            
            return $this->index();
        }else{
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        $post = Post::findOrFail($id);        

        return view('post/detalle', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
        if (!Auth::guest()) {
            
            $post = Post::findOrFail($id);

            if ($post->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')) {
                $categorias = Categoria::where('is_leaf_category', '=', true)->get()->toArray();
                $ids = array_column($categorias, 'id');
                $nombres = array();
                foreach ($categorias as $c) {
                    array_push($nombres, Categoria::find($c['id'])->getNombreCompleto());
                }
                array_flip($nombres);
                $categorias = array_combine($ids, $nombres);

                return view('post/editar', compact('post', 'categorias'));
            }else{
                return $this->index();
            }
        }else{
            return redirect('/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
        if (!Auth::guest()) {
            
            $datos = $request->validate([
            'titulo' => 'required|string|max:50', 
            'resumen' => 'required|string|max:100', 
            'contenido' => 'required|string|max:255', 
            'categoria' => 'required'
            ]);

            $post = Post::findOrFail($id);
            if ($post->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')) {
                $post->titulo = $datos['titulo'];
                $post->resumen = $datos['resumen'];
                $post->contenido = $datos['contenido'];        
                $post->categoria = $datos['categoria'];                    
                $post->save();
            }  
            return $this->show($id);

        }else{
            return redirect('/login');
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        if (!Auth::guest()) {
            
            $post = Post::findOrFail($id);

            if ($post->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')) {
                $post->delete();
            }
            return $this->index();
        }else{

            return redirect('/login');
        }  
    }    
}
