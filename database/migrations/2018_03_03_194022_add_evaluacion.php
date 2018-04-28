<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEvaluacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('veredicto');
            $table->text('observaciones')->nullable();
            $table->date('fecha_evaluacion');
            $table->integer('jurado_id')->unsigned();
            $table->integer('secretaria_id')->unsigned();
            $table->foreign('jurado_id')->references('id')->on('jurado')->onDelete('cascade');
            $table->foreign('secretaria_id')->references('id')->on('secretaria')->onDelete('cascade');
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
        Schema::dropIfExists('evaluacion');
    }
}
