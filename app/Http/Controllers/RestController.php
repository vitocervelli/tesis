<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Observaciones;
use App\Encuentros;
use App\Proyecto;
use App\Mail\RespuestaTemaTesis;
use App\Mail\EnviarTemaTesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Tutor;
use App\Jurado;
use App\Evaluacion;
use App\Secretaria;
use App\Solicitud_tutor;
use App\Solicitud_jurado;
use App\tema_tesis;
use App\Mail\EnviarSolicitudTutor;
use App\Mail\EnviarRespuestaSolicitudTutor;
use Illuminate\Support\Facades\Mail;

class RestController extends Controller
{

    public function temas()
    {
        //
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $tema_tesis= tema_tesis::where('estudiante_id',$estudiante->id)->get();
        $temas;
        foreach ($tema_tesis as $key => $tema)
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

        $page = Input::get('page');
        $tema_tesis = $tema_tesis->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($tema_tesis, ($page - 1) * $perPage, $perPage);
        $total = count($tema_tesis);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }
    public function temas_enviados($id_estudiante,$id_tutor)
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
            $tema->titulo=substr($tema->titulo, 0, 40);
            $tema->respuesta=substr($tema->respuesta, 0, 40);
            $tema->descripcion=substr($tema->descripcion, 0, 40);
        }

        $page = Input::get('page');
        $tema_tesis = $tema_tesis->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($tema_tesis, ($page - 1) * $perPage, $perPage);
        $total = count($tema_tesis);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function tutores()
    {
        $tutores = tutor::all();
        $tutores_full = [];
        foreach ($tutores as $tutor) {
            $tutor->lineas = $tutor->lineas_investigacion;
            $tutores_full[] = $tutor;
        }

        $page = Input::get('page');
 
        $posts = $tutores_full;
        $perPage=5;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($posts, ($page - 1) * $perPage, $perPage);
        $total = count($posts);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function tesistas()
    {

        $tutor = Tutor::where('user_id', Auth::user()->id)->first();
        $tesistas = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id)
            ->where('solicitud_tutor.es_aceptado','=',1)->distinct()
            ->get(['nombre','apellido','estudiante.id','estatus','telefono']);
        $res = [
            'data' => $tesistas,
            'id_tutor' => $tutor->id
        ];

        $posts = $res;
        $perPage=5;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($posts, ($page - 1) * $perPage, $perPage);
        $total = count($posts);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function solicitudes()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $solicitudes = solicitud_tutor::where('tutor_id', $tutor->id)->get();
        $solicitudes_full=[];
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
            $solicitudes_full[] = $solicitud;

        }
        
        $posts = $solicitudes_full;
        $perPage=5;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($posts, ($page - 1) * $perPage, $perPage);
        $total = count($posts);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function buzon()
    {
        $user = Auth::user();
        $notificaciones=[];
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
                $notificacion->url= route('detalle_solicitud_jurado',$notificacion->solicitud_id);
                array_push($notificaciones,$notificacion);
                $notificacion=new \stdClass();
            }
        }

        $page = Input::get('page');
 
        $posts = $notificaciones;
        $perPage=5;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($notificaciones, ($page - 1) * $perPage, $perPage);
        $total = count($notificaciones);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function solicitudes_encuentros()
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

        $page = Input::get('page');
        $encuentros = $encuentros->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($encuentros, ($page - 1) * $perPage, $perPage);
        $total = count($encuentros);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }
    public function tesistas_jurado()
    {

         $tutor = tutor::where('user_id', Auth::user()->id)->first();


        $estudiantes_tutor = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id) ->where('solicitud_tutor.es_aceptado','=',1)->get();

        $page = Input::get('page');
        $post = $estudiantes_tutor->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function encuentros()
    {

        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $solicitud_tutor = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
        $tutor=null;
        $encuentros=null;
        if($solicitud_tutor!= null){
            $tutor=tutor::find($solicitud_tutor->tutor_id);
            $encuentros= encuentros::where('estudiante_id',$estudiante->id)->where('tutor_id',$tutor->id)->paginate(2);
        }

        return $encuentros;
    }

    public function observaciones()
    {

        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $observaciones= observaciones::where('estudiante_id', $estudiante->id)->get();
        $page = Input::get('page');
        $post = $observaciones->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function observaciones_estudiante($id_estudiante)
    {

        $observaciones= observaciones::where('estudiante_id', $id_estudiante)->get();

        $estudiante = estudiante::find($id_estudiante);

        foreach ($observaciones as $observacion){
            $observacion->observaciones=substr($observacion->observaciones, 0, 60);
            $observacion->estudiante_nombre = $estudiante->nombre;
            $observacion->estudiante_apellido = $estudiante->apellido;
        };
        $page = Input::get('page');
        $post = $observaciones->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function proyectos()
    {

        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $estudiantes_aceptados = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id )
            ->where('solicitud_tutor.es_aceptado','=',1)->distinct()
            ->get(['nombre','apellido','estudiante.id','estatus','telefono']);
        $page = Input::get('page');
        $post = $estudiantes_aceptados->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function jurados()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();

        $estudiantes_tutor = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id) ->where('solicitud_tutor.es_aceptado','=',1)
            ->get();
        $page = Input::get('page');
        $post = $estudiantes_tutor->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }
    
    public function solicitudes_jurados()
    {

        $solicitudes= solicitud_jurado::join("proyecto","proyecto_id","=","proyecto.id")
            ->join("tutor","solicitud_jurado.tutor_id","=","tutor.id")
            ->get(['solicitud_jurado.id','tutor.nombre','tutor.apellido','proyecto.titulo_proyecto','solicitud_jurado.fecha_envio','proyecto.nombre_estudiante']);
        $post = $solicitudes->toArray();
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));
    }

    public function resultados_tutor($request)
    {
        $reportes= tutor::leftJoin("proyecto","tutor.id","=","proyecto.tutor_id")
            -> where('tutor.id',$request)
            ->get(['proyecto.nombre_estudiante','proyecto.id','proyecto.tutor_id','proyecto.titulo_proyecto','proyecto.proyecto']);
        $reportes_full = [];
        foreach ($reportes as $reporte) {
            $solicitud = solicitud_jurado::where('tutor_id',$request)->where('proyecto_id',$reporte->id)->first();
            $reporte->solicitud_id = $solicitud->id;
            $reportes_full[]=$reporte;
        }

        $page = Input::get('page');
        // $post = $reportes->toArray();
        $post = $reportes_full;
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));

    }
    public function resultados_jurado($request)
    {
        $jurados=jurado::where('principal_1', 'like', '%'.$request.'%')
            ->orWhere('principal_2', 'like', '%'.$request.'%')
            ->orWhere('suplente_1', 'like', '%'.$request.'%')
            ->orWhere('suplente_2', 'like', '%'.$request .'%')
            ->get();
        $nombre=$request;
        $reportes=[];
        $reporte=new \stdClass();
        foreach ($jurados as $jurado){
            $evaluacion= evaluacion::where('jurado_id', $jurado->id)->first();
            $reporte->principal_1= $jurado->principal_1;
            $reporte->principal_2=   $jurado->principal_2;
            $reporte->suplente_1= $jurado->suplente_1;
            $reporte->suplente_2= $jurado->suplente_2;
            $reporte->jurado_id= $jurado->id;
            if(!is_null($evaluacion)){
                $reporte->evaluacion_id= $evaluacion->id;
            }else{
                $reporte->evaluacion_id= null;
            }

            $reporte->solicitud_jurado_id=$jurado->solicitud_jurado_id;
            $s_jurado= solicitud_jurado::find($jurado->solicitud_jurado_id);
            $reporte->proyecto_id=$s_jurado->proyecto_id;
            array_push($reportes,$reporte);
            $reporte=new \stdClass();
        }

        $page = Input::get('page');
        $post = $reportes;
        $perPage=2;
        $page   = Paginator::resolveCurrentPage() ?: 1;
        $path   = '/' . \Request::path();
        $sliced = array_slice($post, ($page - 1) * $perPage, $perPage);
        $total = count($post);
        return new LengthAwarePaginator($sliced, $total,$perPage, $page, compact('path'));

    }

}
