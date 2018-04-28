
@extends('layout')

@section('content')
<div class="solicitud-enviada container">

    <h1>La solicitud del estudiante {{ $estudiante->nombe }} {{ $estudiante->apellido }} ha sido respondida</h1>
    <h1>Se le ha enviado un correo electonico al estudiante con la respuesta </h1>
    <a href="{{route('solicitudes_estudiantes')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
	
</div>

@endsection

