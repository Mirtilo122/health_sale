<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoOrcamento;
use App\Models\Orcamento;
use App\Models\Usuarios;
use App\Models\Modelo;
use Carbon\Carbon;

class OrcamentoController extends Controller
{
    public function atribuirUsuarios($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->get();
        $agentes = Usuarios::where('acesso', 'agente')->get();

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();

        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;
        $idsVisualizar = [];
        $idsEditar = [];

        if ($orcamento) {
            $orcamento->validade = $orcamento->validade ? Carbon::parse($orcamento->validade)->format('Y-m-d') : null;
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.designar', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento'));
    }
    public function cirurgiao($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();




        return view('orcamento.cirurgiao', compact('solicitacao', 'orcamento'));
    }
    public function anestesia($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();




        return view('orcamento.anestesista', compact('solicitacao', 'orcamento'));
    }
    public function criacaoOrcamento($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->get();
        $agentes = Usuarios::where('acesso', 'agente')->get();
        $modelos = Modelo::where('ativo', true)->get();

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();

        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;
        $idsVisualizar = [];
        $idsEditar = [];

        if ($orcamento) {
            $orcamento->validade = $orcamento->validade ? Carbon::parse($orcamento->validade)->format('Y-m-d') : null;
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.criar', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos'));
    }
    public function liberacao($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->get();
        $agentes = Usuarios::where('acesso', 'agente')->get();
        $modelos = Modelo::where('ativo', true)->get();

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();



        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;
        $idsVisualizar = [];
        $idsEditar = [];

        if ($orcamento) {
            $orcamento->validade = $orcamento->validade ? Carbon::parse($orcamento->validade)->format('Y-m-d') : null;
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.liberacao', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos'));
    }
    public function negociacao($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->get();
        $agentes = Usuarios::where('acesso', 'agente')->get();
        $modelos = Modelo::where('ativo', true)->get();

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();

        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;
        $idsVisualizar = [];
        $idsEditar = [];

        if ($orcamento) {
            $orcamento->validade = $orcamento->validade ? Carbon::parse($orcamento->validade)->format('Y-m-d') : null;
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.negociacao', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos'));
    }
    public function concluido($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->get();
        $agentes = Usuarios::where('acesso', 'agente')->get();
        $modelos = Modelo::where('ativo', true)->get();

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();

        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;
        $idsVisualizar = [];
        $idsEditar = [];

        if ($orcamento) {
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.concluido', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos'));
    }

    public function atualizarOrcamento(Request $request)
    {

        $request->validate([
            'nome_cirurgiao' => 'nullable|string',
            'telefone_cirurgiao' => 'nullable|string',
            'email_cirurgiao' => 'nullable|email',
            'crm_cirurgiao' => 'nullable|string',
            'precos_procedimentos' => 'nullable|json',
            'procedimentos_secundarios' => 'nullable|json',
            'taxa_cirurgiao' => 'nullable|string',
            'taxa_anestesia' => 'nullable|string',
            'condPagamentoAnestesista' => 'nullable|string',
            'condPagamentoCirurgiao' => 'nullable|string',
            'condPagamentoHosp' => 'nullable|string',
            'validade' => 'nullable|date',
        ]);

        $camposAnestesia = [
            'anestesia_raqui', 'anestesia_sma', 'anestesia_peridural',
            'anestesia_sedacao', 'anestesia_externo', 'anestesia_bloqueio',
            'anestesia_local'
        ];


        $codigoSolicitacao = session('codigo_solicitacao');
        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }
        $tipoData = $request->input('tipo_data');

        $permitidos = [];
        if ($tipoData === 'data_anestesista') {
            $permitidos = ['resumoProcedimento', 'detalhesProcedimento', 'data_provavel', 'precos_procedimentos', 'status', 'data_cirurgiao', 'tempo_cirurgia', 'valor_total', 'taxa_cirurgiao', 'anestesia_raqui', 'anestesia_sma', 'anestesia_peridural', 'anestesia_sedacao', 'anestesia_externo', 'anestesia_bloqueio', 'anestesia_local', 'anestesia_outros', 'condPagamentoCirurgiao', 'diarias_enfermaria', 'diarias_apartamento', 'diarias_uti'];
            $dados = $request->only($permitidos);
            $taxaCirurgiao = json_decode($request->taxa_cirurgiao, true);
            $dados['taxa_cirurgiao'] = $taxaCirurgiao;
            $dados['cond_pagamento_cirurgiao'] = $request->input('condPagamentoCirurgiao');
        } elseif ($tipoData === 'data_criacao') {
            $permitidos = ['precos_procedimentos', 'status', 'data_anestesista', 'valor_total', 'taxa_anestesista', 'anestesia_raqui', 'anestesia_sma', 'anestesia_peridural', 'anestesia_sedacao', 'anestesia_externo', 'anestesia_bloqueio', 'anestesia_local', 'anestesia_outros', 'condPagamentoAnestesista', 'diarias_enfermaria', 'diarias_apartamento', 'diarias_uti'];
            $dados = $request->only($permitidos);
            $taxaAnestesia = json_decode($request->taxa_anestesia, true);
            $dados['taxa_anestesista'] = $taxaAnestesia;
            $dados['cond_pagamento_anestesista'] = $request->input('condPagamentoAnestesista');
        } else {
            $request->merge([
                'id_usuarios_cirurgioes' => (int) $request->id_usuarios_cirurgioes,
                'id_usuarios_anestesistas' => (int) $request->id_usuarios_anestesistas
            ]);



            $taxaCirurgiao = json_decode($request->taxa_cirurgiao, true);
            $taxaAnestesia = json_decode($request->taxa_anestesia, true);

            $dados = $request->except('_token');
            $dados['codigo_tabela_base'] = 1;

            $dados['cond_pagamento_anestesista'] = $request->input('condPagamentoAnestesista');
            $dados['cond_pagamento_cirurgiao'] = $request->input('condPagamentoCirurgiao');
            $dados['cond_pagamento_hosp'] = $request->input('condPagamentoHosp');

            $dados['taxa_cirurgiao'] = $taxaCirurgiao;
            $dados['taxa_anestesista'] = $taxaAnestesia;

            $camposCirurgiao = ['nome_cirurgiao', 'telefone_cirurgiao', 'email_cirurgiao', 'crm_cirurgiao'];
            foreach ($camposCirurgiao as $campo) {
                $dados[$campo] = $dados[$campo] ?? "";
            }

            $agentesEditar = $request->input('agentes', []);
            $agentesenviados = $request->input('agentesEnviados', []);

            $idsEditar = array_keys($agentesEditar);
            $idsVisualizar = is_array($agentesenviados) ? array_keys($agentesenviados) : json_decode($agentesenviados);


            $dados['id_usuarios_editar'] = json_encode($idsEditar ?: []);
            $dados['id_usuarios_visualizar'] = json_encode(array_values(array_diff($idsVisualizar, $idsEditar)) ?: []);


            $dados['procedimentos_secundarios'] = $request->input('procedimentos_json', '[]');

            if ($request->hasFile('arquivo_condicoes')) {
                $arquivo = $request->file('arquivo_condicoes');

                if (!in_array($arquivo->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
                    return redirect()->back()->with('erro', 'Formato de arquivo não permitido.');
                }

                try {
                    $nomeArquivo = time() . '_' . uniqid() . '.' . $arquivo->getClientOriginalExtension();
                    $caminho = $arquivo->storeAs('uploads', $nomeArquivo, 'public');
                    $dados['arquivo_anexo'] = 'storage/' . $caminho;
                } catch (\Exception $e) {
                    return redirect()->back()->with('erro', 'Erro ao salvar arquivo: ' . $e->getMessage());
                }
            }


        }

        foreach ($camposAnestesia as $campo) {
            $dados[$campo] = $request->has($campo) ? 1 : 0;
        }

        $dados['status'] = $request->status;
        $dados['codigo_solicitacao'] = $codigoSolicitacao;
        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');



        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();
        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        if ($solicitacao) {
            $solicitacao->status = $dados['status'];

            $tipoData = $request->input('tipo_data');
            $dataCampos = ['data_negociacao', 'data_concluido', 'data_liberacao', 'data_cirurgiao', 'data_criacao', 'data_anestesista'];

            if ($tipoData && in_array($tipoData, $dataCampos) && !$solicitacao->$tipoData) {
               $solicitacao->$tipoData = Carbon::now();
           }

           if (isset($dados['diarias_enfermaria'])) {
                $solicitacao->diarias_enfermaria = $dados['diarias_enfermaria'];
            }

            if (isset($dados['diarias_apartamento'])) {
                $solicitacao->diarias_apartamento = $dados['diarias_apartamento'];
            }

            if (isset($dados['diarias_uti'])) {
                $solicitacao->diarias_uti = $dados['diarias_uti'];
            }

            $solicitacao->save();
        }

        if ($orcamento) {
            $dados['id_usuarios_cirurgioes'] = isset($dados['id_usuarios_cirurgioes']) ? (int) $dados['id_usuarios_cirurgioes'] : null;
            $dados['id_usuarios_anestesistas'] = isset($dados['id_usuarios_anestesistas']) ? (int) $dados['id_usuarios_anestesistas'] : null;

            $camposAnestesia = [
                'taxa_anestesista', 'anestesia_raqui', 'anestesia_sma',
                'anestesia_peridural', 'anestesia_sedacao', 'anestesia_externo',
                'anestesia_bloqueio', 'anestesia_local'
            ];


            $orcamento->update($dados);
            $mensagem = 'Orçamento atualizado com sucesso!';
        } else {
            $orcamento = Orcamento::create($dados);
            $mensagem = 'Orçamento criado com sucesso!';
        }

        return redirect()->route('dashboard')->with('mensagem', $mensagem);
    }


}

