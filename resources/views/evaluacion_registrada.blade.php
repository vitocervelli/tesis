
@extends('layout')

@section('content')
<section class="tema-respondido container">
	
    <h1>La evaluacion del proyecto con titulo: {{$proyecto->titulo_proyecto}} del estudiante
        {{$proyecto->nombre_estudiante}} se ha registrado sastifactoriamente, se le ha notificado a traves de
        correo electronico al estudiante y tutor el resultado de la evaluacion
    </h1>
    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

