
@extends('layout')

@section('content')
    <section class="tema-enviar container">
        <table-temas-enviados></table-temas-enviados>
<!--         <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="2">Temas que se le ha enviado al estudiante {{$estudiante->nombre}} {{$estudiante->apellido}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fecha de envio</td>
                    <td>Linea de investigacion</td>
                    <td>Titulo</td>
                    <td>Descripcion</td>
                    <td>Estatus</td>
                    <td>Respuesta</td>
                    <td>Ver detalles</td>
                </tr>

                @forelse($tema_tesis as $tema)
                    <tr>
                        <td>{{ $tema->fecha_envio }}</td>
                        <td>{{ $tema->linea_investigacion }}</td>
                        <td>{{ $tema->titulo}}</td>
                        <td>{{ $tema->descripcion }}</td>
                        <td>{{ $tema->estatus}}</td>
                        <td>{{ $tema->respuesta}}</td>
                        <td>Ver solicitud</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="error">El estudiante no se le ha enviado ningun tema hasta ahora</td>
                    </tr>
                @endforelse
            </tbody>
        </table> -->
        @if($count<2)
            @if($count_aceptado==0)
            <form method="post"  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class=" form-group">
                    <label for="usr">Titulo</label>
                    <input type="text" class="form-control" name="titulo">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Linea de investigacion</label>
                    <select name="linea_investigacion" class="form-control" id="exampleSelect1">
                        @foreach($tutor->lineas_investigacion as $linea_investigacion)
                            <option value="{{ $linea_investigacion->linea_investigacion }}">{{ $linea_investigacion->linea_investigacion }}</option>
                        @endforeach
                    </select>



                </div>

                <div class="form-group">
                    <label for="Textarea">Descripcion</label>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                </div>

                <div class="d-none form-group">
                    <label for="usr">Name:</label>
                    <input type="text" class="form-control" name="tutor_id" value="{{ $tutor->id }}">

                </div>
                <div class="d-none form-group">
                    <label for="usr">Name:</label>
                    <input type="text" class="form-control" name="estudiante_id" value="{{ $estudiante->id }}">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary mb-2 float-right">Enviar</button>  
                    </div>                    
                </div>

            </form>
            @else
                <h4 class="error">El estudiante  {{$estudiante->nombre}} {{$estudiante->apellido}} ya ha aceptado un tema de tesis
                </h4>
            @endif
        @else
            <h4 class="error">El estudiante  {{$estudiante->nombre}} {{$estudiante->apellido}} a negado mas de {{$count}} veces los temas de tesis por tal motivo no se le podra enviar mas
            </h4>
        @endif
        <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
    </section>
@endsection

