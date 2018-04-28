




<p> <strong>El estudiante {{$contenido->nombre_estudiante}} </strong> ha colgado un proyecto con las siguientes descripciones </p>


<p> <strong>Titulo del proyecto</strong></p>
<p> {{ $contenido->titulo_proyecto }} </p>

<p> <strong>Estudiante:</strong></p>
<p> {{ $contenido->nombre_estudiante }} </p>

<p> <strong>Tutor:</strong></p>
<p> {{ $contenido->nombre_tutor}} </p>

<p> <strong>Linea de investigacion:</strong></p>
<p> {{ $contenido->linea_investigacion }} </p>

<p> <strong>Resumen:</strong></p>
<p> {{ $contenido->resumen}} </p>


<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para ver mas detalles</p>


