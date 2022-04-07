@extends('layouts.layout')

@section('content')

@if (!Auth::guest())

<h1>Bienvenido {{ Auth::user()->name }}</h1>

@else

<h1>Bienvenido</h1>

@endif
@endsection
