<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titulos', function (Blueprint $table) {
            $table->integer('importacao_id')->unsigned()->nullable();
            $table->foreign('importacao_id')->references('id')->on('importacoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('titulos', function (Blueprint $table) {
            $table->dropColumn('importacao_id');
        });
    }
}
