<?php

use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estudiante')->insert([
            'nombre' => 'vito',
            'apellido' => 'Cervelli',
            'cedula' => '21152282',
            'correo' => 'cervelliv@gmail.com',
            'telefono' => '04145809220',
            'estatus' => 'TEG',
            'user_id' => '17'
        ]);
        DB::table('estudiante')->insert([
            'nombre' => 'ricardo',
            'apellido' => 'Quero',
            'cedula' => '21152300',
            'correo' => 'vitojose_8855@hotmail.com',
            'telefono' => '04145809300',
            'estatus' => 'TEG',
            'user_id' => '18'
        ]);
        DB::table('estudiante')->insert([
            'nombre' => 'Victor',
            'apellido' => 'Villegas',
            'cedula' => '211523090',
            'correo' => 'vvillegasfacyt@gmail.com',
            'telefono' => '04145809300',
            'estatus' => 'TEG',
            'user_id' => '19'
        ]);
    }

}