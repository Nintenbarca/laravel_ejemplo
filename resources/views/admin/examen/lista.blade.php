@extends('admin.layout')

@section('content')

<?php

use App\Categoria;

?>

<h1>
    EXAMENES
    <small>Listado</small>
</h1>

<form class="buscador" action="{{ url('/search') }}" method="GET">
    <input type="hidden" name="searchType" value="examenes">
    <input type="search" name="query">
    <input class="btn btn-primary btn-sm" type="submit" value="Buscar">
</form>

<div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de Examenes</h3>
            <a href="{{ url('/admin') }}/examen/create" class="btn btn-primary pull-right" data-toggle="modal">
                <i class="fa fa-plus"></i>
                Crear Examen
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>                     
                    <th>Fecha</th>                   
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($examenes as $examen)
                    <tr>
                        <td>{{ $examen->id }}</td>
                        <td><a href="{{ url('/admin') }}/examen/categoria/{{ $examen->categoria }}">{{ Categoria::findOrFail($examen->categoria)->getNombreCompleto() }}</a></td>
                        <td>{{ $examen->fecha }}</td>                                             
                        <td>
                            <a href="{{ url('/admin') }}/examen/{{ $examen->id }}" target="_blank"
                               class="btn btn-xs btn-default">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ url('/admin') }}/examen/{{ $examen->id }}/edit"
                               class="btn btn-xs btn-info">
                                <i class="fa fa-pencil"></i>
                            </a>                            
                            <form action="{{ url('/admin') }}/examen/{{ $examen->id }}"
                                method="POST" style="display: inline">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-xs btn-danger"
                                    onclick="return confirm('¿Seguro que quiere eliminar esta publicacion?')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection