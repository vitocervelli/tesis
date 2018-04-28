
@extends('layout')

@section('content')
    <section class="lista-estudiantes">
    <table-solicitudes-encuentros></table-solicitudes-encuentros>
        <!-- <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="2">Encuentros Solicitados por tus tesistas</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <td>Estudiante</td>
                <td> Fecha de solicitud</td>
                <td>Tipo de encuentro</td>
                <td>Fecha de encuentro</td>
                <td> Descripcion</td>
                <td> Duracion</td>
                <td>Respuesta</td>
                <td> Ver detalles</td>
                <td> Responder</td>

            </tr>

            @forelse($encuentros as $encuentro)

                <tr>
                    <td>{{ $encuentro->estudiante_nombre }} {{ $encuentro->estudiante_apellido }}</td>

                    <td>{{ $encuentro->fecha_solicitud }}</td>
                    <td>{{ $encuentro->metodo }}</td>
                    <td>{{ $encuentro->fecha_encuentros}}</td>
                    <td>{{ $encuentro->solicitud }}</td>
                    <td>{{ $encuentro->duracion}}</td>
                    <td>{{ $encuentro->respuesta}}</td>
                    <td><a href="{{ route('encuentro_ver',$encuentro->id)}}"> Ver encuentro</a></td>
                    <td><a href="{{ route('encuentro_responder',$encuentro->id)}}"> Responder</a></td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">Ningun estudiante le ha solicitado encuentros</td>
                </tr>
            @endforelse
            </tbody>
        </table> -->
        <a href="{{route('home')}}"><button class="btn btn-primary mb-2">Regresar</button></a>
    </section>
@endsection

