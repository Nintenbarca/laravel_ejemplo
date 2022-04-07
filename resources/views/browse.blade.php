@extends('layouts.layout')

@section('content')

<?php 
use App\Categoria; 
$categorias = Categoria::getTree();?>

<table>	
	<tbody>
		@foreach($categorias as $etapa)
		<tr>
			<td>{{ $etapa->nombre }}</td>
			<td></td>
			<td></td>
			<td>
				&emsp;
				<a href="{{ url('/posts') }}/categoria/{{ $etapa->id }}" class="btn btn-primary btn-sm">Posts</a>
				<a href="{{ url('/examenes') }}/categoria/{{ $etapa->id }}" class="btn btn-primary btn-sm">Examenes</a>
			</td>
		</tr>
			@if(isset($etapa->children))
			@foreach($etapa->children as $curso)
			<tr>
				<td></td>
				<td>{{ $curso->nombre }}</td>
				<td></td>
				<td>
					&emsp;
					<a href="{{ url('/posts') }}/categoria/{{ $curso->id }}" class="btn btn-primary btn-sm">Posts</a>
					<a href="{{ url('/examenes') }}/categoria/{{ $curso->id }}" class="btn btn-primary btn-sm">Examenes</a>
				</td>
			</tr>
				@if(isset($curso->children))
				@foreach($curso->children as $asigntura)
				<tr>
					<td></td>
					<td></td>
					<td>{{ $asigntura->nombre }}</td>
					<td>
						&emsp;
						<a href="{{ url('/posts') }}/categoria/{{ $asigntura->id }}" class="btn btn-primary btn-sm">Posts</a>
						<a href="{{ url('/examenes') }}/categoria/{{ $asigntura->id }}" class="btn btn-primary btn-sm">Examenes</a>
					</td>
				</tr>
				@endforeach
				@endif
			@endforeach
			@endif
		@endforeach
	</tbody>
</table>

@endsection