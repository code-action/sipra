<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constancias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_estudiante')->unsigned();
            $table->foreign('f_estudiante')->references('id')->on('estudiantes');
            $table->binary('constancia_binario');
            $table->string('constancia_peso');
            $table->string('constancia_tipo');
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
        Schema::dropIfExists('constancias');
    }
}
