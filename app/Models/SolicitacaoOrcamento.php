<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoOrcamento extends Model {
    use HasFactory;

    protected $table = 'solicitacoes_orcamentos';
    protected $primaryKey = 'codigo_solicitacao';
    public $timestamps = false;

    protected $fillable = [
        'solicitante', 'nome_solicitante', 'telefone', 'email',
        'canal_contato', 'origem_orcamento', 'tipo_orcamento', 'convenio',
        'observacoes_adicionais', 'nome_paciente', 'data_nascimento', 'cidade',
        'comorbidades', 'descricao_comorbidades', 'resumo_procedimento',
        'detalhes_procedimento', 'tempo_cirurgia', 'data_provavel',
        'diarias_enfermaria', 'diarias_apartamento', 'diarias_uti',
        'anestesia_raqui', 'anestesia_sma', 'anestesia_peridural',
        'anestesia_sedacao', 'anestesia_externo', 'anestesia_bloqueio',
        'anestesia_local', 'anestesia_outros', 'observacoes', 'status',
        'id_usuario', 'arquivo_pdf', 'urgencia', 'cirurgiao',
        'nome_cirurgiao',

        'data_atribuido', 'data_cirurgiao', 'data_anestesista', 'data_criacao',
        'data_liberacao', 'data_negociacao', 'data_concluido', 'orcamento_teste', 'favoritos'
    ];


    protected $casts = [
        'favoritos' => 'array',
        'orcamento_teste' => 'boolean',
    ];

    public function responsavel()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario');
    }
}
