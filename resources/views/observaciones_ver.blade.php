
@extends('layout')

@section('content')
	<section class="lista-estudiantes container">
		<h1>Fecha de la observacion {{ $observaciones->fecha_observaciones}}</h1>
		<p>{{ $observaciones->observaciones}}</p>

		<a href="{{ URL::previous() }}"><button  class="btn btn-primary mb-2">Regresar</button></a>
	</section>
@endsection

