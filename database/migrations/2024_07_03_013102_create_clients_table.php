<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_razao_social');
            $table->string('cliente_cnpj');
            $table->string('cliente_email');
            $table->timestamp('data_inclusao')->useCurrent();
            $table->timestamp('data_alteracao')->nullable()->useCurrentOnUpdate();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
