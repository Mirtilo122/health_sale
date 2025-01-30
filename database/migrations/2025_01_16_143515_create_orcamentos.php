<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id('codigo_orcamento');
            $table->unsignedBigInteger('codigo_solicitacao');
            $table->unsignedBigInteger('codigo_tabela_base')->nullable();
            $table->string('solicitante', 255);
            $table->string('nome_solicitante', 255);
            $table->string('telefone', 20);
            $table->string('email', 255);
            $table->string('canal_contato', 50);
            $table->timestamp('data_solicitacao')->useCurrent();
            $table->string('origem_orcamento', 255);
            $table->string('tipo_orcamento', 255);
            $table->string('convenio', 255);
            $table->text('observacoes_adicionais')->nullable();
            $table->string('nome_paciente', 255);
            $table->date('data_nascimento');
            $table->string('cidade', 255);
            $table->string('comorbidades', 5)->default('nao');
            $table->text('descricao_comorbidades')->nullable();
            $table->text('resumo_procedimento')->nullable();
            $table->text('detalhes_procedimento')->nullable();
            $table->decimal('tempo_cirurgia', 6, 0)->default(0);
            $table->date('data_provavel')->nullable();
            $table->integer('diarias_enfermaria')->default(0);
            $table->integer('diarias_apartamento')->default(0);
            $table->integer('diarias_uti')->default(0);
            $table->boolean('anestesia_raqui')->default(false);
            $table->boolean('anestesia_sma')->default(false);
            $table->boolean('anestesia_peridural')->default(false);
            $table->boolean('anestesia_sedacao')->default(false);
            $table->boolean('anestesia_externo')->default(false);
            $table->boolean('anestesia_bloqueio')->default(false);
            $table->boolean('anestesia_local')->default(false);
            $table->string('anestesia_outros', 255)->nullable();
            $table->text('observacoes')->nullable();
            $table->string('status', 50)->default('Pendente');
            $table->string('arquivo_pdf', 255)->nullable();
            $table->boolean('urgencia')->default(false);
            $table->string('cirurgiao', 255)->default('nao');
            $table->string('nome_cirurgiao', 255)->default('');
            $table->string('telefone_cirurgiao', 20)->default('');
            $table->string('email_cirurgiao', 70)->default('');
            $table->string('crm_cirurgiao', 70)->default('');

            // IDs de usuários
            $table->unsignedBigInteger('id_usuario_responsavel')->nullable();
            $table->json('id_usuarios_visualizar')->nullable();
            $table->json('id_usuarios_editar')->nullable();
            $table->json('id_usuarios_anestesistas')->nullable();
            $table->json('id_usuarios_cirurgioes')->nullable();

            // Preços dos procedimentos
            $table->json('precos_procedimentos')->nullable();

            // Chaves estrangeiras
            $table->foreign('codigo_solicitacao')->references('codigo_solicitacao')->on('solicitacoes_orcamentos')->onDelete('cascade');
            $table->foreign('id_usuario_responsavel')->references('id')->on('usuarios')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orcamentos');
    }
};
