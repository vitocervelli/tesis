
@extends('layout')

@section('content')
<section class="respuesta-tutor container">
	
   <h1>El profesor {{ $tutor->nombre }} {{ $tutor->apellido }} a respondido a tu solicitud
   </h1>

   <h3>Tu mensaje: <span>{{ $solicitud->mensaje}}</span></h3>
   <h3> Estatus: <span> {{ $solicitud->estatus }}</span></h3>
   <h3>Respuesta: <span>{{ $solicitud->respuesta}}</span></h3>
  <a href="{{URL::previous()}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>

@endsection


