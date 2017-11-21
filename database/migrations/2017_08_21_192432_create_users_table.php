<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('f_proyecto')->unsigned()->nullable();
          $table->foreign('f_proyecto')->references('id')->on('proyectos');
          $table->string('name'); //usuario/carné
          $table->string('nombre');
          $table->string('apellido');
          $table->string('email')->nullable();
          $table->integer('tipo');// 1 administrado 2 editor 3 estudiante
          $table->string('password');
          $table->boolean('estado')->default(true);
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
