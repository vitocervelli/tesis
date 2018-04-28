<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObservaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_observaciones');
            $table->text('observaciones');
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
        Schema::dropIfExists('observaciones');
    }
}
