<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin')) {
            
            $categorias = Categoria::where('is_leaf_category', '=', true)->paginate(10);
        
            return view('admin/categoria/lista', compact('categorias'));
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin')) {            
            
            $categorias = Categoria::where('is_parent_category', '=', true)->get();
            return view('admin/categoria/nueva', compact('categorias'));
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin')) {
            
            $datos = $request->validate([
                'nombre' => 'required|string|max:50',                 
                'categoria_id' => 'required|integer'                
            ]);

            $categoria = new Categoria();
            $categoria->nombre = $datos['nombre'];   
            $categoria->categoria_id = $datos['categoria_id'];                        
            $categoria->save();            
            return $this->index();
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin')) {
            
            $categoria = Categoria::findOrFail($id); 
            $categorias = Categoria::where('is_parent_category', '=', true)->get()->toArray();
            $ids = array_column($categorias, 'id');
            $nombres = array();
            foreach ($categorias as $c) {
                array_push($nombres, Categoria::find($c['id'])->getNombreCompleto());
            }
            array_flip($nombres);
            $categorias = array_combine($ids, $nombres);
            return view('admin/categoria/editar', compact('categoria', 'categorias'));
            
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin')) {
            
            $datos = $request->validate([
            'nombre' => 'required|string|max:50',             
            'categoria_id' => 'required'            
            ]);

            $categoria = Categoria::findOrFail($id);           
            $categoria->nombre = $datos['nombre'];                  
            $categoria->categoria_id = $datos['categoria_id'];                            
            $categoria->save();
            
            return redirect('/admin/categoria');

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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin')) {
            
            $categoria = Categoria::findOrFail($id);            
            $categoria->delete();
            
            return redirect('/admin/categoria');
        }else{

            return redirect('/');
        }
    }
}
