<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo_proyecto');
            $table->string('principal_1');
            $table->string('principal_2');
            $table->string('suplente_1');
            $table->string('suplente_2');
            $table->string('institucion_jurado_principal_1');
            $table->string('institucion_jurado_principal_2');
            $table->string('institucion_jurado_suplente_1');
            $table->string('institucion_jurado_suplente_2');
            $table->string('correo_principal_1');
            $table->string('correo_principal_2');
            $table->string('correo_suplente_1');
            $table->string('correo_suplente_2');
            $table->date('fecha_asignacion');
            $table->integer('solicitud_jurado_id')->unsigned();
            $table->foreign('solicitud_jurado_id')->references('id')->on('solicitud_jurado')->onDelete('cascade');
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
        Schema::dropIfExists('jurado');
    }
}
