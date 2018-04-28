




<p>Hola {{$contenido->estudiante_nombre }} {{$contenido->estudiante_apellido}}  </p>


<p> <strong>El profesor {{$contenido->tutor_nombre }} {{$contenido->tutor_apellido}} </strong>Te ha enviado un tema pra tu tesis</p>

<p> <strong>Titulo:</strong></p>
<p> {{ $contenido->titulo }} </p>
<p> <strong>Linea de Investigacion:</strong></p>
<p> {{ $contenido->linea_investigacion }} </p>
<p> <strong>Descripcion:</strong></p>
<p> {{ $contenido->descripcion }} </p>

<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para aceptar o declinar el tema</p>


