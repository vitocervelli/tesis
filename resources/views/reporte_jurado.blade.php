
@extends('layout')

@section('content')
  <section class="lista-estudiantes container">
        <input type="hidden" id="idName" name="idName" value="{{$nombre}}">
        <h1>Busqueda por jurado {{$nombre}}</h1>
        <table-reporte-jurado></table-reporte-jurado>
<!--         <table class="table table-hover">
           <thead>
           <tr>
               <th colspan="3"></th>
           </tr>
           </thead>
           <tbody>
           <tr>
               <td>principal</td>
               <td>principal</td>
               <td>suplente</td>
               <td>suplente</td>
               <td>ver mas detalles</td>

           </tr>

           @forelse($reportes as $reporte)
              
                   <tr>
                      <td>{{$reporte->principal_1}}</td>
                      <td>{{$reporte->principal_2}}</td>
                      <td>{{$reporte->suplente_1}}</td>
                      <td>{{$reporte->suplente_2}}</td>
                       <td><a href="{{ route('reporte_jurado_detalles',['solicitud_jurado_id' => $reporte->solicitud_jurado_id,'jurado_id' => $reporte->jurado_id,'proyecto_id' => $reporte->proyecto_id])}}">ver detalles</a></td>
                   </tr>
           @empty
               <tr>
                  <td colspan="3">{{$nombre}} no ha sido seleccionado como jurado hasta los momentos</td>
               </tr>
           @endforelse
           </tbody>
       </table> -->

   <a href="/"><button  class="btn btn-primary mb-2">Regresar</button></a>
  </section>
@endsection

