<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->foreignId('tabela_de_precos_id')
                  ->constrained('tabela_de_precos') // Vincula à tabela de preços
                  ->onDelete('cascade'); // Define que, se a tabela de preços for excluída, os convênios vinculados também serão excluídos
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('convenios');
    }
};
