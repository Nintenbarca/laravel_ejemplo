@extends('layouts.layout')

@section('content')

<?php

use App\Categoria;
use App\User;

?>

<h1>Detalles del examen</h1><br>

<ul class="list-group">				       
	<li class="list-group-item">				
		<h2><span class="label label-info">{{ Categoria::findOrFail($examen->categoria)->getNombreCompleto() }}</span></h2>
		<p>{{ $examen->fecha }}</p><br>

		<h3>Preguntas:</h3><br>
		<?php $i = 1;?>
		@foreach($preguntas as $pregunta)
			<p><b>{{ $i }}. {{ str_replace("\n", "<br>", $pregunta->enunciado) }}</b></p>
			<p>{{ str_replace("\n", "<br>", $pregunta->solucion) }}</p><br>
			<?php $i++;?>
		@endforeach		
	</li>
</ul>

@stop