
@extends('layout')

@section('content')
<section class="tema-ver container">
    
    <h1>Le esta realizando una observacion al estudiante {{$estudiante->nombre}} {{$estudiante->apellido}}</h1>
    <form method="post"  enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="Textarea">Observaciones</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>

        <div class="d-none form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" name="estudiante_id" value="{{ $estudiante->id }}">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
            </div>
        </div>

    </form>
    <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>

</section>
@endsection

