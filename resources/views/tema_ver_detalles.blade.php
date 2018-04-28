
@extends('layout')

@section('content')
<div class="tema-ver container">
  <h1 class="mt-3 mb-3">Tema enviado al estudiante {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>
  <h3>Titulo: <span>{{ $tema_tesis->titulo}}</span></h3>
  <h3>Linea de investigacion: <span>{{ $tema_tesis->linea_investigacion}}</span></h3>
  <h3>Descripcion: <span>{{ $tema_tesis->descripcion}}</span></h3>
  <h3>Estatus: <span>{{ $tema_tesis->estatus}}</span></h3>
  <h3>Respuesta: <span>{{ $tema_tesis->respuesta}}</span></h3>

  <a href="{{ URL::previous() }}"><button class="btn btn-primary mb-2">Regresar</button></a>

</div>

@endsection


