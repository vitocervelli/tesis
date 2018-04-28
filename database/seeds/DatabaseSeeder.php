<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('UserSeeder');
        $this->call('EstudianteSeeder');
        $this->call('SecretariaSeeder');
        $this->call('TutorSeeder');
        $this->call('LineasInvestigacionSeeder');
    }
}
