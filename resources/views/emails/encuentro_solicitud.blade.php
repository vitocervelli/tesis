




<p>Hola <strong>{{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}} </strong> tienes una nueva solicitud de encuentro</p>

<p> <strong>El estudiante {{$contenido->estudiante_nombre }} {{$contenido->estudiante_apellido}} </strong>quiere planificar una reunion</p>

<p> <strong>Tienes el siguiente mensaje</strong></p>
<p> {{ $contenido->solicitud }} </p>

<p> Para responder por favor ingresa a la pagina <a href="{{Request::root()}}">{{Request::root()}}</a> </p>

