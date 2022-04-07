<?php

namespace App\Http\Controllers\Admin;

use App\Pregunta;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPreguntaController extends Controller
{   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        if (!Auth::guest() && Auth::user()->hasRole('Admin') && 
            Auth::user()->can('Update examen')) {

            $datos = $request->validate([
                'enunciado' => 'required|string|max:100', 
                'solucion' => 'required|string|max:255',                 
                'examen_id' =>  'required'          
            ]);

            $pregunta = new Pregunta();
            $pregunta->enunciado = $datos['enunciado'];           
            $pregunta->solucion = $datos['solucion'];            
            $pregunta->examen_id = $datos['examen_id'];                        
            $pregunta->save();            
            return redirect('/admin/examen/' .$pregunta->examen_id. '/edit');
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
            Auth::user()->can('Update examen')) {

            $datos = $request->validate([
                'enunciado' => 'required|string|max:50', 
                'solucion' => 'required|string|max:255',                            
            ]);

            $pregunta = Pregunta::findOrFail($id);           
            $pregunta->enunciado = $datos['enunciado'];
            $pregunta->solucion = $datos['solucion'];            
            $pregunta->save();            
            return redirect('/admin/examen/' .$pregunta->examen_id. '/edit');
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
            Auth::user()->can('Update examen')) {
            
            $pregunta = Pregunta::findOrFail($id);
            $pregunta->delete();
            
            return redirect('/admin/examen/' .$pregunta->examen_id. '/edit');
        }else{

            return redirect('/');
        }  
    }
}
