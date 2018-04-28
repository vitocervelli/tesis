<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table='evaluacion';
    protected $fillable = [
        'id','veredicto', 'observaciones', 'fecha_evaluacion','jurado_id','secretaria_id'
    ];
    public function secretaria()
    {
        return $this->belongsTo('App\Secretaria','secretaria_id');
    }
    public function jurado()
    {
        return $this->belongsTo('App\Jurado','jurado_id');
    }
}
