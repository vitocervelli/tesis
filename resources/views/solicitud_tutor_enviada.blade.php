
@extends('layout')

@section('content')
	<div class="solicitud-enviada container">
		<h1>Solicitud de tutor a {{ $tutor->nombe }} enviada</h1>
		<h1>Se le ha enviado un correo electonico al profesor seleccionado la respuesta sera mostrada en el buzon de notificaciones</h1>
		
	    <a href="{{route('solicitar_tutor')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
    </div>

@endsection

