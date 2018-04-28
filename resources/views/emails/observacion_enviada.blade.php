




<p> <strong>El tutor(a) {{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}}</strong> te ha enviado la siguiente observacion </p>


<p> <strong>Fecha de las observaciones:</strong></p>
<p> {{ $contenido->fecha_observaciones }} </p>

<p> <strong>Observaciones:</strong></p>
<p> {{ $contenido->observaciones }} </p>


<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para ver mas detalles</p>


