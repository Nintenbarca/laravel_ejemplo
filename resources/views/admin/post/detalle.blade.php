@extends('layouts.layout')

@section('content')

<?php

use App\Categoria;
use App\User;

?>

<ul class="list-group">				       
	<li class="list-group-item">	
		<h2>{{ $post->titulo }}</h2>		
		<p>{{ $post->contenido }}</p>			
		<p><span class="label label-info">{{ Categoria::findOrFail($post->categoria)->getNombreCompleto() }}</span></p>		
	</li>
</ul>

@stop