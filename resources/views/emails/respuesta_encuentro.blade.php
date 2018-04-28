




<p>Hola {{$contenido->estudiante_nombre }} {{$contenido->estudiante_apellido}}  </p>


<p> <strong>El tutor {{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}} </strong>ha respondido a la solicitud de encuentro</p>


<p> <strong>Fecha solicitud:</strong></p>
<p> {{ $contenido->fecha_solicitud }} </p>
<p> <strong>Solicitud de encuentro:</strong></p>
<p> {{ $contenido->solicitud }} </p>
<p> <strong>Respuesta:</strong></p>
<p> {{ $contenido->respuesta }} </p>
<p> <strong>Fecha de encuentro:</strong></p>
<p> {{ $contenido->fecha_encuentros }} </p>
<p> <strong>Tipo de encuentro:</strong></p>
<p> {{ $contenido->metodo }} </p>



<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para ver mas detalles</p>


