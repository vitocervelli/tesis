
@extends('layout')

@section('content')
    <section class="container lista-estudiantes">    
        @if(!is_null($tutor))
<!--         <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="2">Encuentros que has tenido con el tutor {{$tutor->nombre}} {{$tutor->apellido}}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> Fecha de solicitud</td>
                <td>Tipo de encuentro</td>
                <td>Fecha de encuentro</td>
                <td> Descripcion</td>
                <td> Duracion</td>
                <td>Respuesta</td>
                <td> Ver detalles</td>

            </tr>

            @forelse($encuentros as $encuentro)

                <tr>
                    <td>{{ $encuentro->fecha_solicitud }}</td>
                    <td>{{ $encuentro->metodo }}</td>
                    <td>{{ $encuentro->fecha_encuentros}}</td>
                    <td>{{ $encuentro->solicitud }}</td>
                    <td>{{ $encuentro->duracion}}</td>
                    <td>{{ $encuentro->respuesta}}</td>
                    <td><a href="{{ route('encuentro_ver',$encuentro->id)}}"> Ver solicitud</a></td>

                </tr>
            @empty
                <tr>
                    <td colspan="6">No ha recibido ningun tema hasta ahora</td>
                </tr>
            @endforelse
            </tbody>
        </table> -->
        <table-encuentros></table-encuentros>
        <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
        @else
            <h4>No tienes tutor asignado todavia</h4>
            <a href="{{URL::previous() }}"><button  class="btn btn-primary mb-2">Regresar</button></a>
        @endif
    </section>

@endsection

