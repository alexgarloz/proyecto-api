<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->id();
            $table->tinyText('nombre');
            $table->tinyText('descripcion');
            $table->string('imagen')->nullable();
            $table->float('precio')->nullable();
            $table->unsignedBigInteger('id_sub_categoria');
            $table->unsignedBigInteger('id_usuario');
            //$table->unsignedBigInteger('id_comentario')->nullable();
            $table->timestamps();

            $table->foreign('id_sub_categoria')->references('id')->on('sub_categoria');
            $table->foreign('id_usuario')->references('id')->on('users');
           //$table->foreign('id_comentario')->references('id')->on('comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}
