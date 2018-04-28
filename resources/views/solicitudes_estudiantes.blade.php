
@extends('layout')

@section('content')
<div class="container">
  <table-solicitudes></table-solicitudes>
<!--    <table class="table table-hover">
       <thead>
         <tr>
            <th colspan="2">Lista de solicitudes de tutor realizadas por estudiantes</th>
         </tr>
       </thead>
       <tbody>
       <tr>
           <td>Estudiante</td>
           <td>Mensaje</td>
           <td> Estatus</td>
           <td> Respuesta</td>
           <td> Fecha solicitud</td>
           <td> Ver solicitud</td>
       </tr>

       @forelse($solicitudes  as $solicitud)

          <tr>
            <td>{{ $solicitud->estudiante_nombre }} {{ $solicitud->estudiante_apellido}}</td>
            <td>{{ $solicitud->mensaje }}...</td>
            <td>{{ $solicitud->estatus }}</td>
            <td>{{ $solicitud->respuesta }}</td>
            <td>{{ $solicitud->fecha_solicitud}}</td>
            <td><a href="{{ route('responder_solicitud_estudiante',$solicitud->id)}}"> Ver solicitud</a></td>
          </tr>
       @empty
          <tr>
            <td colspan="6" class="error">No hay solicitudes de estudiantes</td>
          </tr>
       @endforelse
       </tbody>
   </table> -->
   <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
</div>
@endsection

