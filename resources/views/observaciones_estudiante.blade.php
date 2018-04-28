
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
  <table-observaciones-estudiante></table-observaciones-estudiante>
  <!--  <table class="table table-hover">
       <thead>
       <tr>
           <th colspan="2">Observaciones realizadas al estudiante {{ $estudiante->nombre }} {{ $estudiante->apellido}} </th>
       </tr>
       </thead>
       <tbody>
       <tr>
           <td>Fecha de observacion</td>
           <td>observacion</td>
           <td> ver detalles</td>

       </tr>
       @forelse($observaciones as $observacion)
           <tr>
               <td>{{ $observacion->fecha_observaciones}}</td>
               <td>{{ $observacion->observaciones}}</td>
               <td><a href="{{ route('ver_observacion',$observacion->id)}}"> Seleccione </a></td>
           </tr>
       @empty
           <tr>
              <td colspan="6">Hasta el momento no tienes ningun tesista asignado</td>
           </tr>
       @endforelse
       </tbody>
   </table> -->

   <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
  </section>
@endsection

