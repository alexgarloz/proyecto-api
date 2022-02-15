<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id')->nullable()->index();
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->string('pais');
            $table->tinyText('descripcion')->nullable();
            $table->tinyText('idioma')->nullable()->comment('Será expuesto dependiendo de cada pais por el standar ISO 3166-1 alfa-2');
            $table->tinyText('habilidades')->nullable();
            $table->boolean('estado')->nullable()->comment('Indica si está conectado o no');
            $table->string('email')->unique();
            $table->string('img_perfil')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('last_session')->nullable();
            $table->tinyInteger('rol');// rol 1-> usuario normal, cuando se registra, rol 2 -> usuario desarollador

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
