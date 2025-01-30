<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('solicitacoes_orcamentos', function (Blueprint $table) {
            $table->timestamp('data_atribuido')->nullable();
            $table->timestamp('data_cirurgiao')->nullable();
            $table->timestamp('data_anestesista')->nullable();
            $table->timestamp('data_criacao')->nullable();
            $table->timestamp('data_liberacao')->nullable();
            $table->timestamp('data_negociacao')->nullable();
            $table->timestamp('data_concluido')->nullable();

            $table->boolean('orcamento_teste')->default(0);
            $table->json('favoritos')->nullable();
        });
    }

    public function down()
    {
        Schema::table('solicitacoes_orcamentos', function (Blueprint $table) {
            $table->dropColumn([
                'data_atribuido',
                'data_cirurgiao',
                'data_anestesista',
                'data_criacao',
                'data_liberacao',
                'data_negociacao',
                'data_concluido',
                'orcamento_teste',
                'favoritos'
            ]);
        });
    }

};
