<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_proyecto')->unsigned();
            $table->foreign('f_proyecto')->references('id')->on('proyectos');
            $table->string('n_acuerdo')->default('null');
            $table->binary('archivo_binario');
            $table->string('archivo_peso');
            $table->string('archivo_tipo');
            $table->integer('f_tipo')->unsigned();
            $table->foreign('f_tipo')->references('id')->on('tipos');
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
        Schema::dropIfExists('documentos');
    }
}
