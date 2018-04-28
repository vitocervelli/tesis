
@extends('layout')

@section('content')
<section class="container tema-ver">
  
  <h3 class="mt-4">Solicitud relizada por: <span>{{ $estudiante->nombre }} {{ $estudiante->apellido }} el {{ $encuentro->fecha_solicitud }}</span></h3>
  <h3>Para: <span>{{ $tutor->nombre }} {{ $tutor->apellido }}</span></h3>
  <h3>Mensaje del estudiante: <span>{{ $encuentro->solicitud}}</span></h3>

  <h3>Respuesta del tutor: <span>{{ $encuentro->respuesta}}</span></h3>
  <h3>Tipo de encuentro: <span>{{ $encuentro->metodo }}</span></h3>
  <h3>Duración: <span>{{ $encuentro->duracion}}</span></h3>
  <h3>Fecha del encuentro: <span>{{ $encuentro->fecha_encuentros}}</span></h3>
  <a href="{{ URL::previous() }}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>

@endsection

