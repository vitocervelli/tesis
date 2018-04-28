
@extends('layout')

@section('content')
	<section class="tema-enviado container">
	    <h1>El proyecto con titulo {{ $proyecto->titulo_proyecto }} ha sido guardado correctamente</h1>
	    <h1>Se le ha enviado un correo electonico al tutor {{ $proyecto->nombre_tutor}} para notificar sobre el proyecto
			adjuntado
		</h1>
	    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
	</section>

@endsection

