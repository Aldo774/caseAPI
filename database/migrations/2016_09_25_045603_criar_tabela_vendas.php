<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('situacao', 20);
            $table->string('valorcusto', 10);
            $table->string('valorvenda', 10);
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')
                ->references('id')
                ->on('tb_clientes')
                ->onDelete('cascade');
            $table->integer('id_proserv')->unsigned();
            $table->foreign('id_proserv')
                ->references('id')
                ->on('tb_produtoservico')
                ->onDelete('no action');
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
        Schema::drop('tb_vendas');
    }
}
