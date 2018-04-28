<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Secretaria;
use App\Solicitud_jurado;
use App\Solicitud_tutor;
use App\Jurado;
use App\Mail\EnviarEvaluacion;
use Illuminate\Support\Facades\Mail;
use App\Proyecto;
use App\Evaluacion;

class Evaluaciones extends Controller
{
    public function lista_registrar_evaluacion()
    {
        $solicitudes= solicitud_jurado::join("proyecto","proyecto_id","=","proyecto.id")
            ->join("tutor","solicitud_jurado.tutor_id","=","tutor.id")
            ->get(['solicitud_jurado.id','tutor.nombre','tutor.apellido','proyecto.titulo_proyecto','solicitud_jurado.fecha_envio','proyecto.nombre_estudiante']);

        return view('evaluacion_seleccionar_lista',compact('solicitudes'));
    }
    public function registrar_evaluacion($id_solicitud_jurado)
    {
        $evaluacion=null;
        $jurado = jurado::where('solicitud_jurado_id', $id_solicitud_jurado)->first();
        if(!is_null($jurado)){
            $s_jurado = solicitud_jurado::find($id_solicitud_jurado);
            $proyecto = proyecto::find($s_jurado->proyecto_id);
            $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
        }

        return view('evaluacion_registrar',compact('jurado','proyecto','evaluacion'));
    }
    public function guardar_evaluacion(Request $request)
    {
        $secretaria = secretaria::where('user_id', Auth::user()->id)->first();
        $evaluacion= new evaluacion;
        $evaluacion->observaciones=$request->description;
        $evaluacion->veredicto= $request->input('veredicto');
        $evaluacion->fecha_evaluacion=  $request->input('fecha_evaluacion');
        $evaluacion->jurado_id = $request->input('jurado_id');
        $evaluacion->secretaria_id = $secretaria->id;
        $evaluacion->save();
        $jurado = jurado::find($evaluacion->jurado_id);
        $s_jurado = solicitud_jurado::find($jurado->solicitud_jurado_id);
        $tutor = tutor::find($s_jurado->tutor_id);
        $proyecto = proyecto::find($s_jurado->proyecto_id);
        $estudiante = estudiante::find($proyecto->estudiante_id);
        $evaluacion->tutor= $proyecto->nombre_tutor;
        $evaluacion->estudiante=$proyecto->nombre_estudiante;
        $evaluacion->linea_investigacion=$proyecto->linea_investigacion;
        $evaluacion->proyecto=$proyecto->titulo_proyecto;
        Mail::to($estudiante->correo)->send(new EnviarEvaluacion( $evaluacion));
        Mail::to($tutor->correo)->send(new EnviarEvaluacion( $evaluacion));
        return view('evaluacion_registrada',compact('proyecto'));
    }
    public function ver_evaluacion($id_solicitud_jurado)
    {
        $evaluacion=null;
        $proyecto=null;
        $jurado = jurado::where('solicitud_jurado_id', $id_solicitud_jurado)->first();
        if(!is_null($jurado)){
            $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
            $s_jurado = solicitud_jurado::find($id_solicitud_jurado);
            $proyecto = proyecto::find($s_jurado->proyecto_id);

        }
        return view('evaluacion_ver',compact('proyecto','evaluacion'));
    }
    public function ver_evaluacion_estudiante()
    {

        $jurado=null;
        $s_jurado=null;
        $evaluacion=null;
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        if(!is_null($proyecto)){
            $s_jurado= solicitud_jurado::where('proyecto_id', $proyecto->id)->first();
            if(!is_null($s_jurado)){
                $jurado= jurado::where('solicitud_jurado_id', $s_jurado->id)->first();
                if(!is_null($jurado)){
                    $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
                }
            }
        }
        return view('evaluacion_ver',compact('proyecto','evaluacion'));
    }
    public function lista_estudiantes_evaluacion()
    {

        $tutor = tutor::where('user_id', Auth::user()->id)->first();

        $estudiantes_tutor = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id) ->where('solicitud_tutor.es_aceptado','=',1)
            ->get();
        return view('evaluacion_seleccionar_estudiante',compact('estudiantes_tutor'));
    }
    public function ver_evaluacion_estudiante_tutor($id_estudiante)
    {

        $jurado=null;
        $s_jurado=null;
        $evaluacion=null;
        $estudiante = estudiante::find($id_estudiante);
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        if(!is_null($proyecto)) {
            $s_jurado = solicitud_jurado::where('proyecto_id', $proyecto->id)->first();

            if (!is_null($s_jurado)) {
                $jurado = jurado::where('solicitud_jurado_id', $s_jurado->id)->first();
                if(!is_null($jurado)){
                    $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
                }
            }
        }
        return view('evaluacion_ver',compact('proyecto','evaluacion'));
    }



}
