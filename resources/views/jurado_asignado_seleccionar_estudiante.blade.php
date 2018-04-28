
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
  <table-jurados></table-jurados>
<!--    <table class="table table-hover">
       <thead>
       <tr>
           <th colspan="3">Seleccione el estudiante al cual se le solicitará el jurado</th>
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>Estudiante</td>
           <td>Jurado Asignado</td>

       </tr>
       @forelse($estudiantes_tutor as $estudiante)
           <tr>
               <td>{{ $estudiante->nombre }} {{ $estudiante->apellido}}</td>
               <td><a href="{{ route('ver_jurado_estudiante_tutor', $estudiante->estudiante_id)}}"> Ver jurado</a></td>
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

