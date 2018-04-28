<?php

use Illuminate\Database\Seeder;

class LineasInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Ingeniería de Software y Sistemas de Infomación'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Teoria de Algoritmos'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Bioingeníeria'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Base de Datos'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Tecnologías de la Comunicaciones y Adquisicíon de Datos'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'E-Learning'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Inteligencia Artificial'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Matématica Computacional'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Multimedia e Interacción Humano-Computador'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Computación Gráfica'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Enseñanza de la computación'
        ]);
        DB::table('lineas_investigacion')->insert([
            'linea_investigacion' => 'Computación de Alto Rendimiento: Sistemas Distribuidos'
        ]);


        // Tabla pivote lineas de investigacion

        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '1',
            'linea_investigacion_id' => '1'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '1',
            'linea_investigacion_id' => '11'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '2',
            'linea_investigacion_id' => '1'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '3',
            'linea_investigacion_id' => '12'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '4',
            'linea_investigacion_id' => '12'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '4',
            'linea_investigacion_id' => '11'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '4',
            'linea_investigacion_id' => '9'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '5',
            'linea_investigacion_id' => '12'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '5',
            'linea_investigacion_id' => '11'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '5',
            'linea_investigacion_id' => '9'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '5',
            'linea_investigacion_id' => '6'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '6',
            'linea_investigacion_id' => '12'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '6',
            'linea_investigacion_id' => '7'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '7',
            'linea_investigacion_id' => '11'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '7',
            'linea_investigacion_id' => '6'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '8',
            'linea_investigacion_id' => '10'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '8',
            'linea_investigacion_id' => '3'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '9',
            'linea_investigacion_id' => '10'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '9',
            'linea_investigacion_id' => '8'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '10',
            'linea_investigacion_id' => '10'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '10',
            'linea_investigacion_id' => '8'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '11',
            'linea_investigacion_id' => '7'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '11',
            'linea_investigacion_id' => '9'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '11',
            'linea_investigacion_id' => '1'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '12',
            'linea_investigacion_id' => '8'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '13',
            'linea_investigacion_id' => '4'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '13',
            'linea_investigacion_id' => '6'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '14',
            'linea_investigacion_id' => '12'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '14',
            'linea_investigacion_id' => '9'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '14',
            'linea_investigacion_id' => '6'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '14',
            'linea_investigacion_id' => '5'
        ]);
        DB::table('tutor_linea_investigacion')->insert([
            'tutor_id' => '15',
            'linea_investigacion_id' => '1'
        ]);

    }
}
