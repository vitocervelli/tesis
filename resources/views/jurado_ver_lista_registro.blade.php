
@extends('layout')

@section('content')
<section class=" container">
    @if(is_null($solicitudes))
        <h1 class="error">No posees solicitudes de jurado hasta los momentos</h1>
    @else
        <table-jurado-registro></table-jurado-registro>
   <!--      <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="2">Lista de solicitudes de jurado</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Fecha solicitud</td>
                <td>Tutor</td>
                <td>Estudiante</td>
                <td> Proyecto</td>
                <td> Registrar Jurado</td>
                <td>Ver registro</td>

            </tr>

            @foreach($solicitudes as $items)

                <tr>
                    <td>{{ $items->fecha_envio }} </td>
                    <td>{{ $items->nombre}} {{ $items->apellido}}</td>
                    <td>{{ $items->nombre_estudiante }}</td>
                    <td>{{ $items->titulo_proyecto }}</td>
                    <td><a href="{{ route('registrar_jurado',$items->id)}}"> Registrar jurado</a></td>
                    <td><a href="{{ route('jurado_asignado',$items->id)}}">ver jurado asignado</a></td>
                </tr>
                @endforeach
            </tbody>
        </table> -->

    @endif
    <a href="/"><button class="btn btn-primary mb-2">Regresar</button></a>
</section>

@endsection

