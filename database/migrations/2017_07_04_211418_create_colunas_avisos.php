<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColunasAvisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avisos', function (Blueprint $table) {
            $table->integer('titulo_id')->unsigned()->nullable();
            $table->foreign('titulo_id')->references('id')->on('titulos');

            $table->string('estado')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avisos', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->dropColumn('titulo_id');
        });
    }
}
