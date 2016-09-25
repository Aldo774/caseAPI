<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaTelefones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_telefones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero', 20);
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')
                ->references('id')
                ->on('tb_clientes')
                ->onDelete('cascade');
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
        Schema::drop('tb_telefones');
    }
}
