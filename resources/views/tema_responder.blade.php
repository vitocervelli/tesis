
@extends('layout')

@section('content')
<div class="tema-responder container">
  <h1 class="mt-3 mb-3">Le esta respondiendo la solicitud del tema al tutor {{ $tutor->nombre }} {{ $tutor->apellido }}</h1>
  <form method="post"  enctype="multipart/form-data">

    <h3>Titulo: <span>{{ $tema_tesis->titulo}}</span></h3>
    <h3>Linea de investigacion: <span>{{ $tema_tesis->linea_investigacion}}</span></h3>
    <h3>Descripcion: <span>{{ $tema_tesis->descripcion}}</span></h3>

    {{ csrf_field() }}
  
      @if( !is_null($tema_tesis->es_aceptado))
        <h4 class="error"> Ya has respondido a esta solicitud</h4>
      @else
        @if($count_aceptado)
          <h4 class="error"> Ya has aceptado una solicitud de un tutor y no puedes realizar respuestas</h4>
        @elseif($tutor_bloqueado)          
          <h4 class="error"> Has rechazado mas de una solicitud de este tutor </h4>
        @else
          <div class="form-group">
            <label for="exampleSelect1">Acepta el tema?</label>
            <select name="estatus" class="form-control" id="exampleSelect1" required="required">
              <option value="1">Aceptada</option>
              <option value="0">Rechazada</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Textarea">Respuesta al tema de tesis</label>
            <textarea name="description" class="form-control" rows="5" required="required"></textarea>
          </div>
          <div class="d-none form-group">
              <label for="usr">Name:</label>
              <input type="text" class="form-control" name="tema_id" value="{{ $tema_tesis->id }}">
          </div>
          <div class="row">            
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
            </div>
          </div>
        @endif
      @endif

   </form>  

  <a href="{{ URL::previous() }}"><button class="btn btn-primary mb-2">Regresar</button></a>

</div>

@endsection


