<?php

namespace App\Http\Controllers\Admin;

use App\Examen;
use App\Pregunta;
use App\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('View examen')) {
            
            $examenes = Examen::all();

            return view('admin/examen/lista', compact('examenes'));
        }else{
            return redirect('/');
        }
    }

    public function categoria($categoria){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('View examen')) {
            
            $examenes = Examen::where('categoria', '=', $categoria)->get();    
        
            return view('admin/examen/lista', compact('examenes'));
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('Create examen')) {

            $categorias = Categoria::where('is_leaf_category', '=', true)->get();
        
            return view('admin/examen/nuevo', compact('categorias'));
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('Create examen')) {
            
           $datos = $request->validate([
                'fecha' => 'required|string|size:10',                 
                'categoria' => 'required'
            ]);

            $examen = new Examen();           
            $examen->fecha = $datos['fecha'];        
            $examen->user_id = Auth::user()->id;
            $examen->categoria = $datos['categoria'];             
            $examen->save();            
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('View examen')) {

            $examen = Examen::findOrFail($id);    
            $preguntas = Pregunta::where('examen_id', '=', $id)->get();    

            return view('admin/examen/detalle', compact('examen', 'preguntas'));
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('Update examen')) {

            $examen = Examen::findOrFail($id);
            $preguntas = Pregunta::where('examen_id', '=', $id)->get();            
            $categorias = Categoria::where('is_leaf_category', '=', true)->get()->toArray();
            $ids = array_column($categorias, 'id');
            $nombres = array();
            foreach ($categorias as $c) {
                array_push($nombres, Categoria::find($c['id'])->getNombreCompleto());
            }
            array_flip($nombres);
            $categorias = array_combine($ids, $nombres);

            return view('admin/examen/editar', compact('examen', 'categorias', 'preguntas'));
            
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('Update examen')) {

           $datos = $request->validate([
            'fecha' => 'required|string|size:10',             
            'categoria' => 'required'
            ]);

            $examen = Examen::findOrFail($id);            
            $examen->fecha = $datos['fecha'];                      
            $examen->categoria = $datos['categoria'];                    
            $examen->save();
            
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
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && Auth::user()->can('Delete examen')) {

            $examen = Examen::findOrFail($id);            
            $examen->delete();
            
            return $this->index();
        }else{
            return redirect('/');
        }
    }
}
