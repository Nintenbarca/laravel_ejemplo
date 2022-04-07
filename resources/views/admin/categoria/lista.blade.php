@extends('admin.layout')

@section('content')

<h1>
    CATEGORIAS
    <small>Listado</small>
</h1>

<div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de Categorias</h3>
            <a href="{{ url('/admin') }}/categoria/create" class="btn btn-primary pull-right" data-toggle="modal">
                <i class="fa fa-plus"></i>
                Crear Categoria
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th> 
                </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->getNombreCompleto() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

{!! $categorias->render() !!}

@endsection