<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud_jurado extends Model
{
    protected $table='solicitud_jurado';
    protected $fillable = [
        'id','fecha_envio', 'titulo_trabajo', 'sugerencia_jurado_principal_1','sugerencia_jurado_principal_2','sugerencia_jurado_suplente_1',
        'sugerencia_jurado_suplente_2','institucion_jurado_principal_1','institucion_jurado_principal_2','institucion_jurado_suplente_1','institucion_jurado_suplente_2',
        'correo_jurado_principal_1','correo_jurado_principal_2','correo_jurado_suplente_1','correo_jurado_suplente_2','tutor_id','secretaria_id','proyecto_id'
    ];
    public function proyecto()
    {
        return $this->belongsTo('App\Proyecto','proyecto_id');
    }
    public function tutor()
    {
        return $this->belongsTo('App\Tutor','tutor_id');
    }
    public function secretaria()
    {
        return $this->belongsTo('App\Secretaria','secretaria_id');
    }
    public function jurado()
    {
        return $this->hasOne('App\Jurado');
    }
}
