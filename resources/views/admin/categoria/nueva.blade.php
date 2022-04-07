@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Categoria</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('categoria.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                                                

                        <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">
                            <label for="categoria_id" class="col-md-4 control-label">Curso</label>

                            <div class="col-md-6">
                                <select id="categoria_id" class="form-control" name="categoria_id" required autofocus>

                                    @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->getNombreCompleto()}}</option>

                                    @endforeach                                   

                                </select>  

                                @if ($errors->has('categoria_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoria_id') }}</strong>
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