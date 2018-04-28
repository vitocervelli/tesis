




<p>Hola <strong>{{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}} </strong> tienes una nueva solicitud</p>

<p> <strong>El estudiante {{$contenido->estudiante_nombre }} {{$contenido->estudiante_apellido}} </strong>te ha seleccionado para que seas su tutor</p>

<p> <strong>Tienes el siguiente mensaje</strong></p>
<p> {{ $contenido->descripcion }} </p>

<p> Para responder por favor ingresa a la pagina <a href="{{Request::root()}}">{{Request::root()}}</a> </p>

