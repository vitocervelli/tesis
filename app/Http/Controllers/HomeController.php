<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Secretaria;
use App\Solicitud_tutor;
use App\tema_tesis;
use App\Encuentros;
use App\Observaciones;
use App\Proyecto;
use App\Solicitud_jurado;
use App\Jurado;
use App\Evaluacion;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();



        if($user->rol=='estudiante'){
            $estudiante = estudiante::where('user_id', $user->id)->first();
            $solicitud_tutor= solicitud_tutor::where('estudiante_id', $estudiante->id)
                                                ->whereNotNull('es_aceptado')->get();
            $tema_tesis=tema_tesis::where('estudiante_id', $estudiante->id)->get();
            $encuentros=encuentros::where('estudiante_id', $estudiante->id)  ->whereNotNull('fecha_encuentros')->get();;
            $observaciones= observaciones::where('estudiante_id', $estudiante->id)->get();

            $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
            $jurado=null;
            $s_jurado=null;
            $evaluacion=null;
            if(!is_null($proyecto)){
                $s_jurado= solicitud_jurado::where('proyecto_id', $proyecto->id)->first();
                if(!is_null($s_jurado)){
                    $jurado= jurado::where('solicitud_jurado_id', $s_jurado->id)->first();
                    if(!is_null($jurado)){
                        $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
                    }
                }
            }



            $notificaciones=[];
            $notificacion=new \stdClass();
            foreach ($solicitud_tutor as $solicitud) {
                $notificacion->tipo= "Solicitud de Tutor";
                $notificacion->fecha= $solicitud->fecha_solicitud;
                $notificacion->url= route('ver_solicitud_tutor',$solicitud->id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($tema_tesis as $solicitud) {
                $notificacion->tipo= "Tema de tesis";
                $notificacion->fecha= $solicitud->fecha_envio;
                $notificacion->url= route('tema_responder',$solicitud->id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($encuentros as $solicitud) {
                $notificacion->tipo= "Solicitud de encuentro";
                $notificacion->fecha= $solicitud->fecha_solicitud;

                $notificacion->url= route('encuentro_ver',$solicitud->id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($observaciones as $solicitud) {
                $notificacion->tipo= "Observaciones";
                $notificacion->fecha= $solicitud->fecha_observaciones;

                $notificacion->url= route('ver_observacion',$solicitud->id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            if(!is_null($jurado)){
                $notificacion=new \stdClass();
                $notificacion->tipo= "Jurado Asignado";
                $notificacion->fecha= $jurado->fecha_asignacion;

                $notificacion->url= route('ver_jurado_estudiante') ;
                array_push($notificaciones,$notificacion);

            }
            if(!is_null($evaluacion)){
                $notificacion=new \stdClass();
                $notificacion->tipo= "Registro de evaluacion";
                $notificacion->fecha= $evaluacion->fecha_evaluacion;

                $notificacion->url= route('ver_evaluacion_estudiante') ;
                array_push($notificaciones,$notificacion);
            }


            return view('estudiante',compact('estudiante','notificaciones'));
            //return view('home');
        }
        if($user->rol=='tutor'){
            $tutor = tutor::where('user_id', $user->id)->first();
            $solicitud_tutor= solicitud_tutor::where('tutor_id', $tutor->id)->get();
            $encuentros=encuentros::where('tutor_id', $tutor->id)->get();
            $proyectos=proyecto::where('tutor_id', $tutor->id)->get();
            $tema_tesis=tema_tesis::where('tutor_id', $tutor->id)->whereNotNull('es_aceptado')->get();
            $s_jurado= solicitud_jurado::where('tutor_id', $tutor->id)->get();
            $notificaciones=[];
            $notificacion=new \stdClass();
            foreach ($solicitud_tutor as $solicitud) {
                $estudiante= estudiante::find($solicitud->estudiante_id);
                $notificacion->nombre_estudiante= $estudiante->nombre;
                $notificacion->apellido_estudiante= $estudiante->apellido;
                $notificacion->tipo= "Solicitud de Tutor";
                $notificacion->fecha= $solicitud->fecha_solicitud;
                $notificacion->url= route('responder_solicitud_estudiante',$solicitud->id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($tema_tesis as $solicitud) {
                $estudiante= estudiante::find($solicitud->estudiante_id);
                $notificacion->nombre_estudiante= $estudiante->nombre;
                $notificacion->apellido_estudiante= $estudiante->apellido;
                $notificacion->tipo= "Tema Tesis";
                $notificacion->fecha= $solicitud->fecha_envio;
                $notificacion->url= route('enviar_tema',['id_estudiante' => $solicitud->estudiante_id,'id_tutor' => $solicitud->tutor_id]) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($encuentros as $solicitud) {
                $estudiante= estudiante::find($solicitud->estudiante_id);
                $notificacion->nombre_estudiante= $estudiante->nombre;
                $notificacion->apellido_estudiante= $estudiante->apellido;
                $notificacion->tipo= "Solicitud de encuentro";
                $notificacion->fecha= $solicitud->fecha_solicitud;
                $notificacion->url= route('encuentro_ver',$solicitud->id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($proyectos as $solicitud) {
                $estudiante= estudiante::find($solicitud->estudiante_id);
                $notificacion->nombre_estudiante= $estudiante->nombre;
                $notificacion->apellido_estudiante= $estudiante->apellido;
                $notificacion->tipo= "Proyecto adjuntado";
                $notificacion->fecha=$solicitud->fecha;
                $notificacion->url= route('proyecto_estudiante_ver',$solicitud->estudiante_id) ;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            foreach ($s_jurado as $solicitud) {
                $jurado= jurado::where('solicitud_jurado_id', $solicitud->id)->first();
                if(!is_null($jurado)){
                    $proyecto=proyecto::find($solicitud->proyecto_id);
                    $estudiante= estudiante::find($proyecto->estudiante_id);
                    $notificacion->nombre_estudiante= $estudiante->nombre;
                    $notificacion->apellido_estudiante= $estudiante->apellido;
                    $notificacion->tipo= "Jurado Asignado";
                    $notificacion->fecha= $solicitud->fecha_envio;
                    $notificacion->url= route('ver_jurado_estudiante_tutor',$estudiante->id) ;
                    array_push($notificaciones,$notificacion);
                    $notificacion=new \stdClass();
                    $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
                    if(!is_null($evaluacion)){
                        $notificacion->nombre_estudiante= $estudiante->nombre;
                        $notificacion->apellido_estudiante= $estudiante->apellido;
                        $notificacion->tipo= "Registro de evaluacion";
                        $notificacion->fecha= $evaluacion->fecha_evaluacion;
                        $notificacion->url= route('ver_evaluacion_estudiante_tutor',$estudiante->id) ;
                        array_push($notificaciones,$notificacion);
                        $notificacion=new \stdClass();
                    }

                }

            }


            return view('tutor',compact('tutor','notificaciones'));
        }

        if($user->rol=='secretaria'){

            $secretaria = secretaria::where('user_id', $user->id)->first();
            $s_jurado= solicitud_jurado::where('secretaria_id', $secretaria->id)->get();
            $notificaciones=[];
            $notificacion=new \stdClass();
            foreach ($s_jurado as $solicitud) {
                $tutor= tutor::find($solicitud->tutor_id);
                $notificacion->nombre_tutor= $tutor->nombre;
                $notificacion->apellido_tutor= $tutor->apellido;
                $notificacion->tipo= "Solicitud Jurado";
                $notificacion->fecha=$solicitud->fecha_envio;
                $notificacion->solicitud_id= $solicitud->id;
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();

            }
            return view('secretaria',compact('secretaria','notificaciones'));
        }

       // return view('home');
    }
}
