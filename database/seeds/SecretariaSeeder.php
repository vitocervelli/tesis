<?php

use Illuminate\Database\Seeder;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secretaria')->insert([
            'nombre' => 'Maria',
            'apellido' => 'Perez',
            'cedula' => '1500000',
            'correo' => 'maria@gmail.com',
            'telefono' => '0416655555',
            'user_id' => '1'
        ]);
    }
}
