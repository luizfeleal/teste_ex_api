<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('imagem_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto');
            $table->string('imagem');
            $table->timestamp('data_inclusao')->useCurrent();
            $table->timestamp('data_alteracao')->nullable()->useCurrentOnUpdate();

            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagem_produtos');
    }
};
