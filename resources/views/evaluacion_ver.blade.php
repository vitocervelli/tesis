
@extends('layout')

@section('content')
<section class="tema-ver container">

    @if(is_null($evaluacion))
        <h1 class="error"> El estudiante no tiene evaluacion registrada</h1>
     @else
        <h1>Proyecto</h1>
        <h3>Estudiante: <span>{{$proyecto->nombre_estudiante}}</span></h3>
        <h3>Tutor: <span>{{$proyecto->nombre_tutor}}</span></h3>
        <h3>Proyecto: <span>{{$proyecto->titulo_proyecto}}</span></h3>
        <h3>Linea de investigacion: <span>{{$proyecto->linea_investigacion}}</span></h3>

        <h1>Evaluacion del jurado</h1>
        <h3>Fecha de evaluacion: <span>{{$evaluacion->fecha_evaluacion}}</span></h3>
        <h3>Veredicto: <span>{{$evaluacion->veredicto}}</span></h3>
        <h3>Observaciones: <span>{{$evaluacion->observaciones}}</span></h3>

    @endif
            <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

