<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produtos_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_produto');
            $table->timestamp('data_inclusao')->useCurrent();
            $table->timestamp('data_alteracao')->nullable()->useCurrentOnUpdate();

            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos_pedido');
    }
};
