<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea_investigacion extends Model
{
    protected $table='lineas_investigacion';
    protected $fillable = [
        'id','linea_investigacion'
    ];

    public function tutores()
    {
        return $this->belongsToMany('App\Tutor');

    }
}
