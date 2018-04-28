
@extends('layout')

@section('content')
<section class="tema-ver container">
    @if(is_null($jurado))
        <h1 class="error"> Todavia no se le ha registrado jurado al estudiante {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>
    @else
        <div class="row mt-4">
            <div class="col-sm-12">
                <h3> Proyecto: {{$proyecto->titulo_proyecto}}</h3>
                <h3> Linea de investigacion: {{$proyecto->linea_investigacion}}</h3>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-6">
                <h3> Estudiante: {{$estudiante->nombre}} {{$estudiante->apellido}}</h3>
                <h3> Correo: {{$estudiante->correo}}</h3>
                <h3> Telefono:{{$estudiante->telefono}}</h3>
                <h3> Cedula:{{$estudiante->cedula}}</h3>
            </div>
            <div class="col-sm-6">
                <h3> Tutor:{{$tutor->nombre}} {{$tutor->apellido}}</h3>
                <h3> Correo: {{$tutor->correo}}</h3>
                <h3> Telefono:{{$tutor->telefono}}</h3>
                <h3> Cedula:{{$tutor->cedula}}</h3>
            </div>
        </div>
        <h1 class="text-left">Jurado</h1>
        <div class="row mt-2">
            <div class="col-sm-4">
                <h3> Principal: {{$jurado->principal_1}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Institucion: {{$jurado->institucion_jurado_principal_1}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Datos de contacto:{{$jurado->correo_principal_1}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h3> Principal:{{ $jurado->principal_2}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Institucion: {{$jurado->institucion_jurado_principal_2}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Datos de contacto:{{$jurado->correo_principal_2}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h3> Suplente: {{ $jurado->suplente_1}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Institucion:{{$jurado->institucion_jurado_suplente_1}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Datos de contacto:{{$jurado->correo_suplente_1}}</h3>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-sm-4">
                <h3> Suplente: {{$jurado->suplente_2}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Institucion:{{$jurado->institucion_jurado_suplente_2}}</h3>
            </div>
            <div class="col-sm-4">
                <h3> Datos de contacto:{{$jurado->correo_suplente_2}}</h3>
            </div>
        </div>

        <a href="{{ $proyecto->proyecto }}" download target="_blank">
            <button class="btn btn-primary mb-2"> Descargar Proyecto</button>
        </a>
        @endif
        <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

