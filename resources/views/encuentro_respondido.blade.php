
@extends('layout')

@section('content')
<section class="tema-respondido container">
	
    <h1>El encuentro del estudiante {{ $estudiante->nombre }} {{ $estudiante->apellido }} fue pautado para {{ $encuentro->fecha_encuentros }} </h1>
    <h1>Tipo de encuentro: {{ $encuentro->metodo }} </h1>
    <h1>Se le ha enviado un correo electonico al tutor con tu respuesta </h1>
    <a href="{{route('encuentros_estudiantes')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

