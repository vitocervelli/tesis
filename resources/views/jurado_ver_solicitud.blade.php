
@extends('layout')

@section('content')
<section class="tema-ver container">
	    @if(is_null($s_jurado))
            <h1 class="error"> Todavia no se le ha realizado una solicitud de tutor al estudiante {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>
        @else

        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-left"><label>Proyecto:</label> {{$proyecto->titulo_proyecto}}</h1>
            </div>
            <div class="col-sm-12">
                <h1 class="text-left"><label>Linea de investigación:</label> {{$proyecto->linea_investigacion}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3> Estudiante: {{$estudiante->nombre}} {{$estudiante->apellido}}</h3>
                <h3> Correo: {{$estudiante->correo}}</h3>
                <h3> Telefono: {{$estudiante->telefono}}</h3>
                <h3> Cedula: {{$estudiante->cedula}}</h3>
            </div>
            <div class="col-sm-6">
                <h3> Tutor: {{$tutor->nombre}} {{$tutor->apellido}}</h3>
                <h3> Correo: {{$tutor->correo}}</h3>
                <h3> Telefono: {{$tutor->telefono}}</h3>
                <h3> Cedula: {{$tutor->cedula}}</h3>
            </div>

        </div>
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

        <a href="{{ $proyecto->proyecto }}" download target="_blank">
            <button class="btn btn-primary mt-4 mb-2"> Descargar Proyecto</button>
        </a>
        @endif
        <button class="btn btn-primary mt-4  mb-2" onclick="history.back(-1)">Regresar</button>
</section>


@endsection

