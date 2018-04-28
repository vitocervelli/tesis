<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function tutor()
    {
        return $this->hasMany('App\Tutor');
    }
    public function estudiante()
    {
        return $this->hasMany('App\Estudiante');
    }
    public function secretaria()
    {
        return $this->hasMany('App\Secretaria');
    }

    public function esTutor()
    {
        return $this->rol==='tutor';
    }
    public function esSecretaria()
    {
        return $this->rol==='secretaria';
    }
    public function esEstudiante()
    {
        return $this->rol==='estudiante';
    }
}
