<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tuss', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 25)->unique();
            $table->string('descricao', 150);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tuss');
    }
};
