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
class Reportes extends Controller
{
	public function seleccionar_tutor()
    {
        return view('reporte_seleccionar_tutor');
    }
    public function resultados_tutor(Request $request)
    {
        $reportes= tutor::leftJoin("proyecto","tutor.id","=","proyecto.tutor_id")
            -> where('tutor.nombre','like', '%'.$request->input('nombre_tutor').'%')
            ->get(['proyecto.nombre_estudiante','proyecto.id','proyecto.tutor_id','proyecto.titulo_proyecto','proyecto.proyecto']);
        $tutor=tutor::where('tutor.nombre','like', '%'.$request->input('nombre_tutor').'%')->first();
        return view('reporte_tutor',compact('reportes','tutor'));

    }


    public function seleccionar_estudiante()
    {
        return view('reporte_seleccionar_estudiante');
    }

    public function resultados_estudiante(Request $request)
    {
        $tutor=null;
        $proyecto=null;
        $s_jurado=null;
        $jurado=null;
        $evaluacion=null;
        $solicitud_tutor=null;
        $estudiante= estudiante::where('nombre','like', '%'.$request->input('nombre_estudiante').'%')->first();

            if(!is_null($estudiante)){
                $solicitud_tutor=solicitud_tutor::where('estudiante_id', $estudiante->id)->where('es_aceptado',1)->first();
                if(!is_null($solicitud_tutor)){
                    $tutor=tutor::find($solicitud_tutor->tutor_id);
                    if(!is_null($tutor)){
                        $proyecto=proyecto::where('estudiante_id', $estudiante->id)->where('tutor_id', $tutor->id)->first();
                        if(!is_null($proyecto)){
                            $s_jurado= solicitud_jurado::where('proyecto_id', $proyecto->id)->where('tutor_id', $tutor->id)->first();
                            if(!is_null($s_jurado)){
                                $jurado = jurado::where('solicitud_jurado_id', $s_jurado->id)->first();
                                if(!is_null($jurado)){
                                    $evaluacion =  evaluacion::where('jurado_id', $jurado->id)->first();
                                }
                            }
                        }
                    }
                }
            }


        return view('reporte_estudiante',compact('tutor','estudiante','s_jurado','jurado','proyecto','evaluacion'));

    }

    public function seleccionar_jurado()
    {


        return view('reporte_seleccionar_jurado');
    }

    public function resultados_jurado(Request $request)
    {
        $jurados=jurado::where('principal_1', 'like', '%'.$request->input('nombre_jurado').'%')
            ->orWhere('principal_2', 'like', '%'.$request->input('nombre_jurado').'%')
            ->orWhere('suplente_1', 'like', '%'.$request->input('nombre_jurado').'%')
            ->orWhere('suplente_2', 'like', '%'.$request->input('nombre_jurado') .'%')
            ->get();
        $nombre=$request->input('nombre_jurado');
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
        //dd($request->input('nombre_jurado'));
        //ver jurado ver proyecto ver evaluacion
        return view('reporte_jurado',compact('reportes','nombre'));

    }
    public function reporte_jurado_detalles($solicitud_jurado_id,$jurado_id,$proyecto_id)
    {

        $proyecto=proyecto::find($proyecto_id);

        $estudiante= estudiante::where('id',$proyecto->estudiante_id)->first();
        $tutor=tutor::find($proyecto->tutor_id);
        $s_jurado= solicitud_jurado::find($solicitud_jurado_id);
        $evaluacion =  evaluacion::where('jurado_id', $jurado_id)->first();


        return view('reporte_detalle_jurado',compact('tutor','estudiante','s_jurado','proyecto','evaluacion'));


    }

}
