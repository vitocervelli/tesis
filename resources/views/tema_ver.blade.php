
@extends('layout')

@section('content')
<section class="tema-ver container">

    <h1> Solo puedes rechazar 2 veces un tema de tesis por cada profesor, si rechazas 2 veces el tema de tesis tienes que hacer una nueva solicitud de tutor </h1>
    <table-tema></table-tema>
   <!--  <table class="table table-hover">
        <thead>
        <tr>
            <th colspan="2">Temas de tesis recibidos</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td> Fecha de envio</td>
            <td>Linea de investigacion</td>
            <td>Titulo</td>
            <td> Descripcion</td>
            <td> Estatus</td>
            <td>Respuesta</td>
            <td>Tutor</td>
            <td> Responder</td>
        </tr>

        @forelse($tema_tesis as $tema)

            <tr>
                <td>{{ Carbon\Carbon::parse($tema->fecha_envio)->format('d-m-Y')  }}</td>
                <td>{{ $tema->linea_investigacion }}</td>
                <td>{{ $tema->titulo}}</td>
                <td>{{ $tema->descripcion }}</td>
                <td>{{ $tema->estatus}}</td>
                <td>{{ $tema->respuesta}}</td>
                <td>{{ $tema->nombre_tutor}} {{ $tema->apellido_tutor}}</td>
                <td>
                    <a href="{{ route('tema_responder',$tema->id)}}"> Responder</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">El estudiante no se le ha enviado ningun tema hasta ahora</td>
            </tr>
        @endforelse
        </tbody>
    </table>    --> 

    <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>

@endsection

