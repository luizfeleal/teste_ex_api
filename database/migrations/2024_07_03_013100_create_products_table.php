<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('produto_descricao');
            $table->decimal('produto_preco_venda', 8, 2);
            $table->integer('produto_estoque');
            $table->timestamp('data_inclusao')->useCurrent();
            $table->timestamp('data_alteracao')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
