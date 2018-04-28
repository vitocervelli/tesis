
@extends('layout')

@section('content')
<section class="tema-respondido container">
	
    <h1>La solicitud de jurado del estudiante {{ $estudiante->nombre }} {{ $estudiante->apellido }} se ha realizado sastifactoriamente </h1>
    <h1>Se le ha enviado un correo electonico a la secretaria  {{ $secretaria->nombre }} {{ $secretaria->apellido }} para agendar la solicitud</h1>
    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

