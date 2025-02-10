<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoOrcamento;
use App\Models\Orcamento;
use App\Models\Usuarios;
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
            // Recupera os IDs dos usuários salvos no banco de dados
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.designar', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento'));
    }


    public function salvarOrcamento(Request $request)
    {



        $request->validate([
            'nome_cirurgiao' => 'nullable|string',
            'telefone_cirurgiao' => 'nullable|string',
            'email_cirurgiao' => 'nullable|email',
            'crm_cirurgiao' => 'nullable|string',
            'precos_procedimentos' => 'nullable|json',
        ]);

        $request->merge([
            'id_usuarios_cirurgioes' => (int) $request->id_usuarios_cirurgioes
        ]);

        $request->merge([
            'id_usuarios_anestesistas' => (int) $request->id_usuarios_anestesistas
        ]);

        $dados = $request->except('_token');
        $dados['codigo_tabela_base'] = 1;
        $codigoSolicitacao = session('codigo_solicitacao');

        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }

        $dados['codigo_solicitacao'] = $codigoSolicitacao;

        $camposCirurgiao = ['nome_cirurgiao', 'telefone_cirurgiao', 'email_cirurgiao', 'crm_cirurgiao'];
        foreach ($camposCirurgiao as $campo) {
            $dados[$campo] = $dados[$campo] ?? "";
        }

        $agentesEditar = $request->input('agentes', []);
        $agentesenviados = $request->input('agentesEnviados', []);

        $idsEditar = array_keys($agentesEditar);
        $idsVisualizar = json_decode($agentesenviados);




        $dados['id_usuarios_editar'] = json_encode($idsEditar ?: []);
        $dados['id_usuarios_visualizar'] = json_encode(array_values(array_diff($idsVisualizar, $idsEditar)) ?: []);



        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');

        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        if ($solicitacao) {
            $solicitacao->status = $dados['status'];
            $solicitacao->data_cirurgiao = Carbon::now();
            $solicitacao->save(); // Salva a alteração no banco
        }


        if ($orcamento) {
            $dados['id_usuarios_cirurgioes'] = isset($dados['id_usuarios_cirurgioes']) ? (int) $dados['id_usuarios_cirurgioes'] : null;
            $dados['id_usuarios_anestesistas'] = isset($dados['id_usuarios_anestesistas']) ? (int) $dados['id_usuarios_anestesistas'] : null;

            $orcamento->update($dados);

            return redirect()->route('dashboard')->with('mensagem', 'Orçamento atualizado com sucesso!');
        } else {
            Orcamento::create($dados);

            return redirect()->route('dashboard')->with('mensagem', 'Orçamento criado com sucesso!');
        }
    }


    public function cirurgiao($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();




        return view('orcamento.cirurgiao', compact('solicitacao', 'orcamento'));
    }

    public function salvarAlteracoes (Request $request)
    {


        $dados = $request->only(['resumoProcedimento', 'detalhesProcedimento', 'data_provavel', 'precos_procedimentos']);
        $dados['status'] = 'anestesista';
        $codigoSolicitacao = session('codigo_solicitacao');

        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');

        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }


        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        if ($orcamento) {

            if ($solicitacao) {
                $solicitacao->status = $dados['status'];
                $solicitacao->data_anestesista = Carbon::now();
                $solicitacao->save();
            } else {
                return redirect()->back()->with('erro', 'Solicitação não encontrado.');
            }
        $orcamento->update($dados);

        return redirect()->route('dashboard')->with('mensagem', 'Orçamento atualizado com sucesso!');

        } else {
            return redirect()->back()->with('erro', 'Orçamento não encontrado.');
        }


    }




    public function anestesia($id)
    {
        $solicitacao = SolicitacaoOrcamento::findOrFail($id);

        $orcamento = Orcamento::where('codigo_solicitacao', $id)->first();




        return view('orcamento.anestesista', compact('solicitacao', 'orcamento'));
    }


    public function salvarAlteracoesAnestesia (Request $request)
    {


        $dados = $request->only(['precos_procedimentos']);
        $dados['status'] = 'criacao';
        $codigoSolicitacao = session('codigo_solicitacao');

        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');

        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }


        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        if ($orcamento) {

            if ($solicitacao) {
                $solicitacao->status = $dados['status'];
                $solicitacao->data_criacao = Carbon::now();
                $solicitacao->save();
            } else {
                return redirect()->back()->with('erro', 'Solicitação não encontrado.');
            }
        $orcamento->update($dados);

        return redirect()->route('dashboard')->with('mensagem', 'Orçamento atualizado com sucesso!');

        } else {
            return redirect()->back()->with('erro', 'Orçamento não encontrado.');
        }


    }

    public function criacaoOrcamento($id)
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
            // Recupera os IDs dos usuários salvos no banco de dados
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.criar', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento'));
    }


    public function criar(Request $request)
    {



        $request->validate([
            'nome_cirurgiao' => 'nullable|string',
            'telefone_cirurgiao' => 'nullable|string',
            'email_cirurgiao' => 'nullable|email',
            'crm_cirurgiao' => 'nullable|string',
            'precos_procedimentos' => 'nullable|json',
        ]);

        $request->merge([
            'id_usuarios_cirurgioes' => (int) $request->id_usuarios_cirurgioes
        ]);

        $request->merge([
            'id_usuarios_anestesistas' => (int) $request->id_usuarios_anestesistas
        ]);

        $dados = $request->except('_token');
        $dados['codigo_tabela_base'] = 1;
        $codigoSolicitacao = session('codigo_solicitacao');

        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }

        $dados['codigo_solicitacao'] = $codigoSolicitacao;

        $camposCirurgiao = ['nome_cirurgiao', 'telefone_cirurgiao', 'email_cirurgiao', 'crm_cirurgiao'];
        foreach ($camposCirurgiao as $campo) {
            $dados[$campo] = $dados[$campo] ?? "";
        }

        $agentesEditar = $request->input('agentes', []);
        $agentesenviados = $request->input('agentesEnviados', []);

        $idsEditar = array_keys($agentesEditar);
        $idsVisualizar = json_decode($agentesenviados);




        $dados['id_usuarios_editar'] = json_encode($idsEditar ?: []);
        $dados['id_usuarios_visualizar'] = json_encode(array_values(array_diff($idsVisualizar, $idsEditar)) ?: []);



        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');



        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();



        if ($solicitacao) {
            $solicitacao->status = $dados['status'];
            $solicitacao->data_liberacao = Carbon::now();
            $solicitacao->save();
        }



            $dados['id_usuarios_cirurgioes'] = isset($dados['id_usuarios_cirurgioes']) ? (int) $dados['id_usuarios_cirurgioes'] : null;
            $dados['id_usuarios_anestesistas'] = isset($dados['id_usuarios_anestesistas']) ? (int) $dados['id_usuarios_anestesistas'] : null;

            if ($request->hasFile('arquivo_condicoes')) {
                $arquivo = $request->file('arquivo_condicoes');

                if (in_array($arquivo->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {


                    $nomeArquivo = time() . '_' . uniqid() . '.' . $arquivo->getClientOriginalExtension();


                    $caminho = $arquivo->storeAs('uploads', $nomeArquivo, 'public');


                    $orcamento->arquivo_anexo = 'storage/' . $caminho;
                }
            }

            $orcamento->update($dados);

            return redirect()->route('dashboard')->with('mensagem', 'Orçamento atualizado com sucesso!');
    }


    public function liberacao($id)
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
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.liberacao', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento'));
    }


    public function liberar(Request $request)
    {



        $request->validate([
            'nome_cirurgiao' => 'nullable|string',
            'telefone_cirurgiao' => 'nullable|string',
            'email_cirurgiao' => 'nullable|email',
            'crm_cirurgiao' => 'nullable|string',
            'precos_procedimentos' => 'nullable|json',
        ]);

        $request->merge([
            'id_usuarios_cirurgioes' => (int) $request->id_usuarios_cirurgioes
        ]);

        $request->merge([
            'id_usuarios_anestesistas' => (int) $request->id_usuarios_anestesistas
        ]);



        $dados = $request->except('_token');
        $dados['codigo_tabela_base'] = 1;
        $codigoSolicitacao = session('codigo_solicitacao');
        $dados['status'] = $request->status;



        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }

        $dados['codigo_solicitacao'] = $codigoSolicitacao;

        $camposCirurgiao = ['nome_cirurgiao', 'telefone_cirurgiao', 'email_cirurgiao', 'crm_cirurgiao'];
        foreach ($camposCirurgiao as $campo) {
            $dados[$campo] = $dados[$campo] ?? "";
        }



        $agentesEditar = $request->input('agentes', []);
        $agentesenviados = $request->input('agentesEnviados', []);

        $idsEditar = array_keys($agentesEditar);
        $idsVisualizar = json_decode($agentesenviados);




        $dados['id_usuarios_editar'] = json_encode($idsEditar ?: []);
        $dados['id_usuarios_visualizar'] = json_encode(array_values(array_diff($idsVisualizar, $idsEditar)) ?: []);



        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');



        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        if ($solicitacao) {
            $solicitacao->status = $dados['status'];
            $solicitacao->data_negociacao = Carbon::now();
            $solicitacao->save();
        }





            $dados['id_usuarios_cirurgioes'] = isset($dados['id_usuarios_cirurgioes']) ? (int) $dados['id_usuarios_cirurgioes'] : null;
            $dados['id_usuarios_anestesistas'] = isset($dados['id_usuarios_anestesistas']) ? (int) $dados['id_usuarios_anestesistas'] : null;

            if ($request->hasFile('arquivo_condicoes')) {
                $arquivo = $request->file('arquivo_condicoes');

                if (in_array($arquivo->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {


                    $nomeArquivo = time() . '_' . uniqid() . '.' . $arquivo->getClientOriginalExtension();


                    $caminho = $arquivo->storeAs('uploads', $nomeArquivo, 'public');


                    $orcamento->arquivo_anexo = 'storage/' . $caminho;
                }
            }

            $orcamento->update($dados);

            return redirect()->route('dashboard')->with('mensagem', 'Orçamento atualizado com sucesso!');
    }

    public function negociacao($id)
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
            $idCirurgiaoSelecionado = $orcamento->id_usuarios_cirurgioes ?? null;
            $idAnestesistaSelecionado = $orcamento->id_usuarios_anestesistas ?? null;
            $idsVisualizar = $orcamento->id_usuarios_visualizar ? json_decode($orcamento->id_usuarios_visualizar, true) : [];
            $idsEditar = $orcamento->id_usuarios_editar ? json_decode($orcamento->id_usuarios_editar, true) : [];
        }

        return view('orcamento.negociacao', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes', 'idCirurgiaoSelecionado', 'idAnestesistaSelecionado', 'idsVisualizar', 'idsEditar', 'orcamento'));
    }


    public function concluir(Request $request)
    {

 



        $request->validate([
            'nome_cirurgiao' => 'nullable|string',
            'telefone_cirurgiao' => 'nullable|string',
            'email_cirurgiao' => 'nullable|email',
            'crm_cirurgiao' => 'nullable|string',
            'precos_procedimentos' => 'nullable|json',
        ]);

        $request->merge([
            'id_usuarios_cirurgioes' => (int) $request->id_usuarios_cirurgioes
        ]);

        $request->merge([
            'id_usuarios_anestesistas' => (int) $request->id_usuarios_anestesistas
        ]);



        $dados = $request->except('_token');
        $dados['codigo_tabela_base'] = 1;
        $codigoSolicitacao = session('codigo_solicitacao');
        $dados['status'] = $request->status;



        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }

        $dados['codigo_solicitacao'] = $codigoSolicitacao;

        $camposCirurgiao = ['nome_cirurgiao', 'telefone_cirurgiao', 'email_cirurgiao', 'crm_cirurgiao'];
        foreach ($camposCirurgiao as $campo) {
            $dados[$campo] = $dados[$campo] ?? "";
        }



        $agentesEditar = $request->input('agentes', []);
        $agentesenviados = $request->input('agentesEnviados', []);

        $idsEditar = array_keys($agentesEditar);
        $idsVisualizar = json_decode($agentesenviados);




        $dados['id_usuarios_editar'] = json_encode($idsEditar ?: []);
        $dados['id_usuarios_visualizar'] = json_encode(array_values(array_diff($idsVisualizar, $idsEditar)) ?: []);



        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');



        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

        if ($solicitacao) {
            $solicitacao->status = $dados['status'];
            $solicitacao->data_concluido = Carbon::now();
            $solicitacao->save();
        }





            $dados['id_usuarios_cirurgioes'] = isset($dados['id_usuarios_cirurgioes']) ? (int) $dados['id_usuarios_cirurgioes'] : null;
            $dados['id_usuarios_anestesistas'] = isset($dados['id_usuarios_anestesistas']) ? (int) $dados['id_usuarios_anestesistas'] : null;

            if ($request->hasFile('arquivo_condicoes')) {
                $arquivo = $request->file('arquivo_condicoes');

                if (in_array($arquivo->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {


                    $nomeArquivo = time() . '_' . uniqid() . '.' . $arquivo->getClientOriginalExtension();


                    $caminho = $arquivo->storeAs('uploads', $nomeArquivo, 'public');


                    $orcamento->arquivo_anexo = 'storage/' . $caminho;
                }
            }

            $orcamento->update($dados);

            return redirect()->route('dashboard')->with('mensagem', 'Orçamento atualizado com sucesso!');
    }

}

