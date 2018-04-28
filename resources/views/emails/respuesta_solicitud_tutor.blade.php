




<p>Hola {{$contenido->estudiante_nombre }} {{$contenido->estudiante_apellido}}  </p>


@if ($contenido->es_aceptado)
    <p> <strong>El profesor {{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}} </strong>ha aceptado tu solicitud</p>

@else
    @if(!is_null($contenido->es_aceptado))
    <p> <strong>El profesor {{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}} </strong>ha rechazado tu solicitud</p>
    @endif
@endif
<p> <strong>Tienes la siguiente respuesta</strong></p>
<p> {{ $contenido->descripcion }} </p>

    @if ($contenido->es_aceptado)
        <p> Ingresa a la pagina <a href="{{Request::root()}}">{{Request::root()}}</a>  y planifica tus encuentros</p>
    @else
        <p> Para realizar una nueva solicitud ingrese a la pagina <a href="{{Request::root()}}">{{Request::root()}}</a> </p>
    @endif


