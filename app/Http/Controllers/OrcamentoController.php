<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\SolicitacaoOrcamento;
use App\Models\TabelaPreco;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::with(['solicitacao', 'tabelaPreco', 'responsavel'])->get();
        return response()->json($orcamentos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_solicitacao' => 'required|exists:solicitacoes_orcamentos,codigo_solicitacao',
            'codigo_tabela_base' => 'nullable|exists:tabela_de_precos,codigo_tabela',
            'solicitante' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nome_paciente' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'status' => 'string|max:50',
            'precos_procedimentos' => 'required|json',
        ]);

        $orcamento = Orcamento::create($request->all());

        return response()->json($orcamento, 201);
    }

    public function show($id)
    {
        $orcamento = Orcamento::with(['solicitacao', 'tabelaPreco', 'responsavel'])->findOrFail($id);
        return response()->json($orcamento);
    }

    public function update(Request $request, $id)
    {
        $orcamento = Orcamento::findOrFail($id);
        $orcamento->update($request->all());
        return response()->json($orcamento);
    }

    public function destroy($id)
    {
        $orcamento = Orcamento::findOrFail($id);
        $orcamento->delete();
        return response()->json(['message' => 'Orçamento excluído com sucesso']);
    }
}
