<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLineasInvestigacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas_investigacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linea_investigacion');
            $table->timestamps();
        });

        Schema::create('tutor_linea_investigacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('tutor')->onDelete('cascade');
            $table->integer('linea_investigacion_id')->unsigned();
            $table->foreign('linea_investigacion_id')->references('id')->on('lineas_investigacion')->onDelete('cascade');
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
        Schema::dropIfExists('tutor_linea_investigacion');
        Schema::dropIfExists('lineas_investigacion');

    }
}
