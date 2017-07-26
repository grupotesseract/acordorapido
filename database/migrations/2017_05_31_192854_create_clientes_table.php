<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->string('turma')->nullable();
            $table->string('periodo')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefone')->nullable();
            $table->string('telefone2')->nullable();
            $table->string('celular2')->nullable();
            $table->string('rg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
        
    }
}
