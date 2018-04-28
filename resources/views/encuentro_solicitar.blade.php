
@extends('layout')

@section('content')
<section class="container tema-enviado">
    
    @if($solicitud_tutor !=null)
        <form method="post"  enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="Textarea">Solicitar encuentro</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>

            <div class="d-none form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" name="tutor_id" value="{{ $tutor->id }}">

            </div>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-primary mb-2 float-right">Enviar</button>
              </div>
            </div>

        </form>

      @else
        <h1 class="error">No tienes tutor asignado todavia </h1>
     @endif

    <a href="{{URL::previous() }}"><button  class="btn btn-primary mb-2">Regresar</button></a>
</section>

@endsection

