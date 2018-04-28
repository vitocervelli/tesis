
@extends('layout')

@section('content')
    <div class="estudiante">
        <div class="welcome container">
            <div class="row">
                <div class="col-sm-12">
                    <h1> Bienvenido Tutor</h1>
                    <h2>{{$tutor->nombre}} {{$tutor->apellido}} </h2>

                    <p> Aqui puedes hacerle seguimiento a tus estudiantes</p>
                    <p> Revisar las solicitudes de tus estudiantes</p>
                    <p> Planificar reuniones</p>
                    <p> Solicitar jurados</p>
                    <p> Revisar Proyectos</p>

                </div>
            </div>
        </div>
        <div class="container-fluid select_area">
            <div class="row">
                <div class="button col-sm-4">
                    <a href="{{ route('jurado_lista_estudiantes')}}">     <button type="button" class="btn btn-info">Solicitar Jurado</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{ route('proyecto_estudiantes')}}"> <button type="button" class="btn btn-info">Revisar proyectos</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{ route('seleccionar_estudiante',$tutor->id)}}">   <button type="button" class="btn btn-info">Enviar tema de tesis</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid select_area">
            <div class="row">
                <div class="col-sm-4 button">
                    <a href="{{ route('solicitudes_estudiantes')}}"> <button type="button" class="btn btn-info">Ver solicitudes de estudiantes</button></a>
                </div>
                <div class="col-sm-4 button">
                    <a href="{{ route('lista_estudiantes_jurado')}}">  <button type="button" class="btn btn-info">Revisar jurado</button></a>
                </div>
                <div class="col-sm-4 button">
                    <a href="{{ route('lista_estudiantes_evaluacion')}}">  <button type="button" class="btn btn-info">Revisar evaluacion</button> </a>
                </div>
                <div class="col-sm-6 button">

                    <a href="{{ route('observaciones_lista_estudiantes')}}">    <button type="button" class="btn btn-secondary">Realizar observaciones</button></a>
                </div>
                <div class="col-sm-6 button">
                    <a href="{{ route('encuentros_estudiantes')}}">   <button type="button" class="btn btn-secondary">Ver encuentros</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="buzon">
        <table-buzon></table-buzon>
       <!--      <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="3">Buzon de notificaciones de encuentros y observaciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Fecha</td>
                    <td>Estudiante</td>
                    <td>Tipo de notificacion</td>
                    <td>Ver notifiacion </td>
                </tr>
                @forelse($notificaciones as $notifiacion)
                    <tr>
                        <td>{{ $notifiacion->fecha}}</td>
                        <td>{{ $notifiacion->nombre_estudiante}} {{ $notifiacion->apellido_estudiante}}</td>
                        <td>{{ $notifiacion->tipo }}</td>
                        <td><a href="{{ $notifiacion->url }}">Ver notifiacion </td>

                    </tr>
                @empty
                    <tr>
                        <td>---</td>
                        <td>No hay notificaciones</td>
                        <td>---</td>
                    </tr>
                @endforelse
                </tbody>
            </table> -->
        </div>
    </div>




@endsection