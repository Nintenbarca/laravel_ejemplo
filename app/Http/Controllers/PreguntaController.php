<?php

namespace App\Http\Controllers;

use App\Pregunta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    
    public function store(Request $request){
        
        if (!Auth::guest() && Auth::user()->can('Update examen')) {
            
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
            return redirect('/examenes/' .$pregunta->examen_id. '/edit');
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
                'enunciado' => 'required|string|max:50', 
                'solucion' => 'required|string|max:255',                            
            ]);

            $pregunta = Pregunta::findOrFail($id);           
            $pregunta->enunciado = $datos['enunciado'];
            $pregunta->solucion = $datos['solucion'];            
            $pregunta->save();            
            return redirect('/examenes/' .$pregunta->examen_id. '/edit');

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
        
        if (!Auth::guest() && Auth::user()->can('Update examen')) {
            
            $pregunta = Pregunta::findOrFail($id);
            $pregunta->delete();
            
            return redirect('/examenes/' .$pregunta->examen_id. '/edit');
        }else{

            return redirect('/login');
        }  
    }     
}
