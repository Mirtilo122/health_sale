<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->string('procedimento_principal')->nullable();
            $table->integer('cod_tuss_principal')->nullable();
            $table->json('procedimentos_secundarios')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn(['procedimento_principal', 'cod_tuss_principal', 'procedimentos_secundarios']);
        });
    }
};
