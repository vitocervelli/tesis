<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitudTutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_tutor', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('mensaje');
            $table->text('respuesta')->nullable();
            $table->boolean('es_aceptado')->nullable();
            $table->date('fecha_solicitud');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('tutor_id')->unsigned();
            $table->foreign('estudiante_id')->references('id')->on('estudiante')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_tutor');
    }
}
