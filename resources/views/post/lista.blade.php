@extends('layouts.layout')

@section('content')

<?php

use App\Categoria;

?>

<h1>Posts</h1><br>

<form class="buscador" action="{{ url('/search') }}" method="GET">
	<input type="hidden" name="searchType" value="posts">
	<input type="search" name="query">
	<input class="btn btn-primary btn-sm" type="submit" value="Buscar">
</form>

<ul class="list-group">		
	@foreach ($posts as $post)		       
	<li class="list-group-item">	
		<h2><a href="/posts/{{ $post->id }}">{{ $post->titulo }}</a></h2>
		<p>{{ $post->resumen }}</p>				
		<p><span class="label label-info">{{ Categoria::findOrFail($post->categoria)->getNombreCompleto() }}</span></p>
	</li>
	@endforeach	

</ul>

	@if(!Auth::guest())

	<p><a href="/posts/create" class="btn btn-primary btn-sm">Añadir Post</a></p>

	@endif

@stop