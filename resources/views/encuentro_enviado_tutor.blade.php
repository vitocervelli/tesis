
@extends('layout')

@section('content')
<div class="container tema-enviado">
	
    <h1>La solicitud de encuentro al tutor {{ $tutor->nombre }} {{ $tutor->apellido }} fue enviado sastifactoriamente</h1>
    <h1>Se le ha enviado un correo electonico al tutor para su notificacion con el siguiente mensaje</h1>
    <p>{{$encuentro->solicitud}}</p>
    <a href="{{route('home')}}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</div>

@endsection

