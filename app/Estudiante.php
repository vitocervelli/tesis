<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table='estudiante';
    protected $fillable = [
        'id','nombre', 'apellido', 'cedula','correo','telefono','estatus','user_id'
    ];
    public function proyecto()
    {
        return $this->hasOne('App\Proyecto');
    }
    public function solicitud()
    {
        return $this->hasOne('App\Solicitud_tutor');
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
    public function usuario()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
