<?php

namespace App\Http\Controllers;

use App\Examen;
use App\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        if (!Auth::guest()) {
            
            $examenes = Examen::all();

            return view('examen/lista', compact('examenes'));
        }else{
            return redirect('/login');
        }        
        
    }

    public function categoria($categoriaId){

        if (!Auth::guest()) {
            
            $examenes = Examen::where('categoria', '=', $categoriaId)->get();

            return view('examen/lista', compact('examenes'));
        }else{
            return redirect('/login');
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
        if (!Auth::guest() && (Auth::user()->hasRole('Profesor') || 
            Auth::user()->hasRole('Admin')) && Auth::user()->can('Create examen')) {

            $categorias = Categoria::where('is_leaf_category', '=', true)->get();
        
            return view('examen/nuevo', compact('categorias'));
        }else{

            return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        if (!Auth::guest() && (Auth::user()->hasRole('Profesor') || 
            Auth::user()->hasRole('Admin')) && Auth::user()->can('Create examen')) {
            
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

        if (!Auth::guest()) {
            
            $examen = Examen::findOrFail($id);    
            $preguntas = DB::table('preguntas')->where('examen_id', '=', $id)->get();    

            return view('examen/detalle', compact('examen', 'preguntas'));
        }else{
            return redirect('/login');
        }       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
        if (!Auth::guest() && Auth::user()->can('Update examen')) {
            
            $examen = Examen::findOrFail($id);
            $preguntas = DB::table('preguntas')->where('examen_id', '=', $id)->get();

            if ($examen->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')) {
                $categorias = Categoria::where('is_leaf_category', '=', true)->get()->toArray();
                $ids = array_column($categorias, 'id');
                $nombres = array();
                foreach ($categorias as $c) {
                    array_push($nombres, Categoria::find($c['id'])->getNombreCompleto());
                }
                array_flip($nombres);
                $categorias = array_combine($ids, $nombres);

                return view('examen/editar', compact('examen', 'categorias', 'preguntas'));
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
        
        if (!Auth::guest() && Auth::user()->can('Update examen')) {
            
            $datos = $request->validate([
            'fecha' => 'required|string|size:10',             
            'categoria' => 'required'
            ]);

            $examen = Examen::findOrFail($id);
            if ($examen->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')) {
                $examen->fecha = $datos['fecha'];                      
                $examen->categoria = $datos['categoria'];                    
                $examen->save();
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
        
        if (!Auth::guest() && Auth::user()->can('Delete examen')) {
            
            $examen = Examen::findOrFail($id);

            if ($examen->user_id == Auth::user()->id || Auth::user()->hasRole('Admin')) {
                $examen->delete();
            }
            return $this->index();
        }else{

            return redirect('/login');
        }
    }
}
