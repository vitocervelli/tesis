
@extends('layout')

@section('content')
	<section class="tema-enviado container">
	    <h1> Se ha enviado las observaciones al estudiante {{ $estudiante->nombe }} {{ $estudiante->apellido }} </h1>
	    <h1>Se le ha enviado un correo electonico al estudiante para su notificación</h1>
		<h3>Fecha de la observación: {{ $observacion->fecha_observaciones}}</h3>
		<h3>Observaciones: <span>{{ $observacion->observaciones}}</span></h3>
	    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
	</section>

@endsection

