<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitudJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_jurado', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_envio');
            $table->string('sugerencia_jurado_principal_1');
            $table->string('sugerencia_jurado_principal_2');
            $table->string('sugerencia_jurado_suplente_1');
            $table->string('sugerencia_jurado_suplente_2');
            $table->string('institucion_jurado_principal_1');
            $table->string('institucion_jurado_principal_2');
            $table->string('institucion_jurado_suplente_1');
            $table->string('institucion_jurado_suplente_2');
            $table->string('correo_jurado_principal_1');
            $table->string('correo_jurado_principal_2');
            $table->string('correo_jurado_suplente_1');
            $table->string('correo_jurado_suplente_2');
            $table->integer('tutor_id')->unsigned();
            $table->integer('secretaria_id')->unsigned();
            $table->integer('proyecto_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('tutor')->onDelete('cascade');
            $table->foreign('secretaria_id')->references('id')->on('secretaria')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('proyecto')->onDelete('cascade');
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
        Schema::dropIfExists('solicitud_jurado');
    }
}
