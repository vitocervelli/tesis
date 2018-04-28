
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
  <table-observacion></table-observacion>
   <!-- <table class="table table-hover">
       <thead>
       <tr>
           <th colspan="3">Seleccione el estudiante al cual le enviara la observacion</th>
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>Estudiante</td>
           <td>Ver observaciones</td>
           <td> Realizar observacion </td>

       </tr>
       @forelse($estudiantes_tutor as $estudiante)
           <tr>
               <td>{{ $estudiante->nombre }} {{ $estudiante->apellido}}</td>
               <td><a href="{{ route('ver_observaciones_estudiante', $estudiante->estudiante_id)}}"> Ver observaciones</a></td>
               <td><a href="{{ route('realizar_observaciones_estudiante',$estudiante->estudiante_id)}}"> Realizar observaciones </a></td>

           </tr>
       @empty
           <tr>
              <td colspan="3"> Hasta el momento no tienes ningun tesista asignado</td>
           </tr>
       @endforelse
       </tbody>
   </table> -->

   <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
  </section>
@endsection

