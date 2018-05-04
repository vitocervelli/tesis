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
use App\Mail\EnviarJurado;
use App\Mail\SolicitudJurado;
use Illuminate\Support\Facades\Mail;
use App\Proyecto;
class SolicitarJurado extends Controller
{
  
  public function lista_estudiantes()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();


        $estudiantes_tutor = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id) ->where('solicitud_tutor.es_aceptado','=',1)->get();

        return view('jurado_seleccionar_estudiante',compact('estudiantes_tutor'));
    }
    public function realizar_solicitud_estudiante($id_estudiante)
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
    	$estudiante= estudiante::find($id_estudiante);
       	$proyecto= proyecto::where('estudiante_id', $estudiante->id)->where('tutor_id', $tutor->id)->whereNotNull('proyecto')->first();
        $s_jurado=null;
        if(!is_null($proyecto)){
            $s_jurado =solicitud_jurado::where('proyecto_id', $proyecto->id)->where('tutor_id', $tutor->id)->first();
        }

       	return view('jurado_solicitud_realizar',compact('proyecto','estudiante','s_jurado'));
    }
    public function guardar_solicitud_estudiante(Request $request)
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $secretaria=secretaria::find(1);
        $estudiante= estudiante::find($request->input('estudiante_id'));
        $proyecto= proyecto::find($request->input('proyecto_id'));
        $s_jurado= new solicitud_jurado;
        $s_jurado->sugerencia_jurado_principal_1= $request->input('principal_1');
        $s_jurado->sugerencia_jurado_principal_2=  $request->input('principal_2');
        $s_jurado->sugerencia_jurado_suplente_1 = $request->input('suplente_1');
        $s_jurado->sugerencia_jurado_suplente_2= $request->input('suplente_2');
        $s_jurado->institucion_jurado_principal_1 =$request->input('institucion_principal_1');
        $s_jurado->institucion_jurado_principal_2= $request->input('institucion_principal_2');
        $s_jurado->institucion_jurado_suplente_1 = $request->input('institucion_suplente_1');
        $s_jurado->institucion_jurado_suplente_2 = $request->input('institucion_suplente_2');
        $s_jurado->correo_jurado_principal_1 = $request->input('correo_principal_1');
        $s_jurado->correo_jurado_principal_2 = $request->input('correo_principal_2');
        $s_jurado->correo_jurado_suplente_1 = $request->input('correo_suplente_1');
        $s_jurado->correo_jurado_suplente_2 =  $request->input('correo_suplente_2');
        $s_jurado->tutor_id = $tutor->id;
        $s_jurado->secretaria_id = $secretaria->id;
        $s_jurado->proyecto_id = $request->input('proyecto_id');
        $s_jurado->fecha_envio = date("Y-m-d");
        $s_jurado->save();

        $s_jurado->nombre_estudiante= $estudiante->nombre;
        $s_jurado->nombre_tutor = $tutor->nombre;
        $s_jurado->apellido_estudiante = $estudiante->apellido;
        $s_jurado->apellido_tutor = $tutor->apellido;
        $s_jurado->proyecto = $proyecto->titulo_proyecto;
        $s_jurado->linea_investigacion = $proyecto->linea_investigacion;
        Mail::to($secretaria->correo)->send(new SolicitudJurado( $s_jurado));
        return view('jurado_solicitud_realizada',compact('secretaria','estudiante'));
    }
    public function ver_solicitud_jurado($id_estudiante)
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $estudiante= estudiante::find($id_estudiante);
        $proyecto= proyecto::where('estudiante_id',$estudiante->id)->where('tutor_id', $tutor->id)->first();
        $s_jurado=null;
        if(!is_null($proyecto)) {
            $s_jurado = solicitud_jurado::where('proyecto_id', $proyecto->id)->where('tutor_id', $tutor->id)->first();
            if(!is_null($s_jurado))
            $secretaria = secretaria::find($s_jurado->id_secretaria);
        }
        return view('jurado_ver_solicitud',compact('tutor','estudiante','s_jurado','secretaria','proyecto'));

    }
    public function ver_solicitud_jurado_secretaria()
    {
        $secretaria = secretaria::where('user_id', Auth::user()->id)->first();


        $s_jurado= solicitud_jurado::where('secretaria_id',$secretaria->id)->get();

       $solicitudes=array();
        $solicitud=new \stdClass();

        $solicitudes= solicitud_jurado::join("proyecto","proyecto_id","=","proyecto.id")
                                ->join("tutor","solicitud_jurado.tutor_id","=","tutor.id")
                                ->get(['solicitud_jurado.id','tutor.nombre','tutor.apellido','proyecto.titulo_proyecto','solicitud_jurado.fecha_envio','proyecto.nombre_estudiante']);
        /*foreach ($s_jurado as $items){

                $tutor= tutor::find($items->tutor_id);
                $proyecto=  proyecto::find( $items->proyecto_id);
                $solicitud->proyecto_id= $items->proyecto_id;
                $solicitud->tutor_id= $items->tutor_id;
                $solicitud->fecha_envio= $items->fecha_envio;
                $solicitud->proyecto=$proyecto->titulo_proyecto;
                $solicitud->tutor=$tutor->nombre. " ". $tutor->apellido;

            array_push($solicitudes,$solicitud);
            $solicitud=new \stdClass();

        }*/
       // print_r($solicitudes);

        //dd();
        return view('jurado_ver_solicitud_secretaria',compact('solicitudes'));


    }
    public function detalle_solicitud_jurado($id_solicitud)
    {
        $s_jurado= solicitud_jurado::find($id_solicitud);
        $tutor = tutor::find($s_jurado->tutor_id);
        $proyecto = proyecto::find($s_jurado->proyecto_id);
        $estudiante= estudiante::find($proyecto->estudiante_id);
        $secretaria = secretaria::where('user_id', Auth::user()->id)->first();
        return view('jurado_ver_solicitud',compact('tutor','estudiante','s_jurado','secretaria','proyecto'));
    }
    public function lista_registrar_jurado()
    {
        $solicitudes= solicitud_jurado::join("proyecto","proyecto_id","=","proyecto.id")
            ->join("tutor","solicitud_jurado.tutor_id","=","tutor.id")
            ->get(['solicitud_jurado.id','tutor.nombre','tutor.apellido','proyecto.titulo_proyecto','solicitud_jurado.fecha_envio','proyecto.nombre_estudiante']);

        return view('jurado_ver_lista_registro',compact('solicitudes'));
    }
    public function registrar_jurado($id_solicitud)
    {

        $jurado = jurado::where('solicitud_jurado_id', $id_solicitud)->first();
        $s_jurado = solicitud_jurado::find($id_solicitud);
        $tutor = tutor::find($s_jurado->tutor_id);
        $proyecto = proyecto::find($s_jurado->proyecto_id);
        $estudiante = estudiante::find($proyecto->estudiante_id);

        return view('jurado_registro', compact('jurado', 'id_solicitud', 'tutor', 'estudiante', 'proyecto','s_jurado'));
    }
        public function guardar_jurado(Request $request)
    {


        $jurado= new jurado;
        $jurado->principal_1= $request->input('principal_1');
        $jurado->principal_2=  $request->input('principal_2');
        $jurado->suplente_1 = $request->input('suplente_1');
        $jurado->suplente_2= $request->input('suplente_2');
        $jurado->institucion_jurado_principal_1 =$request->input('institucion_principal_1');
        $jurado->institucion_jurado_principal_2= $request->input('institucion_principal_2');
        $jurado->institucion_jurado_suplente_1 = $request->input('institucion_suplente_1');
        $jurado->institucion_jurado_suplente_2 = $request->input('institucion_suplente_2');
        $jurado->correo_principal_1 = $request->input('correo_principal_1');
        $jurado->correo_principal_2 = $request->input('correo_principal_2');
        $jurado->correo_suplente_1 = $request->input('correo_suplente_1');
        $jurado->correo_suplente_2 =  $request->input('correo_suplente_2');
        $jurado->solicitud_jurado_id = $request->input('solicitud_jurado_id');
        $jurado->titulo_proyecto = $request->input('proyecto_titulo');
        $jurado->fecha_asignacion = date("Y-m-d");
        $jurado->save();

        $s_jurado = solicitud_jurado::find($jurado->solicitud_jurado_id);
        $tutor = tutor::find($s_jurado->tutor_id);
        $proyecto = proyecto::find($s_jurado->proyecto_id);
        $estudiante = estudiante::find($proyecto->estudiante_id);
        $jurado->tutor= $proyecto->nombre_tutor;
        $jurado->estudiante=$proyecto->nombre_estudiante;
        $jurado->linea_investigacion=$proyecto->linea_investigacion;
        $jurado->proyecto=$proyecto->proyecto;
        Mail::to($estudiante->correo)->send(new EnviarJurado( $jurado));
        Mail::to($tutor->correo)->send(new EnviarJurado( $jurado));
        Mail::to($jurado->correo_principal_1)->send(new EnviarJurado( $jurado));
        Mail::to($jurado->correo_principal_2)->send(new EnviarJurado( $jurado));
        Mail::to($jurado->correo_suplente_1)->send(new EnviarJurado( $jurado));
        Mail::to($jurado->correo_suplente_2)->send(new EnviarJurado( $jurado));
        return view('jurado_registrado');

    }
    public function jurado_asignado($id_solicitud_jurado)
    {
        $jurado = jurado::where('solicitud_jurado_id', $id_solicitud_jurado)->first();
        $s_jurado = solicitud_jurado::find($id_solicitud_jurado);
        $tutor = tutor::find($s_jurado->tutor_id);
        $proyecto = proyecto::find($s_jurado->proyecto_id);
        $estudiante = estudiante::find($proyecto->estudiante_id);
        return view('jurado_ver_asignacion',compact('tutor','estudiante','proyecto','jurado'));
    }
    public function ver_jurado_estudiante()
    {
        $jurado=null;
        $s_jurado=null;
        $tutor=null;
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        if(!is_null($proyecto)){
            $s_jurado= solicitud_jurado::where('proyecto_id', $proyecto->id)->first();
            if(!is_null($s_jurado)){
                $tutor = tutor::find($s_jurado->tutor_id);
                $jurado= jurado::where('solicitud_jurado_id', $s_jurado->id)->first();

            }

        }



        return view('jurado_ver_asignacion',compact('tutor','estudiante','proyecto','jurado'));
    }
    public function lista_estudiantes_jurado()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();

        $estudiantes_tutor = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id) ->where('solicitud_tutor.es_aceptado','=',1)
            ->get();
        return view('jurado_asignado_seleccionar_estudiante',compact('estudiantes_tutor'));
    }
    public function ver_jurado_estudiante_tutor($id_estudiante)
    {
        $jurado=null;
        $s_jurado=null;
        $tutor=null;
        $estudiante = estudiante::find($id_estudiante);
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        if(!is_null($proyecto)) {
            $s_jurado = solicitud_jurado::where('proyecto_id', $proyecto->id)->first();

            if (!is_null($s_jurado)) {
                $tutor = tutor::find($s_jurado->tutor_id);
                $jurado = jurado::where('solicitud_jurado_id', $s_jurado->id)->first();
            }
        }
            return view('jurado_ver_asignacion',compact('tutor','estudiante','proyecto','jurado'));
    }





}
