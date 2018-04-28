
@extends('layout')

@section('content')
    <div class="secretaria">
        <div class="welcome container">
            <div class="row">
                <div class="col-sm-12">
                    <h1> Bienvenida Secretaria</h1>
                    <h2>{{$secretaria->nombre}} {{$secretaria->apellido}} </h2>

                    <p> Aqui puedes hacerle seguimiento  a las solicitudes de jurado</p>
                    <p> Registrar evaluaciones</p>
                </div>
            </div>
        </div>
        <div class="container-fluid select_area">
            <div class="row">

                <div class="button col-sm-4">
                    <a href="{{ route('ver_solicitud_jurado_secretaria')}}">  <button type="button" class="btn btn-info">Revisar solicitudes de jurado</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{ route('lista_registrar_jurado')}}">  <button type="button" class="btn btn-info">Registrar jurado</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{ route('lista_registrar_evaluacion')}}">  <button type="button" class="btn btn-info">Registrar evaluacion</button></a>
                </div>
                <div class="button col-sm-4">
                  <a href="{{ route('seleccionar_tutor')}}"> <button type="button" class="btn btn-info">Busqueda por tutor</button></a>
                </div>

                <div class="button col-sm-4">
                    <a href="{{ route('r_seleccionar_estudiante')}}">  <button type="button" class="btn btn-info">Busqueda por estudiante</button></a>
                </div>
                <div class="button col-sm-4">
                    <a href="{{ route('seleccionar_jurado')}}">  <button type="button" class="btn btn-info">Busqueda por jurado</button></a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
        <table-buzon></table-buzon>
          <!--   <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="3">Buzon de notificaciones de encuentros y observaciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Fecha</td>
                    <td>Tutor</td>
                    <td>Tipo de notificacion</td>
                    <td>Ver notifiacion </td>
                </tr>
                @forelse($notificaciones as $notifiacion)
                    <tr>
                        <td>{{ $notifiacion->fecha}}</td>
                        <td>{{ $notifiacion->nombre_tutor}} {{ $notifiacion->apellido_tutor}}</td>
                        <td>{{ $notifiacion->tipo }}</td>
                        <td><a href="{{ route('detalle_solicitud_jurado',$notifiacion->solicitud_id)}}">Ver notificación </td>

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