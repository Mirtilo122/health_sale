<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $table = 'orcamentos';
    protected $primaryKey = 'codigo_orcamento';
    protected $fillable = [
        'codigo_solicitacao',
        'codigo_tabela_base',
        'solicitante',
        'nome_solicitante',
        'telefone',
        'email',
        'canal_contato',
        'data_solicitacao',
        'origem_orcamento',
        'tipo_orcamento',
        'convenio',
        'observacoes_adicionais',
        'nome_paciente',
        'data_nascimento',
        'cidade',
        'comorbidades',
        'descricao_comorbidades',
        'resumo_procedimento',
        'detalhes_procedimento',
        'tempo_cirurgia',
        'data_provavel',
        'diarias_enfermaria',
        'diarias_apartamento',
        'diarias_uti',
        'anestesia_raqui',
        'anestesia_sma',
        'anestesia_peridural',
        'anestesia_sedacao',
        'anestesia_externo',
        'anestesia_bloqueio',
        'anestesia_local',
        'anestesia_outros',
        'observacoes',
        'status',
        'arquivo_pdf',
        'arquivo_anexo',
        'arquivo_orcamento',
        'urgencia',
        'cirurgiao',
        'nome_cirurgiao',
        'telefone_cirurgiao',
        'email_cirurgiao',
        'crm_cirurgiao',
        'id_usuario_responsavel',
        'id_usuarios_visualizar',
        'id_usuarios_editar',
        'id_usuarios_anestesistas',
        'id_usuarios_cirurgioes',
        'precos_procedimentos'
    ];

    protected $casts = [
        'id_usuarios_visualizar' => 'array',
        'id_usuarios_editar' => 'array',
        'id_usuarios_anestesistas' => 'array',
        'id_usuarios_cirurgioes' => 'array',
        'precos_procedimentos' => 'array',
    ];

    public function solicitacao()
    {
        return $this->belongsTo(SolicitacaoOrcamento::class, 'codigo_solicitacao');
    }


    public function responsavel()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario_responsavel');
    }
    public function cirurgiao()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuarios_cirurgioes');
    }
    public function anestesista()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuarios_anestesistas');
    }
}
