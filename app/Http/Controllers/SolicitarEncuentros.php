<?php

namespace App\Http\Controllers;

use App\Mail\RespuestaEncuentro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Solicitud_tutor;
use App\Encuentros;
use App\Mail\SolicitarEncuentro;
use App\Mail\EnviarRespuestaSolicitudTutor;
use Illuminate\Support\Facades\Mail;

class SolicitarEncuentros extends Controller
{
    public function solicitar_encuentro()
    {
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $solicitud_tutor = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();

        if($solicitud_tutor!= null){
            $tutor=tutor::find($solicitud_tutor->tutor_id);
        }



        return view('encuentro_solicitar',compact('solicitud_tutor','tutor'));
    }
    public function ver_encuentro($id_encuentro)
    {
        $encuentro= encuentros::find($id_encuentro);
        $tutor=tutor::find($encuentro->tutor_id);
        $estudiante=Estudiante::find($encuentro->estudiante_id);
        return view('encuentro_ver',compact('encuentro','estudiante','tutor'));

    }
    public function encuentro_solicitado(Request $request)
    {
        $user = Auth::user();
        $estudiante=estudiante::where('user_id', $user->id)->first();
        $encuentro= new encuentros;
        $encuentro->solicitud=$request->description;
        $encuentro->estudiante_id= $estudiante->id;
        $encuentro->tutor_id = $request->input('tutor_id');
        $encuentro->fecha_solicitud = date("Y-m-d");
        $tutor=tutor::find($encuentro->tutor_id);
        $encuentro->save();
        $contenido = new \stdClass();
        $contenido->solicitud = $encuentro->solicitud;
        $contenido->estudiante_nombre = $estudiante->nombre;
        $contenido->estudiante_apellido= $estudiante->apellido;
        $contenido->tutor_nombre = $tutor->nombre;
        $contenido->tutor_apellido= $tutor->apellido;
        Mail::to($tutor->correo)->send(new SolicitarEncuentro( $contenido));
        return view('encuentro_enviado_tutor',compact('encuentro','tutor'));
    }
    public function lista_estudiantes()
    {
        $user = Auth::user();

        $tutor=tutor::where('user_id', $user->id)->first();
        $encuentros = encuentros::where('tutor_id', $tutor->id)->get();

        foreach ($encuentros as $encuentro){

            $estudiante=estudiante::find($encuentro->estudiante_id);
            $encuentro->estudiante_nombre= $estudiante->nombre;
            $encuentro->estudiante_apellido= $estudiante->apellido;
            $encuentro->solicitud=substr($encuentro->solicitud, 0, 60);
            $encuentro->respuesta=substr($encuentro->respuesta, 0, 60);

        };
        return view('encuentro_estudiantes',compact('encuentros'));

    }
    public function lista_encuentros()
    {
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $solicitud_tutor = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
        $tutor=null;
        $encuentros=null;
        if($solicitud_tutor!= null){
            $tutor=tutor::find($solicitud_tutor->tutor_id);
            $encuentros= encuentros::where('estudiante_id',$estudiante->id)->where('tutor_id',$tutor->id)->get();
        }


        return view('encuentro_lista',compact('encuentros','tutor'));


    }
    public function responder_encuentro($id_encuentro)
    {
        $encuentro= encuentros::find($id_encuentro);
        $tutor=tutor::find($encuentro->tutor_id);
        $estudiante=Estudiante::find($encuentro->estudiante_id);
        $respondido=0;

        if(!is_null($encuentro->fecha_encuentros)){
            $respondido = 1;
        }
        return view('encuentro_responder',compact('encuentro','estudiante','respondido'));

    }
    public function respondido_encuentro(Request $request)
    {
        $encuentro= encuentros::find($request->input('encuentro_id'));
        $encuentro->respuesta=$request->description;
        $encuentro->fecha_encuentros= $request->input('encuentro_fecha');
        $encuentro->fecha_encuentros = date("Y-m-d", strtotime($encuentro->fecha_encuentros));
        $encuentro->metodo = $request->input('tipo');
        $encuentro->duracion= $request->input('encuentro_duracion');

        $encuentro->save();


        $estudiante=estudiante::find($encuentro->estudiante_id);
        $tutor=tutor::find($encuentro->tutor_id);
        $contenido = new \stdClass();
        $contenido->fecha_solicitud = $encuentro->fecha_solicitud;
        $contenido->solicitud = $encuentro->solicitud;
        $contenido->respuesta = $encuentro->respuesta;
        $contenido->estudiante_nombre = $estudiante->nombre;
        $contenido->estudiante_apellido= $estudiante->apellido;
        $contenido->tutor_nombre = $tutor->nombre;
        $contenido->tutor_apellido= $tutor->apellido;
        $contenido->metodo=$encuentro->metodo;
        $contenido->fecha_encuentros=$encuentro->fecha_encuentros;
        Mail::to($estudiante->correo)->send(new RespuestaEncuentro( $contenido));
        return view('encuentro_respondido',compact('encuentro','estudiante'));

    }



}

