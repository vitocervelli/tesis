
@extends('layout')

@section('content')
  <div class="solicitud container">
    <table-tutores></table-tutores>
  <!--   <table class="table table-hover">
      <thead>
        <tr>
          <th colspan="2">Por favor {{ $estudiante->nombre }} {{ $estudiante->apellido }} seleccione a un profesor de la lista</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Profesor</td>
          <td>Linea de investigacion</td>
          <td> Seleccione </td>
        </tr>
        @forelse($tutores->sortBy($orden) as $tutor)
             <td>{{ $tutor->nombre }} {{ $tutor->apellido}}</td>
             <td>
             @foreach($tutor->lineas_investigacion as $linea_investigacion)
               {{ $linea_investigacion->linea_investigacion }}.  <br>

                 @endforeach
             </td>
             <td><a href="{{ route('enviar_solicitud_tutor',$tutor->id)}}"> Seleccionar </a></td>
          </tr>
        @empty
          <p>No hay tutores disponibles</p>
        @endforelse
        </tbody>
     </table> -->
   
<!--       @if(count($tutores))
      <div class="mt-2 mx-auto"> 
        {{ $tutores->links('pagination::bootstrap-4') }}
      </div>
      @endif -->

   <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
  </div>
@endsection
