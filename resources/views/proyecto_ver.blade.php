
@extends('layout')

@section('content')
    <section class="solicitud-enviada container">
        @if(is_null($tema))
            <h1>Debes tener un tema aceptado antes de colgar un proyecto</h1>
        @else
            @if(!is_null($proyecto))
                <h1>Titulo proyecto: {{ $proyecto->titulo_proyecto }} </h1>

                <p><label>Estudiante:</label> <strong> {{ $proyecto->nombre_estudiante}}</strong></p>
                <p><label>Tutor:</label> <strong> {{ $proyecto->nombre_tutor}}</strong></p>
                <p><label>Linea de Investigacion: </label> <strong> {{ $proyecto->linea_investigacion}}</strong></p>
                <p><label>Resumen: </label> <strong> {{ $proyecto->resumen}}</strong></p>

                <a href="{{ $proyecto->proyecto }}" download target="_blank">
                    <button class="btn btn-primary mb-2"> Descargar Proyecto</button>
                </a>
                @if(!is_null($proyecto->proyecto_modificado ))
                    <a href="{{ $proyecto->proyecto_modificado }}" download target="_blank">
                        <button class="btn btn-primary mb-2"> Descargar Proyecto Modificado</button>
                    </a>
                @endif
            @else
                <h1>No ha colgado proyecto al sistema</h1>
            @endif
        @endif
        <a href="/">
          <button class="btn btn-primary mb-2"> Regresar</button>
        </a>
    </section>

@endsection


