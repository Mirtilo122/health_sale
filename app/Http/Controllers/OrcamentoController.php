<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitacaoOrcamento;
use App\Models\Orcamento;
use App\Models\Usuarios;

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
            'precos_procedimentos' => 'nullable|json', // Adiciona validação para JSON
        ]);

        $dados = $request->except('_token');
        $dados['codigo_tabela_base'] = 1;
        $codigoSolicitacao = session('codigo_solicitacao');

        if (!$codigoSolicitacao) {
            return redirect()->back()->with('erro', 'Código da solicitação não encontrado.');
        }

        $dados['codigo_solicitacao'] = $codigoSolicitacao;

        // Definir valores padrão para os campos do cirurgião
        $camposCirurgiao = ['nome_cirurgiao', 'telefone_cirurgiao', 'email_cirurgiao', 'crm_cirurgiao'];
        foreach ($camposCirurgiao as $campo) {
            $dados[$campo] = $dados[$campo] ?? "";
        }

        // Processar permissões de edição e visualização
        $agentesEditar = $request->input('agentes', []);
        $agentesVisualizar = $request->input('agentesVisualizar', []);

        $idsEditar = array_keys($agentesEditar);
        $idsVisualizar = array_keys($agentesVisualizar);

        $dados['id_usuarios_editar'] = json_encode($idsEditar ?: []);
        $dados['id_usuarios_visualizar'] = json_encode(array_values(array_diff($idsVisualizar, $idsEditar)) ?: []);

        // Armazenar preços dos procedimentos em JSON
        $dados['precos_procedimentos'] = $request->input('precos_procedimentos', '[]');

        $orcamento = Orcamento::where('codigo_solicitacao', $codigoSolicitacao)->first();

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
}
