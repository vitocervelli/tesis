<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tema_tesis extends Model
{
    protected $table='tema_tesis';
    protected $fillable = [
        'id','linea_investigacion', 'titulo', 'descripcion','es_aceptado','estudiante_id','tutor_id','fecha_envio','respuesta'
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
