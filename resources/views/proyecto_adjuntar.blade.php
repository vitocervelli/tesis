
@extends('layout')

@section('content')
<section class="tema-responder container">
  @if( $aceptado)
    @if(!is_null($tema))
      @if( $solicitud_jurado)
        <h1> Adjuntar proyecto con las correciones realizadas por el jurado (en caso de que exista)</h1>
        <form method="post"  enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
              <label class="control-label">Adjuntar Proyecto</label>
              <input type="file" accept="application/pdf" class="form-control" name="file" required="required">
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
              </div>
          </div>
          <div class="d-none form-group">
              <label for="usr">Name:</label>
              <input type="text" class="form-control" name="solicitud_jurado" value="{{ $solicitud_jurado }}">
          </div>
        </form>
      @else
        @if( !is_null($proyecto))
          <h1> Ya has colgado el proyecto anteriormente toma en cuenta que al guardar actualizaras el proyecto</h1>
        @endif

        <form method="post"  enctype="multipart/form-data">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" name="titulo" required="required">
          </div>
          <div class="form-group">
            <label for="Textarea">Resumen</label>
            <textarea name="description" class="form-control" rows="5" required="required"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Adjuntar Proyecto</label>
              <input type="file" accept="application/pdf" class="form-control" name="file" required="required">
          </div>
          <div class="row">
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
            </div>
          </div>
            <div class="d-none form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" name="solicitud_jurado" value="{{ $solicitud_jurado }}">
            </div>
        </form>
      @endif
    @else
      <h1>Debes tener un tema asignado antes de colgar un proyecto</h1>
    @endif
  @else
    <h1 class="mt-3 mb-3">No tienes ningun tutor asignado hasta los momentos, solicita un tutor o espera a ser aceptado para poder adjuntar el proyecto</h1>
  @endif

  {{ csrf_field() }}

  <a href="{{ URL::previous() }}"><button class="btn btn-primary mb-2">Regresar</button></a>
  
  @if( !is_null($proyecto))
    <a href="{{route('proyecto_ver')}}"> <button class="btn btn-primary mb-2">Ver proyecto</button></a>
  @endif

</section>

@endsection
