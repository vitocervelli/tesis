<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuentros extends Model
{
    protected $table='encuentros';
    protected $fillable = [
        'id','fecha_solicitud', 'metodo', 'fecha_encuentros','duracion','estudiante_id','tutor_id','solicitud','respuesta'
    ];
    public function estudiante()
    {
        return $this->belongsTo('App\Estudiante','estudiante_id');
    }
    public function tutor()
    {
        return $this->belongsTo('App\Tutor','tutor_id');
    }

}
