
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
  <table-jurado></table-jurado>
<!--    <table class="table table-hover">
       <thead>
       <tr>
           <th colspan="3">Seleccione el estudiante al cual se le solicitará el jurado</th>
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>Estudiante</td>
           <td>Ver solicitud jurado</td>
           <td> Realizar solicitud jurado </td>

       </tr>
       @forelse($estudiantes_tutor as $estudiante)
           <tr>
               <td>{{ $estudiante->nombre }} {{ $estudiante->apellido}}</td>
               <td><a href="{{ route('ver_solicitud_jurado_estudiante', $estudiante->estudiante_id)}}"> Ver solicitud jurado</a></td>
               <td><a href="{{ route('realizar_solicitud_estudiante',$estudiante->estudiante_id)}}"> Realizar solicitud jurado </a></td>

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

