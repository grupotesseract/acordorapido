<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarEmpresaIdImportacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('importacoes', function (Blueprint $table) {
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('importacoes', function (Blueprint $table) {
            $table->dropColumn('empresa_id');
        });
    }
}
