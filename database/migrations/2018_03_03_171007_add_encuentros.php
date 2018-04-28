<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEncuentros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuentros', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_solicitud');
            $table->enum('metodo',['skype','presencial'])->nullable();
            $table->date('fecha_encuentros')->nullable();
            $table->string('duracion')->nullable();
            $table->text('solicitud')->nullable();
            $table->text('respuesta')->nullable();
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
        Schema::dropIfExists('encuentros');
    }
}
