<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('precos_procedimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedimento_id')->constrained('procedimentos')->onDelete('cascade');
            $table->foreignId('tabela_de_precos_id')->constrained('tabela_de_precos')->onDelete('cascade');
            $table->decimal('preco', 10, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('precos_procedimentos');
    }
};
