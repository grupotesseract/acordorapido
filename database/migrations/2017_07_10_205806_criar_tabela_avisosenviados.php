<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaAvisosenviados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avisosenviados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('aviso_id')->unsigned();
            $table->foreign('aviso_id')->references('id')->on('avisos');

            $table->string('estado');
            $table->integer('tipodeaviso'); //0 para SMS; 1 para Ligação
            $table->integer('status'); //To-do: terá código de retorno da mensagem
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avisosenviados');
        Schema::dropIfExists('aviso_enviados');

    }
}
