<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table='proyecto';
    protected $fillable = [
        'id','titulo_proyecto', 'linea_investigacion', 'resumen','nombre_estudiante','nombre_tutor','fecha','proyecto','proyecto_modificado','estudiante_id','tutor_id'
    ];
    public function estudiante()
    {
        return $this->belongsTo('App\Estudiante','estudiante_id');
    }
    public function tutor()
    {
        return $this->belongsTo('App\Tutor','tutor_id');
    }
    public function solicitud_jurado()
    {
        return $this->hasOne('App\Solicitud_jurado');
    }
}
