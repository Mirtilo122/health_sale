<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->json('taxa_anestesista')->nullable()->after('procedimentos_secundarios');
            $table->json('taxa_cirurgiao')->nullable()->after('taxa_anestesista');
            $table->decimal('valor_total', 10, 2)->nullable()->after('taxa_cirurgiao');
            $table->text('condicoes_gerais')->nullable()->after('valor_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn(['taxa_anestesista', 'taxa_cirurgiao', 'valor_total', 'condicoes_gerais']);
        });
    }
};
