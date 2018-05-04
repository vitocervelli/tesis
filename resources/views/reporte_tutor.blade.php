
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
    @if(!is_null($tutor))
    <input type="hidden" id="idTutor" name="idTutor" value="{{$tutor->id}}">
    <h1>Reporte del tutor {{$tutor->nombre}} {{$tutor->apellido}}</h1>
       {{--<table-reporte-tutor></table-reporte-tutor>--}}
      <table class="table table-hover">
           <thead>
           <tr>
               <th colspan="3"></th>
           </tr>
           </thead>
           <tbody>
           <tr>
               <td>Estudiante</td>
               <td>proyecto</td>
               <td>Solicitudes de jurado</td>

           </tr>

           @forelse($reportes as $reporte)
               @if(!is_null($reporte->nombre_estudiante) && !is_null($reporte->titulo_proyecto))
                   <tr>
                       <td>{{$reporte->nombre_estudiante}}</td>
                       <td><a href="{{ $reporte->proyecto}}">{{$reporte->titulo_proyecto}} </a></td>
                       <td> <a href="{{ route('ver_solicitud_tutor',['id_proyecto' => $reporte->id,'id_tutor' => $reporte->tutor_id])}}">Ver solicitud </a></td>

                   </tr>
                   @else
                   <tr>
                       <td colspan="3"> Hasta el momento el tutor  no tiene ningun reporte</td>
                   </tr>
                   @endif
           @empty
               <tr>
                  <td colspan="3"> Hasta el momento el tutor  no tiene ningun reporte</td>
               </tr>
           @endforelse
           </tbody>
       </table>
    @else
      <h1 class="error">El  tutor no esta registrado en el sistema, intente colocando solo el nombre del tutor</h1>
    @endif
        <button class="btn btn-primary mt-4  mb-2" onclick="history.back(-1)">Regresar</button>
  </section>
@endsection

