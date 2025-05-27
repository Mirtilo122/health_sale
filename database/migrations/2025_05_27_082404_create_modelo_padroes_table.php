<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modelo_padroes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->unique();
            $table->unsignedBigInteger('modelo_id')->nullable();

            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modelo_padroes');
    }
};
