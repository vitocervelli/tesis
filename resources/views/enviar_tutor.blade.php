@extends('layout')

@section('content')
  <div class="enviartutor container">
    @if($solicitud_aceptada)
        <h1 class="error">No puedes realizar la solicitud debido a que ya tienes un tutor asignado</h1>
    @elseif($tutor_bloqueado)
        <h1 class="error">No puedes realizar la solicitud debido a que has superado el limite de temas rechazado a este tutor</h1>
    @else
    <h1 class="mt-5">Estudiante {{ Auth::user()->name }} usted ha seleccionado al profesor(a) {{ $tutor->nombre }}
    </h1>
    <form method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="Textarea">Por favor complete su solicitud enviandole un mensaje:</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="d-none form-group">
            <label for="tutor_id"></label>
            <input type="text" class="form-control" name="tutor_id" value="{{ $tutor->id }}">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary mb-2 float-right">Enviar</button>
            </div>
        </div>
    </form>
    @endif
    <a href="{{ URL::previous() }}"><button  class="btn btn-primary mt-5 mb-2">Regresar</button></a>
  </div>
@endsection
