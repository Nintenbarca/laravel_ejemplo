@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Categoria</div>

                <div class="panel-body">
                    {{ Form::model($categoria, array('route' => array('categoria.update', $categoria->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">                           
                            {{ Form::label('nombre', 'Nombre', array('class' => 'col-md-4 control-label')) }}
                            
                            <div class="col-md-6">
                                {{ Form::text('nombre', $categoria->nombre, array('class' => 'form-control')) }}

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                                                

                        <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">                            
                            {{ Form::label('categoria_id', 'Categoria', array('class' => 'col-md-4 control-label')) }}
                            
                            <div class="col-md-6">
                                {{ Form::select('categoria_id', $categorias) }}

                                @if ($errors->has('categoria_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoria_id') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('is_parent_category') ? ' has-error' : '' }}">                            
                            {{ Form::label('is_parent_category', '¿Admite subcategorías?', array('class' => 'col-md-4 control-label')) }}
                            
                            <div class="col-md-6">
                                <select id="is_parent_category" class="form-control" name="is_parent_category" required autofocus>                                    
                                    <option value="1" <?php if($categoria->is_parent_category)echo "selected"?>>Sí</option>
                                    <option value="0" <?php if(!$categoria->is_parent_category)echo "selected"?>>No</option>   

                                </select>
                                @if ($errors->has('is_parent_category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_parent_category') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>       

                        <div class="form-group{{ $errors->has('is_leaf_category') ? ' has-error' : '' }}">                            
                            {{ Form::label('is_leaf_category', '¿Admitirá exámenes?', array('class' => 'col-md-4 control-label')) }}
                            
                            <div class="col-md-6">
                                <select id="is_leaf_category" class="form-control" name="is_leaf_category" required autofocus>                                    
                                    <option value="1" <?php if($categoria->is_leaf_category)echo "selected"?>>Sí</option>
                                    <option value="0" <?php if(!$categoria->is_leaf_category)echo "selected"?>>No</option>   

                                </select>

                                @if ($errors->has('is_leaf_category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_leaf_category') }}</strong>
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
        </div>
    </div>
</div>
@endsection