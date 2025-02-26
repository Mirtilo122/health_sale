<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->foreignId('especialidade_id')->nullable()->constrained('especialidades')->onDelete('set null');
        });
    }

    public function down() {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->dropForeign(['especialidade_id']);
            $table->dropColumn('especialidade_id');
        });
    }
};
