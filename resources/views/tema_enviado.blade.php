
@extends('layout')

@section('content')
	<section class="tema-enviado container">
	    <h1>El tema al estudiante {{ $estudiante->nombe }} {{ $estudiante->apellido }} fue enviado</h1>
	    <h1>Se le ha enviado un correo electonico al estudiante para su notificacion</h1>
	    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
	</section>

@endsection

