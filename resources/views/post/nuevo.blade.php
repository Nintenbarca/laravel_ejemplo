@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Post</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('posts.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label for="titulo" class="col-md-4 control-label">Titulo</label>

                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required autofocus>

                                @if ($errors->has('titulo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('resumen') ? ' has-error' : '' }}">
                            <label for="resumen" class="col-md-4 control-label">Resumen</label>

                            <div class="col-md-6">
                                <input id="resumen" type="text" class="form-control" name="resumen" value="{{ old('resumen') }}" required autofocus>

                                @if ($errors->has('resumen'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('resumen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contenido') ? ' has-error' : '' }}">
                            <label for="contenido" class="col-md-4 control-label">Contenido</label>

                            <div class="col-md-6">
                                <textarea id="contenido" class="form-control" name="contenido" required></textarea>                        

                                @if ($errors->has('contenido'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contenido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                            <label for="categoria" class="col-md-4 control-label">Categoria</label>

                            <div class="col-md-6">
                                <select id="categoria" class="form-control" name="categoria" required autofocus>

                                    @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->getNombreCompleto()}}</option>

                                    @endforeach                                   

                                </select>  

                                @if ($errors->has('categoria'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoria') }}</strong>
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