@extends('layouts.layout')

@section('content')

<?php

use App\Categoria;
use App\User;

?>

<h1>Detalles del examen</h1><br>

<ul class="list-group">				       
	<li class="list-group-item">				
		<h2><span class="label label-info">Examen de {{ Categoria::findOrFail($examen->categoria)->getNombreCompleto() }}</span></h2>
		<p>{{ $examen->fecha }}</p><br>

		<h3>Preguntas:</h3><br>
		<?php $i = 1;?>
		@foreach($preguntas as $pregunta)
			<p><b>{{ $i }}. {{ str_replace("\n", "<br>", $pregunta->enunciado) }}</b></p>
			<p>{{ str_replace("\n", "<br>", $pregunta->solucion) }}</p><br>
			<?php $i++;?>		
		@endforeach

		@if(!Auth::guest() && ($examen->user_id == Auth::user()->id || 
		Auth::user()->hasRole('Admin')))

		<p><a href="{{ url('/examenes') }}/{{ $examen->id }}/edit" class="btn btn-primary btn-sm">Editar</a></p>		

		@endif
	</li>
</ul>

@stop