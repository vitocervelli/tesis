<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Solicitud_tutor;
use App\tema_tesis;
use App\Mail\RespuestaTemaTesis;
use App\Mail\EnviarTemaTesis;
use Illuminate\Support\Facades\Mail;

class TemaTesis extends Controller
{
    public function lista_estudiantes($id_tutor)
    {

        $estudiantes_aceptados = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$id_tutor)
            ->where('solicitud_tutor.es_aceptado','=',1)->distinct()
            ->get(['nombre','apellido','estudiante.id','estatus','telefono']);
        return view('tema_seleccionar_estudiante',compact('estudiantes_aceptados','id_tutor'));

    }
    public function enviar_tema($id_estudiante,$id_tutor)
    {
        $count = tema_tesis::where('tutor_id', $id_tutor)->where('estudiante_id', $id_estudiante)->where('es_aceptado',0)->count();
        $count_aceptado = tema_tesis::where('estudiante_id', $id_estudiante )->where('es_aceptado',1)->count();
        $tema_tesis = tema_tesis::where('tutor_id', $id_tutor)->where('estudiante_id', $id_estudiante)->get();
        $estudiante= estudiante::find($id_estudiante);
        $tutor= tutor::find($id_tutor);
        foreach ($tema_tesis as $tema)
        {
            if($tema->es_aceptado){
                $tema->estatus= "Aceptado";
            }else{
                if(!is_null($tema->es_aceptado )){
                    $tema->estatus= "Rechazado";
                }
            }
        }
        return view('tema_enviar',compact('tema_tesis','estudiante','tutor','count','count_aceptado'));

    }
    public function ver_detalle($tema_id)
    {
        $tema_tesis = tema_tesis::where('id', $tema_id)->first();
        $estudiante= estudiante::find($tema_tesis->estudiante_id);
        $tutor= tutor::find($tema_tesis->tutor_id);

        if($tema_tesis->es_aceptado){
            $tema_tesis->estatus= "Aceptado";
        }else{
            if(!is_null($tema_tesis->es_aceptado )){
                $tema_tesis->estatus= "Rechazado";
            }
        }
        
        return view('tema_ver_detalles',compact('tema_tesis','estudiante','tutor'));

    }
    public function guardar_tema(Request $request)
    {

        $tema_tesis= new tema_tesis;
        $tema_tesis->descripcion=$request->description;
        $tema_tesis->titulo=$request->input('titulo');
        $tema_tesis->linea_investigacion = $request->input('linea_investigacion');
        $tema_tesis->fecha_envio = date("Y-m-d");
        $tema_tesis->tutor_id = $request->input('tutor_id');
        $tema_tesis->estudiante_id = $request->input('estudiante_id');
        $estudiante= estudiante::find($tema_tesis->estudiante_id);
        $tutor= tutor::find($tema_tesis->tutor_id);
        $tema_tesis->save();

        $contenido = new \stdClass();
        $contenido->descripcion =  $tema_tesis->descripcion;
        $contenido->titulo = $tema_tesis->titulo;
        $contenido->linea_investigacion= $tema_tesis->linea_investigacion;
        $contenido->tutor_nombre = $tutor->nombre;
        $contenido->tutor_apellido= $tutor->apellido;
        $contenido->estudiante_nombre = $estudiante->nombre;
        $contenido->estudiante_apellido= $estudiante->apellido;

        Mail::to($estudiante->correo)->send(new EnviarTemaTesis( $contenido));


        return view('tema_enviado',compact('estudiante'));

    }
    public function ver_tema()
    {

        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $tema_tesis= tema_tesis::where('estudiante_id',$estudiante->id)->get();
        foreach ($tema_tesis as $tema)
        {
            $tutor = tutor::find($tema->tutor_id);
            $tema->nombre_tutor=$tutor->nombre;
            $tema->apellido_tutor=$tutor->apellido;
            $tema->descripcion=substr($tema->descripcion, 0, 60);
            $tema->respuesta=substr($tema->respuesta, 0, 60);
            if($tema->es_aceptado){
                $tema->estatus= "Aceptado";
            }else{
                if(!is_null($tema->es_aceptado )){
                    $tema->estatus= "Rechazado";
                }
            }
        }
        return view('tema_ver',compact('tema_tesis'));

    }
    public function responder_tema($tema_id)
    {

        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $count_aceptado = tema_tesis::where('estudiante_id', $estudiante->id )->where('es_aceptado',1)->count();
        $tema_tesis= tema_tesis::find($tema_id);
        $tutor = tutor::find($tema_tesis->tutor_id);

        $count = tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',0)->count();
        $tutor_bloqueado = $count > 1;
        return view('tema_responder',compact('tema_tesis','tutor','count_aceptado','tutor_bloqueado'));

    }
    public function respondido_tema(Request $request)
    {
        $tema = tema_tesis::find($request->input('tema_id'));
        $tutor = tutor::find($tema->tutor_id);
        $estudiante = estudiante::find($tema->estudiante_id);
        $tema->respuesta=$request->description;

            if( $request->input('estatus')==0){
                $tema->es_aceptado=0;
            }
            if($request->input('estatus')==1){
                $tema->es_aceptado=1;
            }


        $tema->save();
        if($tema->es_aceptado){
            $tema->estatus= "Aceptado";
        }else{
            if(!is_null($tema->es_aceptado )){
                $tema->estatus= "Rechazado";
            }
        }

        $count = tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',0)->count();
        if($count > 1){
            $solicitud = solicitud_tutor::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
            $solicitud->es_aceptado = 0;
            $solicitud->save();
        }

        $contenido = new \stdClass();
        $contenido->descripcion =  $tema->descripcion;
        $contenido->titulo = $tema->titulo;
        $contenido->linea_investigacion= $tema->linea_investigacion;
        $contenido->tutor_nombre = $tutor->nombre;
        $contenido->tutor_apellido= $tutor->apellido;
        $contenido->estudiante_nombre = $estudiante->nombre;
        $contenido->estudiante_apellido= $estudiante->apellido;
        $contenido->respuesta=$tema->respuesta;
        $contenido->estatus=$tema->estatus;

        Mail::to($tutor->correo)->send(new RespuestaTemaTesis( $contenido));

        return view('tema_respondido',compact('tutor','tema'));

    }

}
