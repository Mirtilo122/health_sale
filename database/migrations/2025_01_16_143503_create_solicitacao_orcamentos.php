<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        Schema::create('solicitacoes_orcamentos', function (Blueprint $table) {
            $table->id('codigo_solicitacao');
            $table->string('solicitante', 255);
            $table->string('nome_solicitante', 255);
            $table->string('telefone', 20);
            $table->string('email', 255);
            $table->string('canal_contato', 50);
            $table->timestamp('data_solicitacao')->useCurrent();
            $table->string('protocolo', 20)->unique();
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
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->string('arquivo_pdf', 255)->nullable();
            $table->boolean('urgencia')->default(false);
            $table->string('cirurgiao', 255)->default('nao');
            $table->string('nome_cirurgiao', 255)->default('');
            $table->string('telefone_cirurgiao', 20)->default('');
            $table->string('email_cirurgiao', 70)->default('');
            $table->string('crm_cirurgiao', 70)->default('');
        });

        // Criar o Trigger para gerar automaticamente o protocolo
        DB::unprepared("
        DROP TRIGGER IF EXISTS before_insert_solicitacoes_orcamentos;
        CREATE TRIGGER before_insert_solicitacoes_orcamentos
        BEFORE INSERT ON solicitacoes_orcamentos
        FOR EACH ROW BEGIN
            SET NEW.protocolo = CONCAT('PRT', LPAD(FLOOR(RAND() * 1000000), 6, '0'));
        END;
    ");
    }

    public function down() {
        Schema::dropIfExists('solicitacoes_orcamentos');

        // Remover o Trigger
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_solicitacoes_orcamentos;");
    }
};
