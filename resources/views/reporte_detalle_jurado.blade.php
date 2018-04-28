
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
    @if(!is_null($estudiante))
      <h1>Estudiante: {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>
      @if(!is_null($tutor))
        <h3>Tutor asignado: {{$tutor->nombre}} {{$tutor->apellido}}</h3>
      @endif      
      @if(!is_null($proyecto))
        <h1>Proyecto</h1>
        <h3>Titulo proyecto: {{ $proyecto->titulo_proyecto }}</h3>
        <h3>Estudiante: <span>{{ $proyecto->nombre_estudiante}}</span></h3>
        <h3>Tutor: <span>{{ $proyecto->nombre_tutor}}</span></h3>
        <h3>Linea de Investigacion: <span>{{ $proyecto->linea_investigacion}}</span></h3>
        <h3>Resumen: <span>{{ $proyecto->resumen}}</span></h3>
        <a href="{{ $proyecto->proyecto }}" download target="_blank">
          <button class="btn btn-primary mb-2"> Descargar Proyecto</button>
        </a>
        @if(!is_null($proyecto->proyecto_modificado ))
          <a href="{{ $proyecto->proyecto_modificado }}" download target="_blank">
            <button class="btn btn-primary mb-2"> Descargar Proyecto Modificado</button>
          </a>
        @endif
      @endif
      @if(!is_null($s_jurado))
        <h1>Jurado solicitado:</h1>
        <div class="row">
          <div class="col-sm-4">
            <h1 class="text-left"> Jurado </h1>
          </div>
          <div class="col-sm-4">
            <h1 class="text-left"> Institución </h1>
          </div>
          <div class="col-sm-4">
            <h1 class="text-left"> Datos de contacto </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h3> Principal: {{$s_jurado->sugerencia_jurado_principal_1}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->institucion_jurado_principal_1}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->correo_jurado_principal_1}}</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h3> Principal:{{ $s_jurado->sugerencia_jurado_principal_2}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->institucion_jurado_principal_2}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->correo_jurado_principal_2}}</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h3> Suplente: {{ $s_jurado->sugerencia_jurado_suplente_1}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->institucion_jurado_suplente_1}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->correo_jurado_suplente_1}}</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h3> Suplente: {{$s_jurado->sugerencia_jurado_suplente_2}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->institucion_jurado_suplente_2}}</h3>
          </div>
          <div class="col-sm-4">
            <h3> {{$s_jurado->correo_jurado_suplente_2}}</h3>
          </div>
        </div>
      @endif
      @if(!is_null($evaluacion))
        <h1>Evaluacion del jurado</h1>
        <div class="row">
          <div class="col-sm-4">
            <h3>Fecha de evaluacion: {{$evaluacion->fecha_evaluacion}}</h3>
          </div>
          <div class="col-sm-4">
            <h3>Veredicto: {{$evaluacion->veredicto}}</h3>
          </div>
        </div>        
        <div class="row">
          <div class="col-sm-4">
            <h3>Observaciones: {{$evaluacion->observaciones}}</h3>
          </div>
        </div>
      @endif
    @else
      <h1 class="error">La cedula del estudiante no esta registrada en el sistema</h1>
    @endif
      <button class="btn btn-primary mt-4  mb-2" onclick="history.back(-1)">Regresar</button>
  </section>
@endsection

