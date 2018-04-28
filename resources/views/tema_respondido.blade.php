
@extends('layout')

@section('content')
<section class="tema-respondido container">
	
    <h1>El tema {{$tema->titulo}} del tutor {{ $tutor->nombre }} {{ $tutor->apellido }} ha sido respondida</h1>
    <h1>Se le ha enviado un correo electonico al tutor con tu respuesta </h1>
    <a href="{{route('tema_ver')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

