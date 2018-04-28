
@extends('layout')

@section('content')
    <div class="estudiante">
        <div class="welcome container">
            <div class="row">
                <div class="col-sm-12">
                    <h1> Bienvenido Estudiante </h1>
                    <h2>{{$estudiante->nombre}} {{$estudiante->apellido}} </h2>
                    <p> Aqui podras gestionar tu {{$estudiante->estatus}} </p>
                    <p> Realizar solicitudes  de tutor</p>
                    <p> Solicitar encuentros</p>
                    <p> Revisar observaciones de tu {{$estudiante->estatus}}  </p>
                </div>
            </div>
        </div>
        <div class="container-fluid select_area">
            <div class="row">
                <div class="button col-sm-4">
                    <a href="{{url('solicitar_tutor')}}"><button type="button" class="btn btn-info">Solicitar Tutor</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{route('proyecto_adjuntar')}}"> <button type="button" class="btn btn-info">Adjuntar proyecto</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{route('tema_ver')}}"> <button type="button" class="btn btn-info">Revisar tema de tesis</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid select_area">
            <div class="row">
                <div class="col-sm-4 button">
                    <a href="{{route('solicitar_encuentro')}}">  <button type="button" class="btn btn-info">Solicitar encuentro </button></a>
                </div>
                <div class="col-sm-4 button">
                    <a href="{{route('ver_jurado_estudiante')}}">  <button type="button" class="btn btn-info">Revisar jurado</button></a>
                </div>
                <div class="col-sm-4 button">
                    <a href="{{route('ver_evaluacion_estudiante')}}"><button type="button" class="btn btn-info">Revisar evaluacion</button></a>
                </div>
                <div class="col-sm-6 button">
                    <a href="{{route('observaciones')}}"> <button type="button" class="btn btn-secondary">Ver observaciones</button></a>
                </div>
                <div class="col-sm-6 button">
                    <a href="{{route('lista_encuentros')}}">   <button type="button" class="btn btn-secondary">Ver encuentro</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="buzon">
            <table-buzon></table-buzon>
<!--             <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="3">Buzon de notificaciones </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Fecha</td>
                    <td>Tipo de notificacion</td>
                    <td>Ver notificación</td>
                </tr>
                @forelse($notificaciones as $notifiacion)
                    <tr>
                        <td>{{ $notifiacion->fecha}}</td>
                        <td>{{ $notifiacion->tipo }}</td>
                        <td><a href="{{ $notifiacion->url }}">Ver notificación </td>

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