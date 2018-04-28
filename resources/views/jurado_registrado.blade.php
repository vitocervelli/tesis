
@extends('layout')

@section('content')
<section class="tema-respondido container">
	
    <h1>El registro de usuario se ha realizado satisfactoriamente se le ha enviado un correo al tutor, al estudiante
        y a los miembros del jurado para su notifiacion
    </h1>
    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

