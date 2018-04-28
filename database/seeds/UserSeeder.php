<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'maria',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('1234'),
            'rol'=> 'secretaria'
        ]);
        DB::table('users')->insert([
            'name' => 'Maigualida',
            'email' => 'cervelliv@gmail.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'

        ]);
        DB::table('users')->insert([
            'name' => 'Elluz',
            'email' => 'vitojose_8855@hotmail.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Jorge',
            'email' => 'cervelliv@gmail2.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Desiree',
            'email' => 'cervelliv@gmail1.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Mirella',
            'email' => 'cervelliv@gmail3.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Luis',
            'email' => 'cervelliv@gmail23.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Dinarle',
            'email' => 'cervelliv@gmail4.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Pedro',
            'email' => 'cervelliv@gmail5.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Aldo',
            'email' => 'cervelliv@gmail6.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Johana',
            'email' => 'cervelliv@gmail7.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Marylin',
            'email' => 'cervelliv@gmail8.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Patricia',
            'email' => 'cervelliv@gmail9.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Elsa',
            'email' => 'cervelliv@gmail10.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Antonio',
            'email' => 'cervelliv@gmail11.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'Francisca',
            'email' => 'cervelliv@gmail12.com',
            'password' => bcrypt('1234'),
            'rol'=> 'tutor'
        ]);
        DB::table('users')->insert([
            'name' => 'vito',
            'email' => 'cervelliv@gmail99.com',
            'password' => bcrypt('1234'),
            'rol'=> 'estudiante'
        ]);
        DB::table('users')->insert([
            'name' => 'ricardo',
            'email' => 'ricadro@xvsvl.com',
            'password' => bcrypt('1234'),
            'rol'=> 'estudiante'
        ]);
        DB::table('users')->insert([
            'name' => 'victor',
            'email' => 'vvillegasfacyt@gmail.com',
            'password' => bcrypt('1234'),
            'rol'=> 'estudiante'
        ]);



    }
}

