<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomecolumnsToClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
            $table->string('turma');
            $table->string('periodo');
            $table->string('responsavel');
            $table->string('celular');
            $table->string('telefone');
            $table->string('telefone2')->nullable();
            $table->string('celular2')->nullable();
            $table->string('titulo');
            $table->decimal('valor',18,2);
            $table->date('vencimento');         

            $table->integer('empresa_id')->unsigned();
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
        Schema::table('clientes', function (Blueprint $table) {
            //
            $table->dropColumn('turma');
            $table->dropColumn('periodo');
            $table->dropColumn('responsavel');
            $table->dropColumn('celular');
            $table->dropColumn('telefone');
            $table->dropColumn('telefone2');
            $table->dropColumn('celular2');
            $table->dropColumn('titulo');
            $table->dropColumn('valor');
            $table->dropColumn('vencimento');
            $table->dropColumn('empresa_id');
            

        });
    }
}
