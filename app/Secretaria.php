<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $table='secretaria';
    protected $fillable = [
        'id','nombre', 'apellido', 'cedula','correo','telefono','user_id'
    ];
    public function solicitudes_jurado()
    {
        return $this->hasMany('App\Solicitud_jurado');
    }
    public function evaluacion()
    {
        return $this->hasMany('App\Evaluacion');
    }
    public function usuario()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
