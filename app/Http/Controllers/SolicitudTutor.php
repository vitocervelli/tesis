<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Solicitud_tutor;
use App\tema_tesis;
use App\Mail\EnviarSolicitudTutor;
use App\Mail\EnviarRespuestaSolicitudTutor;
use Illuminate\Support\Facades\Mail;


class SolicitudTutor extends Controller
{
    public function solicitar_tutor()
    {
        $tutores = tutor::paginate(5);
        $orden = 'nombre';
        $user = Auth::user();
        $estudiante = Estudiante::where('user_id', $user->id)->first();
        return view('solicitud_tutor',compact('tutores'))
            ->with('orden',$orden)
            ->with('estudiante',$estudiante);
    }
    public function enviar_tutor($id_tutor)
    {
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $solicitud_aceptada = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->count();
        $tutor= tutor::find($id_tutor);
        $count = tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',0)->count();
        $tutor_bloqueado = $count > 1;

        return view('enviar_tutor',compact('tutor','solicitud_aceptada','tutor_bloqueado'));
    }
    public function guardar_solicitud(Request $request)
    {
        //guarda la informacion en BD
        $user = Auth::user();
        $estudiante= Estudiante::where('user_id', $user->id)->first();

        $solicitud= new solicitud_tutor;
        $solicitud->mensaje=$request->description;
        $solicitud->estudiante_id= $estudiante->id;
        $solicitud->tutor_id = $request->input('tutor_id');
        $solicitud->fecha_solicitud = date("Y-m-d");
        $solicitud->save();
        // envia correo al tutor seleccionado
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $tutor= tutor::find($request->input('tutor_id'));
        $contenido = new \stdClass();
        $contenido->descripcion = $request->description;
        $contenido->estudiante_nombre = $estudiante->nombre;
        $contenido->estudiante_apellido= $estudiante->apellido;
        $contenido->tutor_nombre = $tutor->nombre;
        $contenido->tutor_apellido= $tutor->apellido;

        Mail::to($tutor->correo)->send(new EnviarSolicitudTutor( $contenido));
        return view('solicitud_tutor_enviada',compact('tutor'));
    }

    public function solicitudes_estudiantes()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $solicitudes = solicitud_tutor::where('tutor_id', $tutor->id)->get();

        foreach ($solicitudes as $solicitud) {
           $estudiante= estudiante::find($solicitud->estudiante_id);
            $solicitud->estudiante_nombre = $estudiante->nombre;
            $solicitud->estudiante_apellido= $estudiante->apellido;
            $solicitud->mensaje= substr($solicitud->mensaje, 0, 60);
            $solicitud->respuesta= substr($solicitud->respuesta, 0, 60);

            if($solicitud->es_aceptado){
                $solicitud->estatus= "Aceptado";
            }else{
                if(!is_null($solicitud->es_aceptado )){
                    $solicitud->estatus= "Rechazado";
                }
            }


        }


        return view('solicitudes_estudiantes',compact('solicitudes'));
    }
    public function responder_solicitud($id_solicitud)
    {
        $solicitud= solicitud_tutor::find($id_solicitud);
        $estudiante= estudiante::find($solicitud->estudiante_id);
        $tutor= tutor::find($solicitud->tutor_id);
        $solicitud_aceptada = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->count();
        $count = tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',0)->count();
        $tutor_bloqueado = $count > 1;
        return view('responder_solicitud_estudiante',compact('solicitud','estudiante','solicitud_aceptada','tutor_bloqueado'));

    }
    public function guardar_solicitud_estudiante(Request $request)
    {

        $solicitud = solicitud_tutor::find($request->input('solicitud_id'));

        $solicitud->respuesta=$request->description;

            if( $request->input('estatus')==0){
                $solicitud->es_aceptado=0;
            }
            if($request->input('estatus')==1){
                $solicitud->es_aceptado=1;
            }


        $solicitud->save();

          // envia correo al tutor seleccionado
          $tutor = tutor::where('user_id', Auth::user()->id)->first();
          $estudiante= estudiante::find($request->input('estudiante_id'));
          $contenido = new \stdClass();
          $contenido->descripcion = $request->description;
          $contenido->estudiante_nombre = $estudiante->nombre;
          $contenido->estudiante_apellido= $estudiante->apellido;
          $contenido->tutor_nombre = $tutor->nombre;
          $contenido->tutor_apellido= $tutor->apellido;
          $contenido->es_aceptado= $solicitud->es_aceptado;

      Mail::to($estudiante->correo)->send(new EnviarRespuestaSolicitudTutor( $contenido));
      return view('respuesta_solicitud_tutor_enviada',compact('estudiante'));
    }
    public function ver_solicitar_tutor($id_solicitud)
    {
        $solicitud= solicitud_tutor::find($id_solicitud);
        $tutor= tutor::find($solicitud->tutor_id);
        if( !is_null($solicitud->es_aceptado )  && $solicitud->es_aceptado==0 ){
            $solicitud->estatus="Rechazada";
        }
        if($solicitud->es_aceptado==1){
            $solicitud->estatus="Aceptada";
        }
        return view('ver_solicitud_tutor',compact('solicitud','tutor'));

    }


}
