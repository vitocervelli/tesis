<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    protected $table='observaciones';
    protected $fillable = [
        'id','fecha_observaciones', 'observaciones', 'estudiante_id','tutor_id'
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
