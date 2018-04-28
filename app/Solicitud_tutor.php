<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud_tutor extends Model
{
    protected $table='solicitud_tutor';
    protected $fillable = [
        'id','mensaje', 'respuesta', 'es_aceptado','estudiante_id','tutor_id','fecha_solicitud'
    ];
    public function tutor()
    {
        return $this->belongsTo('App\Tutor','tutor_id');
    }
    public function estudiante()
    {
        return $this->belongsTo('App\Estudiante','estudiante_id');
    }
}
