
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
  <table-tesistas></table-tesistas>
   <!-- <table class="table table-hover">
       <thead>
       <tr>
           <th colspan="2">Lista de tesistas que usted tiene asignado</th>
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>Estudiante</td>
           <td>Estatus</td>
           <td> Seleccione </td>

       </tr>
       @forelse($estudiantes_aceptados as $estudiante)
           <tr>
               <td>{{ $estudiante->nombre }} {{ $estudiante->apellido}}</td>
               <td>{{ $estudiante->estatus }}</td>
               <td><a href="{{ route('enviar_tema',['id_estudiante' => $estudiante->id,'id_tutor' => $id_tutor])}}"> Seleccione </a></td>
           </tr>
       @empty
           <tr>
              <td colspan="6">Hasta el momento no tienes ningún Estudiante asignado</td>
           </tr>
       @endforelse
       </tbody>
   </table>
 -->
   <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
  </section>
@endsection

