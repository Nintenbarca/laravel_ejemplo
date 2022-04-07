@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Examen</div>

                <div class="panel-body">
                    {{ Form::model($examen, array('route' => array('examenes.update', $examen->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

                        <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">                           
                            {{ Form::label('fecha', 'Fecha', array('class' => 'col-md-4 control-label')) }}
                            
                            <div class="col-md-6">
                                {{ Form::text('fecha', $examen->fecha, array('class' => 'form-control', 'placeholder' => 'dd/mm/aaaa')) }}

                                @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">                            
                            {{ Form::label('categoria', 'Categoria', array('class' => 'col-md-4 control-label')) }}
                            
                            <div class="col-md-6">
                                {{ Form::select('categoria', $categorias) }}

                                @if ($errors->has('categoria'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoria') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>                      

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}                                
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Editar Preguntas</div>

                <div class="panel-body">
                    @foreach($preguntas as $pregunta)
                        {{ Form::model($pregunta, array('route' => array('preguntas.update', $pregunta->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

                            <div class="form-group{{ $errors->has('enunciado') ? ' has-error' : '' }}">                           
                                {{ Form::label('enunciado', 'Enunciado', array('class' => 'col-md-4 control-label')) }}
                                
                                <div class="col-md-6">
                                    {{ Form::text('enunciado', $pregunta->enunciado, array('class' => 'form-control')) }}

                                    @if ($errors->has('enunciado'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('enunciado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                        

                            <div class="form-group{{ $errors->has('solucion') ? ' has-error' : '' }}">                           
                                {{ Form::label('solucion', 'Solucion', array('class' => 'col-md-4 control-label')) }}
                                
                                <div class="col-md-6">
                                    {{ Form::text('solucion', $examen->solucion, array('class' => 'form-control')) }}

                                    @if ($errors->has('solucion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('solucion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                                  

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <p>{{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }} 
                                    {{ Form::close() }}</p>
                                    
                                    {{ Form::open(['route' => ['preguntas.destroy', $pregunta->id], 'method' => 'delete']) }}
                                    {{ Form::submit('Borrar', array('class' => 'btn btn-danger')) }}
                                    {{ Form::close() }}                               
                                </div>
                            </div>                            
                        
                    @endforeach
                </div>
            </div> 
            <div class="panel panel-default">
                <div class="panel-heading">Crear Pregunta</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('preguntas.store') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="examen_id" value="{{ $examen->id }}">

                        <div class="form-group{{ $errors->has('enunciado') ? ' has-error' : '' }}">
                            <label for="enunciado" class="col-md-4 control-label">Enunciado</label>

                            <div class="col-md-6">
                                <input id="enunciado" type="text" class="form-control" name="enunciado" value="{{ old('enunciado') }}" required autofocus>

                                @if ($errors->has('enunciado'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enunciado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                                               

                        <div class="form-group{{ $errors->has('solucion') ? ' has-error' : '' }}">
                            <label for="solucion" class="col-md-4 control-label">Solucion</label>

                            <div class="col-md-6">
                                <textarea id="solucion" name="solucion" class="form-control" required=""></textarea>

                                @if ($errors->has('solucion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('solucion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                                           

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear
                                </button>                                
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>             
        </div>
    </div>
</div>
@endsection