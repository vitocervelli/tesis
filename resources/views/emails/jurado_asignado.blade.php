



<h1>Asignacion de jurado</h1>

<p> Estudiante:<strong> {{$contenido->estudiante }} </strong></p>
<p> Tutor:<strong> {{$contenido->tutor }}</strong></p>
<p> Proyecto:<strong> {{$contenido->titulo_proyecto }}</strong></p>
<p> Linea de investigacion:<strong> {{$contenido->linea_investigacion }} </strong></p>

<h1>Jurado</h1>
<p> Jurado principal:<strong> {{$contenido->principal_1}}  </strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_principal_1 }}  </strong></p>
<p> Correo:<strong> {{$contenido->correo_principal_1 }}</strong></p>
<p> Jurado principal:<strong> {{$contenido->principal_2 }}</strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_principal_2 }} </strong></p>
<p> Correo:<strong> {{$contenido->correo_principal_2 }}</strong></p>
<p> Jurado suplente:<strong> {{$contenido->suplente_1}} </strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_suplente_1 }} </strong></p>
<p> Correo:<strong> {{$contenido->correo_suplente_1 }}</strong></p>
<p> Jurado suplente:<strong> {{$contenido->suplente_2 }}</strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_suplente_2}} </strong></p>
<p> Correo:<strong> {{$contenido->correo_suplente_2 }}</strong></p>
<p> <a href="{{Request::root()}}{{$contenido->proyecto }}"> Descargar proyecto</a> </p>


