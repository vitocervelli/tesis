




<p>Hola {{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}}  </p>


<p> <strong>El estudiante {{$contenido->estudiante_nombre }} {{$contenido->estudiante_apellido}} </strong>ha respondido el siguiente tema de tesis</p>

<p> <strong>Titulo:</strong></p>
<p> {{ $contenido->titulo }} </p>
<p> <strong>Linea de Investigacion:</strong></p>
<p> {{ $contenido->linea_investigacion }} </p>
<p> <strong>Descripcion:</strong></p>
<p> {{ $contenido->descripcion }} </p>
<p> <strong>Estatus:</strong></p>
<p> {{ $contenido->estatus}} </p>
<p> <strong>Respuesta:</strong></p>
<p> {{ $contenido->respuesta }} </p>

<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para ver mas detalles</p>


