<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProyecto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo_proyecto');
            $table->string('linea_investigacion');
            $table->string('resumen');
            $table->string('nombre_estudiante');
            $table->string('nombre_tutor');
            $table->string('proyecto');
            $table->date('fecha');
            $table->string('proyecto_modificado')->nullable();
            $table->integer('estudiante_id')->unsigned();
            $table->integer('tutor_id')->unsigned();
            $table->foreign('estudiante_id')->references('id')->on('estudiante')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutor')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto');
    }
}
