
@extends('layout')

@section('content')
<section class="tema-ver container">
	    @if(is_null($jurado))
                <h3 class="error"> El estudiante no tiene asignado un jurado hasta ahora</h3>

             @else
                 @if(!is_null($evaluacion))
                    <h3 class="error"> El estudiante ya tiene registrada una evaluacion</h3>
                 @else
                    <p>Le esta registrando la evaluacion a {{$proyecto->nombre_estudiante}} </p>
                    <p> tiene como tutor a {{$proyecto->nombre_tutor}} </p>
                    <p>Proyecto: {{$proyecto->titulo_proyecto}}</p>

                <form method="post"  enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="exampleSelect1">Veredicto del jurado</label>
                        <select name="veredicto" class="form-control" id="exampleSelect1">
                            <option value="Aceptada">Aceptada</option>
                            <option value="Rechazada">Rechazada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Textarea">Observaciones</label>
                        <textarea required  name="description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Fecha de evaluacion</label>
                        <input  required type="date" class="form-control" name="fecha_evaluacion">
                    </div>


                    <div class="d-none form-group">
                        <label for="usr">Name:</label>
                        <input type="text" class="form-control" name="jurado_id" value="{{$jurado->id}}">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
                        </div>
                    </div>

                </form>
            @endif
        @endif
            <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
</section>


@endsection

