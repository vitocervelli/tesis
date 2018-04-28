<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Observaciones;
use App\Solicitud_tutor;
use App\Encuentros;
use App\Mail\ObservacionEnviada;
use App\Mail\EnviarRespuestaSolicitudTutor;
use Illuminate\Support\Facades\Mail;

class Observacion extends Controller
{
    public function lista_estudiantes()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();


        $estudiantes_tutor = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id) ->where('solicitud_tutor.es_aceptado','=',1)->get();

        return view('observaciones_seleccionar_estudiante',compact('estudiantes_tutor'));
    }
    public function realizar_observaciones_estudiante($id_estudiante)
    {
        $estudiante= estudiante::find($id_estudiante);
        return view('observaciones_realizar',compact('estudiante'));
    }
    public function guardar_observaciones_estudiante(Request $request)
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $estudiante= estudiante::find($request->input('estudiante_id'));
        $observacion= new observaciones;
        $observacion->observaciones=$request->description;
        $observacion->estudiante_id= $request->input('estudiante_id');
        $observacion->fecha_observaciones =  date("Y-m-d");
        $observacion->tutor_id =$tutor->id;
        $observacion->save();
        $contenido = new \stdClass();
        $contenido->observaciones= $observacion->observaciones;
        $contenido->fecha_observaciones = $observacion->fecha_observaciones;
        $contenido->tutor_nombre = $tutor->nombre;
        $contenido->tutor_apellido= $tutor->apellido;
        Mail::to($estudiante->correo)->send(new  ObservacionEnviada($contenido));
        return view('observaciones_enviadas',compact('observacion','estudiante'));
    }
    public function ver_observaciones_estudiante($id_estudiante)
    {
        $observaciones= observaciones::where('estudiante_id', $id_estudiante)->get();

        foreach ($observaciones as $observacion){
            $observacion->observaciones=substr($observacion->observaciones, 0, 60);
        };
        $estudiante= estudiante::find($id_estudiante);
        return view('observaciones_estudiante',compact('observaciones','estudiante'));
    }
    public function ver_observacion($id_observacion)
    {
        $observaciones= observaciones::find($id_observacion);
        return view('observaciones_ver',compact('observaciones'));
    }
    public function observacion_estudiante()
    {
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $observaciones= observaciones::where('estudiante_id', $estudiante->id)->get();
        return view('observaciones',compact('observaciones'));
    }
}
