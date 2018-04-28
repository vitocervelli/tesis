<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Estudiante;
use App\Proyecto;
use App\Tutor;
use App\Solicitud_tutor;
use App\Solicitud_jurado;

use App\Mail\ProyectoGuardado;
use App\tema_tesis;
use Illuminate\Support\Facades\Mail;

class Proyectos extends Controller
{
    public function adjuntar()
    {

        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        $solicitud_aceptada = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
        $solicitud_jurado=0;
        $aceptado=0;
        $tema=0;
        if(!is_null($solicitud_aceptada)){
            $tutor= tutor::find($solicitud_aceptada->tutor_id);
            $tema= tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
            $aceptado=1;
        }
        if(!is_null($proyecto)){
                $tiene_solicitud=solicitud_jurado::where('proyecto_id', $proyecto->id)->first();
                if(!is_null($tiene_solicitud)){
                    $solicitud_jurado=1;
                }
        }

        return view('proyecto_adjuntar',compact('solicitud_aceptada','aceptado','proyecto','solicitud_jurado','tema'));
    }
    public function guardar(Request $request)
    {
        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $solicitud_aceptada = solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
        if (!is_null($solicitud_aceptada)) {
            $tutor= tutor::find($solicitud_aceptada->tutor_id);
        }
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        //si no ha subido proyecto guardarlo sino actualizarlo
        $tema= tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
        if(!is_null( $tema)){
            if(is_null($proyecto)){

                $proyecto_guardar= new proyecto;
                $proyecto_guardar->titulo_proyecto=$request->input('titulo');
                $proyecto_guardar->resumen=$request->description;
                $proyecto_guardar->linea_investigacion=$tema->linea_investigacion;
                $proyecto_guardar->nombre_tutor=$tutor->nombre." ".$tutor->apellido;
                $proyecto_guardar->nombre_estudiante=$estudiante->nombre." ".$estudiante->apellido;
                $proyecto_guardar->estudiante_id=$estudiante->id;
                $proyecto_guardar->tutor_id=$tutor->id;
                $proyecto_guardar->fecha=date("Y-m-d");
                //obtenemos el nombre del archivo
                $file = $request->file('file');
                $nombre =$file->getClientOriginalName();
                $nombre= $estudiante->cedula.$nombre;
                \Storage::disk('local')->put($nombre,  \File::get($file));
                $proyecto_guardar->proyecto= '/proyectos/'.$nombre;
                $proyecto_guardar->save();



            }else{
                // si tiene solicitud de jurado no se puede modificar solo podra subir otro pdf con correcciones
                $solicitud_jurado = solicitud_jurado::where('proyecto_id', $proyecto->id)->first();
                if(is_null($solicitud_jurado)) {
                    $proyecto->titulo_proyecto=$request->input('titulo');
                    $proyecto->resumen=$request->description;
                    $proyecto->fecha=date("Y-m-d");
                    $file = $request->file('file');
                    $nombre =$file->getClientOriginalName();
                    $nombre= $estudiante->cedula.$nombre;
                    \Storage::disk('local')->put($nombre,  \File::get($file));

                    if(\File::exists(public_path($proyecto->proyecto))){
                        \File::delete(public_path($proyecto->proyecto));
                    }
                    $proyecto->proyecto= '/proyectos/'.$nombre;
                    $proyecto->save();
                }else{
                    $proyecto->fecha=date("Y-m-d");
                    $file = $request->file('file');
                    $nombre =$file->getClientOriginalName();
                    $nombre= $estudiante->cedula."modificado".$nombre;
                    \Storage::disk('local')->put($nombre,  \File::get($file));

                    if(\File::exists(public_path($proyecto->proyecto_modificado))){
                        \File::delete(public_path($proyecto->proyecto_modificado));
                    }
                    $proyecto->proyecto_modificado= '/proyectos/'.$nombre;
                    $proyecto->save();
                }
            }

            $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
            Mail::to($tutor->correo)->send(new ProyectoGuardado( $proyecto));
        }

        return view('proyecto_guardado',compact('proyecto'));
    }
    public function ver()
    {

        $estudiante = estudiante::where('user_id', Auth::user()->id)->first();
        $proyecto= proyecto::where('estudiante_id', $estudiante->id)->first();
        $tema= tema_tesis::where('tutor_id', $proyecto->tutor_id)->where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
        

        return view('proyecto_ver',compact('proyecto','tema'));
    }
    public function estudiantes()
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $estudiantes_aceptados = estudiante::join("solicitud_tutor","estudiante.id","=","solicitud_tutor.estudiante_id")
            ->where('solicitud_tutor.tutor_id','=',$tutor->id )
            ->where('solicitud_tutor.es_aceptado','=',1)->distinct()
            ->get(['nombre','apellido','estudiante.id','estatus','telefono']);
        return view('proyecto_seleccionar_estudiante',compact('estudiantes_aceptados','tutor'));

    }
    public function estudiante_ver($id_estudiante)
    {
        $tutor = tutor::where('user_id', Auth::user()->id)->first();
        $tema= tema_tesis::where('tutor_id', $tutor->id)->where('estudiante_id', $id_estudiante)->where('es_aceptado',1)->first();
        $proyecto= proyecto::where('estudiante_id', $id_estudiante)->first();


        return view('proyecto_ver',compact('proyecto','tema'));
    }

}
