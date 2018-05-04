
@extends('layout')

@section('content')
<section class="tema-ver container">
	    @if(!is_null($jurado))
                <h1> El estudiante ya tiene un jurado asignado</h1>
            @else
             <p>Le esta registrando el jurado a {{$estudiante->nombre}} {{$estudiante->apellido}}</p>
            <p> tiene como tutor a {{$tutor->nombre}} {{$tutor->apellido}}
                <p>Proyecto: {{$proyecto->titulo_proyecto}}</p>

        <form method="post"  enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row">
                <div class="col-sm-4">
                    <label for="usr">jurado principal 1</label>
                    <input required  type="text" class="form-control" name="principal_1" value=" {{$s_jurado->sugerencia_jurado_principal_1}} ">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Institucion jurado principal 1</label>
                    <input required  type="text" class="form-control" name="institucion_principal_1" value=" {{$s_jurado->institucion_jurado_principal_1}}">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Correo jurado principal 1</label>
                    <input required  type="email" class="form-control" name="correo_principal_1"  value=" {{$s_jurado->correo_jurado_principal_1}} ">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label for="usr">Sugerencia jurado principal 2</label>
                    <input required  type="text" class="form-control" name="principal_2" value=" {{$s_jurado->sugerencia_jurado_principal_2}} ">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Institucion jurado principal 2</label>
                    <input required  type="text" class="form-control" name="institucion_principal_2" value=" {{$s_jurado->institucion_jurado_principal_2}}">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Correo jurado principal 2</label>
                    <input required  type="email" class="form-control" name="correo_principal_2" value=" {{$s_jurado->correo_jurado_principal_2}} ">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label for="usr">Sugerencia jurado suplente 1</label>
                    <input required type="text" class="form-control" name="suplente_1" value=" {{$s_jurado->sugerencia_jurado_suplente_1}} ">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Institucion jurado suplente 1</label>
                    <input required type="text" class="form-control" name="institucion_suplente_1" value=" {{$s_jurado->institucion_jurado_suplente_1}}">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Correo jurado suplente 1</label>
                    <input required type="email" class="form-control" name="correo_suplente_1" value=" {{$s_jurado->correo_jurado_suplente_1}} ">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="usr">Sugerencia jurado suplente 2</label>
                    <input required  type="text" class="form-control" name="suplente_2" value=" {{$s_jurado->sugerencia_jurado_suplente_2}} ">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Institucion jurado suplente 2</label>
                    <input  required type="text" class="form-control" name="institucion_suplente_2" value=" {{$s_jurado->institucion_jurado_suplente_2}}">
                </div>
                <div class="col-sm-4">
                    <label for="usr">Correo jurado suplente 2</label>
                    <input  required type="email" class="form-control" name="correo_suplente_2" value=" {{$s_jurado->correo_jurado_suplente_2}} ">
                </div>

            </div>
            <div class="d-none form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" name="solicitud_jurado_id" value="{{ $id_solicitud}}">
            </div>
            <div class="d-none form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" name="proyecto_titulo" value="{{ $proyecto->titulo_proyecto }}">
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary mt-4 mb-2 float-sm-right">Enviar</button>
                </div>
            </div>
        </form>

        @endif
            <a href="/"><button class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

