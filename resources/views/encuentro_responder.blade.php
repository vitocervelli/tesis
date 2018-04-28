
@extends('layout')

@section('content')
<section class="tema-respondido container">
    
    @if(!$respondido)
        <h1>Encuentro solicitado por {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>
            <h1>{{$encuentro->descripcion}}</h1>
        <form method="post"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleSelect1">Tipo de encuentro</label>
                <select name="tipo" class="form-control" id="exampleSelect1">
                    <option value="presencial">Presencial</option>
                    <option value="skype">Skype</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Textarea">Respuesta al encuentro</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Fecha de encuentro</label>
                <input type="date" class="form-control" name="encuentro_fecha">
            </div>
            <div class="form-group">
                <label for="usr">Duracion:</label>
                <input type="text" class="form-control" name="encuentro_duracion">
            </div>
            <div class="d-none form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" name="encuentro_id" value="{{ $encuentro->id }}">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
                </div>
            </div>
        </form>
        <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
        @else
        <h1> Ya usted le respondio el encuentro al {{$estudiante->nombre}} {{$estudiante->apellido}} para ver los detalles
            seleccione ver detalles en la tabla de encuentros
        </h1>
        <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
    @endif
</section>
@endsection

