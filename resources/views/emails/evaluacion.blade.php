



<h1>Evaluacion del jurado</h1>

<p> Estudiante:<strong> {{$contenido->estudiante }}  </strong></p>
<p> Tutor:<strong> {{$contenido->tutor }}  </strong></p>
<p> Proyecto:<strong> {{$contenido->proyecto }}</strong></p>
<p> Linea de investigacion:<strong> {{$contenido->linea_investigacion }} </strong></p>

<p> Fecha de evaluacion:<strong> {{$contenido->fecha_evaluacion}}</strong></p>
<p> veredicto<strong> {{$contenido->veredicto}}  </strong></p>
<p> observaciones:<strong> {{$contenido->observaciones }}  </strong></p>



<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para ver mas detalles</p>
