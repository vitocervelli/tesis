<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTemaTesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tema_tesis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linea_investigacion');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->boolean('es_aceptado')->nullable();
            $table->text('respuesta')->nullable();
            $table->text('fecha_envio');
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
        Schema::dropIfExists('tema_tesis');
    }
}
