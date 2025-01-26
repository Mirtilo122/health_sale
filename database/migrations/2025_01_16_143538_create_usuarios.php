<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email', 140)->unique();
            $table->string('senha', 100);
            $table->string('usuario', 140)->nullable();
            $table->string('acesso', 50)->default('Externo');
            $table->string('funcao', 50)->default('');
        });
    }

    public function down() {
        Schema::dropIfExists('usuarios');
    }
};
