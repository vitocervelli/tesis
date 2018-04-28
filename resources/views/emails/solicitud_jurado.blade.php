



<h1>Tienes una nueva solicitud de jurado</h1>

<p> Estudiante:<strong> {{$contenido->nombre_estudiante }} {{$contenido->apellido_estudiante}} </strong></p>
<p> Tutor:<strong> {{$contenido->nombre_tutor }} {{$contenido->apellido_tutor}} </strong></p>
<p> Proyecto:<strong> {{$contenido->proyecto }}</strong></p>
<p> Linea de investigacion:<strong> {{$contenido->linea_investigacion }} </strong></p>

<h1>Propuesta de jurado</h1>
<p> Jurado principal:<strong> {{$contenido->sugerencia_jurado_principal_1}}  </strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_principal_1 }}  </strong></p>
<p> Correo:<strong> {{$contenido->correo_jurado_principal_1 }}</strong></p>
<p> Jurado principal:<strong> {{$contenido->sugerencia_jurado_principal_2 }}</strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_principal_2 }} </strong></p>
<p> Correo:<strong> {{$contenido->correo_jurado_principal_2 }}</strong></p>
<p> Jurado suplente:<strong> {{$contenido->sugerencia_jurado_suplente_1}} </strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_suplente_1 }} </strong></p>
<p> Correo:<strong> {{$contenido->correo_jurado_suplente_1 }}</strong></p>
<p> Jurado suplente:<strong> {{$contenido->sugerencia_jurado_suplente_2 }}</strong></p>
<p> Institucion:<strong> {{$contenido->institucion_jurado_suplente_2}} </strong></p>
<p> Correo:<strong> {{$contenido->correo_jurado_suplente_2 }}</strong></p>


<p> Por favor ingresa a la pagina<a href="{{Request::root()}}">{{Request::root()}}</a>  para ver mas detalles</p>
