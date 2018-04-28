<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table='tutor';
    protected $fillable = [
        'id','nombre', 'apellido', 'cedula','correo','telefono','user_id'
    ];
    public function solicitudes_tutor()
    {
        return $this->hasMany('App\Solicitud_tutor');
    }
    public function proyecto()
    {
        return $this->hasOne('App\Proyecto');
    }
    public function observaciones()
    {
        return $this->hasMany('App\Observaciones');
    }
    public function encuentros()
    {
        return $this->hasMany('App\Encuentros');
    }
    public function temas()
    {
        return $this->hasMany('App\tema_tesis');
    }
    public function solicitudes_jurado()
    {
        return $this->hasMany('App\Solicitud_jurado');
    }
    public function usuario()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function lineas_investigacion()
    {
        return $this->belongsToMany('App\Linea_investigacion','tutor_linea_investigacion')->withTimestamps();

    }
}
