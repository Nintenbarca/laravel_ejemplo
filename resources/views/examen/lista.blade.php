@extends('layouts.layout')

@section('content')

<?php

use App\Categoria;

?>

<h1>Examenes</h1><br>

<form class="buscador" action="{{ url('/search') }}" method="GET">
    <input type="hidden" name="searchType" value="exams">
    <input type="search" name="query">
    <input class="btn btn-primary btn-sm" type="submit" value="Buscar">
 </form>

<ul class="list-group">		
	@foreach ($examenes as $examen)		       
	<li class="list-group-item">	
		<h2><a href="{{ route('examenes.show', $examen->id) }}">Examen de {{ Categoria::findOrFail($examen->categoria)->getNombreCompleto() }} del {{ $examen->fecha }}</a></h2>
	</li>
	@endforeach	

</ul>

	@if(!Auth::guest() && (Auth::user()->hasRole('Profesor') || Auth::user()->hasRole('Admin')))

	<p><a href="{{ route('examenes.create') }}" class="btn btn-primary btn-sm">Añadir Examen</a></p>

	@endif

@stop