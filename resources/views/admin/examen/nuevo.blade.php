@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Examen</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('examen.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            <label for="fecha" class="col-md-4 control-label">Fecha</label>
                           
                            <div class="col-md-6">
                                <input type="text" name="fecha" value="{{ old('fecha') }}" 
                                class="form-control" placeholder="dd/mm/aaaa" required autofocus>

                                 @if ($errors->has('fecha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha') }}</strong>
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