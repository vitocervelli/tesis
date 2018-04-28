
@extends('layout')

@section('content')
    <section class="tema-ver container">
        @if(!is_null($proyecto))
            @if(is_null($s_jurado))

                <h1>Le esta realizando una solicitud de jurado al estudiante {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>

                <h4>titulo proyecto:</h4>
                <p><strong>{{$proyecto->titulo_proyecto}}</strong></p>
                <h4>Linea de investigacion:</h4>
                <p><strong>{{$proyecto->linea_investigacion}}</strong></p>

                <form method="post"  enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="usr">Sugerencia jurado principal 1</label>
                            <input required  type="text" class="form-control" name="principal_1">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Institucion jurado principal 1</label>
                            <input required  type="text" class="form-control" name="institucion_principal_1">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Correo jurado principal 1</label>
                            <input required  type="email" class="form-control" name="correo_principal_1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="usr">Sugerencia jurado principal 2</label>
                            <input required  type="text" class="form-control" name="principal_2">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Institucion jurado principal 2</label>
                            <input required  type="text" class="form-control" name="institucion_principal_2">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Correo jurado principal 2</label>
                            <input required  type="email" class="form-control" name="correo_principal_2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="usr">Sugerencia jurado suplente 1</label>
                            <input required type="text" class="form-control" name="suplente_1">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Institucion jurado suplente 1</label>
                            <input required type="text" class="form-control" name="institucion_suplente_1">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Correo jurado suplente 1</label>
                            <input required type="email" class="form-control" name="correo_suplente_1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="usr">Sugerencia jurado suplente 2</label>
                            <input required  type="text" class="form-control" name="suplente_2">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Institucion jurado suplente 2</label>
                            <input  required type="text" class="form-control" name="institucion_suplente_2">
                        </div>
                        <div class="col-sm-4">
                            <label for="usr">Correo jurado suplente 2</label>
                            <input  required type="email" class="form-control" name="correo_suplente_2">
                        </div>
                    </div>
                    <div class="d-none form-group">
                        <label for="usr">Name:</label>
                        <input type="text" class="form-control" name="estudiante_id" value="{{ $estudiante->id }}">
                    </div>
                    <div class="d-none form-group">
                        <label for="usr">Name:</label>
                        <input type="text" class="form-control" name="proyecto_id" value="{{ $proyecto->id }}">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary mt-4 mb-2 float-sm-right">Enviar</button>
                        </div>
                    </div>

                </form>
                <a href="{{ $proyecto->proyecto }}" download target="_blank">
                    <button class="btn btn-primary mb-2"> Ver Proyecto</button>
                </a>
                @else
                <h1 class="error"> El estudiante ya tiene una solicitud de jurado por favor espere a que sea asignado</h1>
                @endif
        
        @else

            <h1 class="error"> El estudiante no tiene proyecto en el sistema, por tal motivo no puede solicitar jurado</h1>
        @endif
        <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
    </section>
@endsection

