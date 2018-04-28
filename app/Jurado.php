<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{
    protected $table='jurado';
    protected $fillable = [
        'id','titulo_proyecto', 'principal_1', 'principal_2','suplente_1','suplente_2','correo_principal_1','correo_principal_2',
        'correo_suplente_1','correo_suplente_2','fecha_asignacion','solicitud_jurado_id','correo_principal_1','correo_principal_2',
        'correo_suplente_1','correo_suplente_2'
    ];
    public function solicitud()
    {
        return $this->belongsTo('App\Solicitud_jurado','solicitud_jurado_id');
    }
    public function evaluacion()
    {
        return $this->hasOne('App\Evaluacion');
    }
}
