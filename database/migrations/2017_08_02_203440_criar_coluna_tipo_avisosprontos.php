<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarColunaTipoAvisosprontos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modeloavisos', function (Blueprint $table) {
            $table->string('tipo')->nullable(); //pode ser 'Azul', 'Verde', 'Amarelo', 'Vermelho'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modeloavisos', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
