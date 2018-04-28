
@extends('layout')

@section('content')
<section class=" container">
	    @if(is_null($solicitudes))
                <h1> No posees solicitudes de jurado hasta los momentos</h1>
            @else
        <table-evaluacion></table-evaluacion>
     <!--    <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="2">Lista de estudiante con solicitudes de jurado</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Fecha solicitud</td>
                <td>Tutor</td>
                <td>Estudiante</td>
                <td> Proyecto</td>
                <td> Registrar Evaluacion</td>
                <td>Ver Evaluacion</td>

            </tr>

            @foreach($solicitudes as $items)

                <tr>
                    <td>{{ $items->fecha_envio }} </td>
                    <td>{{ $items->nombre}} {{ $items->apellido}}</td>
                    <td>{{ $items->nombre_estudiante }}</td>
                    <td>{{ $items->titulo_proyecto }}</td>
                    <td><a href="{{ route('registrar_evaluacion',$items->id)}}"> Registrar evaluacion</a></td>
                    <td><a href="{{ route('ver_evaluacion',$items->id)}}">ver evaluacion</a></td>
                </tr>
                @endforeach
            </tbody>
        </table> -->

        @endif
            <a href="/"><button class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

