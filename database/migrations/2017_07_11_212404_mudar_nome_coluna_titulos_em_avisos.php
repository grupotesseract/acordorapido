<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MudarNomeColunaTitulosEmAvisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avisos', function (Blueprint $table) {
            $table->renameColumn('titulo', 'tituloaviso');
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
            $table->renameColumn('tituloaviso','titulo');
            
        });
    }
}
