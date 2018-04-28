
@extends('layout')

@section('content')
<div class="tema-responder container">
  <h1 class="mt-3 mb-3">Por favor ingrese el nombre del tutor a buscar</h1>
  <form method="post"  enctype="multipart/form-data">



    {{ csrf_field() }}
  
       
          <div class="form-group">
              <label for="usr">Ingrese el nombre del tutor</label>
              <input type="text" class="form-control" name="nombre_tutor">
          </div>
          <div class="row">            
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary mb-2 float-sm-right">Enviar</button>
            </div>
          </div>


   </form>  

  <a href="/"><button class="btn btn-primary mb-2">Regresar</button></a>

</div>

@endsection


