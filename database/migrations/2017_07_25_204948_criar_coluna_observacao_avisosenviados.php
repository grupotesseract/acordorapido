<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarColunaObservacaoAvisosenviados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avisosenviados', function (Blueprint $table) {
            $table->text('observacaoligacao')->nullable();
            $table->time('tempoligacao')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avisosenviados', function (Blueprint $table) {
            $table->dropColumn('observacaoligacao');
            $table->dropColumn('tempoligacao');

        });
    }
}
