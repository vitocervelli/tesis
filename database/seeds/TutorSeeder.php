<?php

use Illuminate\Database\Seeder;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tutor')->insert([
            'nombre' => 'Maigualida',
            'apellido' => 'Guevara',
            'cedula' => '1000000',
            'correo' => 'cervelliv@gmail.com',
            'telefono' => '041444444',
            'user_id' => '2'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Elluz',
            'apellido' => 'Uzcategui',
            'cedula' => '1100000',
            'correo' => 'vitojose_8855@hotmail.com',
            'telefono' => '0415555555',
            'user_id' => '3'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Jorge',
            'apellido' => 'Castellanos',
            'cedula' => '1000001',
            'correo' => 'cervelliv@gmail2.com',
            'telefono' => '041444444',
            'user_id' => '4'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Desiree',
            'apellido' => 'Delgado',
            'cedula' => '1000002',
            'correo' => 'cervelliv@gmail1.com',
            'telefono' => '041444444',
            'user_id' => '5'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Mirella',
            'apellido' => 'Herrera',
            'cedula' => '1000003',
            'correo' => 'cervelliv@gmail3.com',
            'telefono' => '041444444',
            'user_id' => '6'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Luis',
            'apellido' => 'Leon',
            'cedula' => '10000023',
            'correo' => 'cervelliv@gmail23.com',
            'telefono' => '041444444',
            'user_id' => '7'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Dinarle',
            'apellido' => 'Ortega',
            'cedula' => '1000004',
            'correo' => 'cervelliv@gmail4.com',
            'telefono' => '041444444',
            'user_id' => '8'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Pedro',
            'apellido' => 'Linares',
            'cedula' => '1000005',
            'correo' => 'cervelliv@gmail5.com',
            'telefono' => '041444444',
            'user_id' => '9'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Aldo',
            'apellido' => 'Reyes',
            'cedula' => '1000006',
            'correo' => 'cervelliv@gmail6.com',
            'telefono' => '041444444',
            'user_id' => '10'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Johana',
            'apellido' => 'Guerrero',
            'cedula' => '1000007',
            'correo' => 'cervelliv@gmail7.com',
            'telefono' => '041444444',
            'user_id' => '11'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Marylin',
            'apellido' => 'Giugni',
            'cedula' => '1000008',
            'correo' => 'cervelliv@gmail8.com',
            'telefono' => '041444444',
            'user_id' => '12'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Patricia',
            'apellido' => 'Guerrero',
            'cedula' => '1000009',
            'correo' => 'cervelliv@gmail9.com',
            'telefono' => '041444444',
            'user_id' => '13'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Elsa',
            'apellido' => 'Tovar',
            'cedula' => '1000010',
            'correo' => 'cervelliv@gmail10.com',
            'telefono' => '041444444',
            'user_id' => '14'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Antonio',
            'apellido' => 'Castañeda',
            'cedula' => '10000011',
            'correo' => 'cervelliv@gmail11.com',
            'telefono' => '041444444',
            'user_id' => '15'
        ]);
        DB::table('tutor')->insert([
            'nombre' => 'Francisca',
            'apellido' => 'Grimon',
            'cedula' => '10000012',
            'correo' => 'cervelliv@gmail12.com',
            'telefono' => '041444444',
            'user_id' => '16'
        ]);
    }
}
