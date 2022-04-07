<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('View posts')) {
            
            $posts = Post::all();
        
            return view('admin/post/lista', compact('posts'));
        }else{
            return redirect('/');
        }  
    }

    public function categoria($categoria){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('View posts')) {
            
            $posts = Post::where('categoria', '=', $categoria)->get();    
        
            return view('admin/post/lista', compact('posts'));
        }else{
            return redirect('/');
        }       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && 
            Auth::user()->can('Create posts')) {

            $categorias = Categoria::where('is_leaf_category', '=', true)->get();
        
            return view('admin/post/nuevo', compact('categorias'));
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && 
            Auth::user()->can('Create posts')) {
            
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
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('View posts')) {
            
            $post = Post::findOrFail($id);

            return view('admin/post/detalle', compact('post'));
        }else{
            return redirect('/');
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && 
            Auth::user()->can('Update posts')) {
            
            $post = Post::findOrFail($id);            
            $categorias = Categoria::where('is_leaf_category', '=', true)->get()->toArray();
            $ids = array_column($categorias, 'id');
            $nombres = array();
            foreach ($categorias as $c) {
                array_push($nombres, Categoria::find($c['id'])->getNombreCompleto());
            }
            array_flip($nombres);
            $categorias = array_combine($ids, $nombres);

            return view('admin/post/editar', compact('post', 'categorias'));
            
        }else{
            return redirect('/');
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && 
            Auth::user()->can('Update posts')) {
            
            $datos = $request->validate([
            'titulo' => 'required|string|max:50', 
            'resumen' => 'required|string|max:100', 
            'contenido' => 'required|string|max:255', 
            'categoria' => 'required'
            ]);

            $post = Post::findOrFail($id);           
            $post->titulo = $datos['titulo'];
            $post->resumen = $datos['resumen'];
            $post->contenido = $datos['contenido'];        
            $post->categoria = $datos['categoria'];                    
            $post->save();
            
            return $this->index();

        }else{
            return redirect('/');
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && 
            Auth::user()->can('Delete posts')) {
            
            $post = Post::findOrFail($id);            
            $post->delete();
            
            return $this->index();
        }else{

            return redirect('/');
        }
    }
}
