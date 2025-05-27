<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoOrcamento;
use App\Models\Orcamento;
use App\Models\Usuarios;
use App\Models\Prestador;
use App\Models\Modelo;
use App\Models\Tuss;
use App\Models\ModeloPadrao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class OrcamentoController extends Controller
{
    private function carregarDados($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->where('ativo', 1)->orderBy('usuario')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->where('ativo', 1)->orderBy('usuario')->get();
        $idsUsuariosPrestadores = $cirurgioes->pluck('id')->merge($anestesistas->pluck('id'))->unique();
        $prestadores = Prestador::whereIn('usuario_id', $idsUsuariosPrestadores)->get();
        $agentes = Usuarios::whereIn('acesso', ['Agente', 'Gerente', 'Administrador'])
                            ->where('ativo', 1)
                            ->orderBy('usuario')
                            ->get();
        $modelos = Modelo::where('ativo', true)->get();
        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();
        $modeloPadroes = ModeloPadrao::all()->keyBy('tipo');

        $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
        $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
        $idsVisualizar = [];
        $idsEditar = [];


        if (!$orcamento && $solicitacao->status !== 'atribuido') {
            return false;
        }

        if ($orcamento) {
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
            $orcamento->validade = $orcamento->validade ? Carbon::parse($orcamento->validade)->format('Y-m-d') : null;
            $dados = $orcamento;
        } else {
            $dados = $solicitacao;
        }

        return compact(
            'solicitacao', 'cirurgioes', 'anestesistas', 'agentes',
            'idCirurgiaoSelecionado', 'idAnestesistaSelecionado',
            'idsVisualizar', 'idsEditar', 'orcamento', 'modelos', 'modeloPadroes', 'dados', 'prestadores'
        );
    }

    private function atualizarSolicitacaoEAtribuir($solicitacao)
    {
        $solicitacao->status = 'atribuido';
        $solicitacao->save();
    }

    public function atribuirUsuarios($id)
    {
        $dados = $this->carregarDados($id);

        $solicitacao = $dados['solicitacao'];
        $cirurgioes = $dados['cirurgioes'];
        $anestesistas = $dados['anestesistas'];
        $agentes = $dados['agentes'];
        $modelos = $dados['modelos'];
        $modeloPadroes = $dados['modeloPadroes'];
        $orcamento = $dados['orcamento'];
        $idCirurgiaoSelecionado = $dados['idCirurgiaoSelecionado'];
        $idAnestesistaSelecionado = $dados['idAnestesistaSelecionado'];
        $idsVisualizar = $dados['idsVisualizar'];
        $idsEditar = $dados['idsEditar'];
        $prestadores = $dados['prestadores'];
        $dados = $dados['dados'];

        $status = $solicitacao->status;
        if ($status !== 'atribuido') {
            return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
        }


        return view('orcamento.designar', compact('solicitacao', 'cirurgioes', 'modeloPadroes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'dados', 'prestadores'));
    }


    public function cirurgiao($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();

        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;

        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->where('ativo', 1)->orderBy('usuario')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->where('ativo', 1)->orderBy('usuario')->get();
        $idsUsuariosPrestadores = $cirurgioes->pluck('id')->merge($anestesistas->pluck('id'))->unique();
        $prestadores = Prestador::whereIn('usuario_id', $idsUsuariosPrestadores)->get();
        $modelos = Modelo::where('ativo', true)->get();
        $modeloPadroes = ModeloPadrao::all()->keyBy('tipo');


        if ($orcamento){
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $dados = $orcamento;
        } else {
            $this->atualizarSolicitacaoEAtribuir($solicitacao);

            return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado. Solicitação atualizada para "Atribuídas".');
        }

        $status = $solicitacao->status;

        if ($status !== 'cirurgiao') {
            return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
        }



        return view('orcamento.cirurgiao', compact('solicitacao', 'orcamento', 'dados', 'idAnestesistaSelecionado', 'idCirurgiaoSelecionado', 'prestadores', 'modelos', 'modeloPadroes'));
    }
    public function anestesia($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();

        $idCirurgiaoSelecionado = null;
        $idAnestesistaSelecionado = null;

        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->where('ativo', 1)->orderBy('usuario')->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->where('ativo', 1)->orderBy('usuario')->get();
        $idsUsuariosPrestadores = $cirurgioes->pluck('id')->merge($anestesistas->pluck('id'))->unique();
        $prestadores = Prestador::whereIn('usuario_id', $idsUsuariosPrestadores)->get();
        $modelos = Modelo::where('ativo', true)->get();
        $modeloPadroes = ModeloPadrao::all()->keyBy('tipo');

        if ($orcamento){
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $dados = $orcamento;
        } else {
            $this->atualizarSolicitacaoEAtribuir($solicitacao);

            return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado. Solicitação atualizada para "Atribuídas".');
        }

        $status = $solicitacao->status;

        if ($status !== 'anestesista') {
            return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
        }

        return view('orcamento.anestesista', compact('solicitacao', 'orcamento', 'dados', 'idAnestesistaSelecionado', 'idCirurgiaoSelecionado', 'prestadores', 'modelos', 'modeloPadroes'));
    }


    public function criacaoOrcamento($id)
    {
        $dados = $this->carregarDados($id);

        if (!$dados) {
            $solicitacao = SolicitacaoOrcamento::findOrFail($id);
            $this->atualizarSolicitacaoEAtribuir($solicitacao);

            return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado. Solicitação atualizada para "Atribuídas".');
        }

        $solicitacao = $dados['solicitacao'];
        $cirurgioes = $dados['cirurgioes'];
        $anestesistas = $dados['anestesistas'];
        $agentes = $dados['agentes'];
        $modelos = $dados['modelos'];
        $modeloPadroes = $dados['modeloPadroes'];
        $orcamento = $dados['orcamento'];
        $idCirurgiaoSelecionado = $dados['idCirurgiaoSelecionado'];
        $idAnestesistaSelecionado = $dados['idAnestesistaSelecionado'];
        $idsVisualizar = $dados['idsVisualizar'];
        $idsEditar = $dados['idsEditar'];
        $prestadores = $dados['prestadores'];
        $dados = $dados['dados'];

        $status = $solicitacao->status;
        if ($status !== 'criacao') {
            return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
        }

        return view('orcamento.criar', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modeloPadroes', 'modelos', 'dados', 'prestadores'));
    }


    public function liberacao($id)
    {
        $dados = $this->carregarDados($id);

        if (!$dados) {
            $solicitacao = SolicitacaoOrcamento::findOrFail($id);
            $this->atualizarSolicitacaoEAtribuir($solicitacao);

            return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado. Solicitação atualizada para "Atribuídas".');
        }



        $solicitacao = $dados['solicitacao'];
        $cirurgioes = $dados['cirurgioes'];
        $anestesistas = $dados['anestesistas'];
        $agentes = $dados['agentes'];
        $modelos = $dados['modelos'];
        $modeloPadroes = $dados['modeloPadroes'];
        $orcamento = $dados['orcamento'];
        $idCirurgiaoSelecionado = $dados['idCirurgiaoSelecionado'];
        $idAnestesistaSelecionado = $dados['idAnestesistaSelecionado'];
        $idsVisualizar = $dados['idsVisualizar'];
        $idsEditar = $dados['idsEditar'];
        $prestadores = $dados['prestadores'];
        $dados = $dados['dados'];


        $status = $solicitacao->status;
        if ($status !== 'liberacao') {
            return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
        }

        return view('orcamento.liberacao', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'modeloPadroes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos', 'dados', 'prestadores'));
    }


    public function negociacao($id)
    {
        $dados = $this->carregarDados($id);

        if (!$dados) {
            $solicitacao = SolicitacaoOrcamento::findOrFail($id);
            $this->atualizarSolicitacaoEAtribuir($solicitacao);

            return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado. Solicitação atualizada para "Atribuídas".');
        }

        $solicitacao = $dados['solicitacao'];
        $cirurgioes = $dados['cirurgioes'];
        $anestesistas = $dados['anestesistas'];
        $agentes = $dados['agentes'];
        $modelos = $dados['modelos'];
        $modeloPadroes = $dados['modeloPadroes'];
        $orcamento = $dados['orcamento'];
        $idCirurgiaoSelecionado = $dados['idCirurgiaoSelecionado'];
        $idAnestesistaSelecionado = $dados['idAnestesistaSelecionado'];
        $idsVisualizar = $dados['idsVisualizar'];
        $idsEditar = $dados['idsEditar'];
        $prestadores = $dados['prestadores'];
        $dados = $dados['dados'];

        $status = $solicitacao->status;
        if ($status !== 'negociacao') {
            return redirect()->route('dashboard')->with('error', 'Ação não permitida.');
        }

        return view('orcamento.negociacao', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'modeloPadroes', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos', 'dados', 'prestadores'));
    }


    public function concluido($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);
        $cirurgioes = Usuarios::where('funcao', 'cirurgiao')->where('ativo', 1)->get();
        $anestesistas = Usuarios::where('funcao', 'anestesista')->where('ativo', 1)->get();

        $idsUsuariosPrestadores = $cirurgioes->pluck('id')->merge($anestesistas->pluck('id'))->unique();
        $prestadores = Prestador::whereIn('usuario_id', $idsUsuariosPrestadores)->get();

        $agentes = Usuarios::whereIn('acesso', ['Agente', 'Gerente', 'Administrador'])
                        ->where('ativo', 1)
                        ->get();

        $modelos = Modelo::where('ativo', true)->get();
        $modeloPadroes = ModeloPadrao::all()->keyBy('tipo');

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
            $dados = $orcamento;
        } else {
            $dados = $solicitacao;
        }


        return view('orcamento.concluido', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'modeloPadroes', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento', 'modelos', 'dados', 'prestadores'));
    }

    public function atualizarOrcamento(Request $request)
    {


        session(['aba_ativa' => $request->aba_ativa]);

        $validator = Validator::make($request->all(), [
            'nome_cirurgiao' => 'nullable|string',
            'telefone_cirurgiao' => 'nullable|string',
            'email_cirurgiao' => 'nullable|email',
            'crm_cirurgiao' => 'nullable|string',
            'precos_procedimentos' => 'nullable|json',
            'procedimentos_json' => 'nullable|json',
            'taxa_cirurgiao' => 'nullable|string',
            'taxa_anestesia' => 'nullable|string',
            'condPagamentoAnestesista' => 'nullable|string',
            'condPagamentoCirurgiao' => 'nullable|string',
            'condPagamentoHosp' => 'nullable|string',
            'validade' => 'nullable|date',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('warn', 'Erro na validação! Preencha corretamente os campos.');
        }

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
            $permitidos = ['resumoProcedimento', 'detalhesProcedimento', 'data_provavel', 'precos_procedimentos', 'status', 'data_cirurgiao', 'tempo_cirurgia', 'valor_total', 'taxa_cirurgiao', 'anestesia_raqui', 'anestesia_sma', 'anestesia_peridural', 'anestesia_sedacao', 'anestesia_externo', 'anestesia_bloqueio', 'anestesia_local', 'anestesia_outros', 'condPagamentoCirurgiao', 'diarias_enfermaria', 'diarias_apartamento', 'diarias_uti', 'id_usuarios_cirurgioes', 'id_usuarios_anestesistas'];
            $dados = $request->only($permitidos);
            $taxaCirurgiao = json_decode($request->taxa_cirurgiao, true);
            $dados['taxa_cirurgiao'] = $taxaCirurgiao;
            $dados['cond_pagamento_cirurgiao'] = $request->input('condPagamentoCirurgiao');
        } elseif ($tipoData === 'data_criacao') {
            $permitidos = ['precos_procedimentos', 'status', 'data_anestesista', 'valor_total', 'taxa_anestesista', 'anestesia_raqui', 'anestesia_sma', 'anestesia_peridural', 'anestesia_sedacao', 'anestesia_externo', 'anestesia_bloqueio', 'anestesia_local', 'anestesia_outros', 'condPagamentoAnestesista', 'diarias_enfermaria', 'diarias_apartamento', 'diarias_uti', 'id_usuarios_cirurgioes', 'id_usuarios_anestesistas'];
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
            $procedimentosSecundarios = $request->procedimentos_json;

            $dados = $request->except('_token');
            $dados['codigo_tabela_base'] = 1;

            $dados['cond_pagamento_anestesista'] = $request->input('condPagamentoAnestesista');
            $dados['cond_pagamento_cirurgiao'] = $request->input('condPagamentoCirurgiao');
            $dados['cond_pagamento_hosp'] = $request->input('condPagamentoHosp');

            $dados['taxa_cirurgiao'] = $taxaCirurgiao;
            $dados['taxa_anestesista'] = $taxaAnestesia;
            $dados['procedimentos_secundarios'] = $procedimentosSecundarios;

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
        $dados['observacoes_adicionais'] = trim($request->observacoes_adicionais);


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

        if ($solicitacao) {
            $solicitacao->save();
        }

        return redirect()->route('dashboard')->with('mensagem', $mensagem);
    }










    public function searchTussCodigo(Request $request)
    {
        $query = $request->get('query');

        $results = Tuss::where('codigo', 'LIKE', "%$query%")
                    ->limit(10)
                    ->get();

        return response()->json($results);
    }

    public function searchTussDescricao(Request $request)
    {
        $query = $request->get('query');


        $results = Tuss::where('descricao', 'LIKE', "%$query%")
                    ->limit(10)
                    ->get();

        return response()->json($results);
    }





    // Manutenção


    public function manutencao_listar()
    {
        $orcamentos = Orcamento::all();
        return view('manutencao.lista_orcamentos', compact('orcamentos'));
    }

    public function manutencao_editar($codigoSolicitacao)
    {
        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();
        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();
        return view('manutencao.editar_orcamento', compact('orcamento', 'solicitacao'));
    }

    public function manutencao_salvar(Request $request, $codigoSolicitacao)
    {
        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();
        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $orcamento->update($request->all());

        $solicitacao->update($request->only('status'));

        return redirect()->route('manutencao.orcamentos')->with('success', 'Orçamento atualizado com sucesso!');
    }

}

