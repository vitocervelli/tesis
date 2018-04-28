
@extends('layout')

@section('content')
<div class="responder-solicitud container">
  <h1>Le esta respondiendo la solicitud al estudiante {{ $estudiante->nombre }} {{ $estudiante->apellido }}
  </h1>

  <h3>Mensaje:</h3>
  <p>{{ $solicitud->mensaje}}</p>

  @if (!is_null($solicitud->es_aceptado))
    <h4 class="error">Ya has respondido a esta solicitud</h4>
  @elseif($solicitud_aceptada)
    <h4 class="error">Este estudiante ya tiene un tutor asignado</h4>
  @elseif($tutor_bloqueado)
    <h4 class="error">El estudiante ha rechazado mas de un tema</h4>
  @else
    <form method="post"  enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="exampleSelect1">Acepta la solicitud?</label>
        <select name="estatus" class="form-control" id="exampleSelect1">
          <option value="1">Aceptada</option>
          <option value="0">Rechazada</option>
        </select>
      </div>

      <div class="form-group">
        <label for="Textarea">Respuesta a la solicitud</label>
        <textarea name="description" class="form-control" rows="5"></textarea>
      </div>
      <div class="d-none form-group">
        <label for="usr">Name:</label>
        <input type="text" class="form-control" name="solicitud_id" value="{{ $solicitud->id }}">
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
  @endif

   <a href="{{URL::previous()}}"><button class="btn btn-primary mb-2">Regresar</button></a>
</div>

@endsection
