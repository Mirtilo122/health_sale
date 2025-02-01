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
        $agentes = Usuarios::where('nivel_acesso', 'agente')->get();

        return view('orcamento.montarEquipe', compact('solicitacao', 'cirurgioes', 'anestesistas', 'agentes'));
    }

    public function salvarOrcamento(Request $request)
    {
        $request->validate([
            'solicitacao_id' => 'required|exists:solicitacoes_orcamentos,id',
            'cirurgiao' => 'required|exists:users,id',
            'anestesista' => 'required|exists:users,id',
            'agentes_edicao' => 'nullable|array',
            'agentes_visualizacao' => 'nullable|array',
        ]);

        $solicitacao = SolicitacaoOrcamento::findOrFail($request->solicitacao_id);

        $orcamento = new Orcamento();
        $orcamento->codigo_solicitacao = $solicitacao->id;
        $orcamento->cirurgiao = $request->cirurgiao;
        $orcamento->anestesista = $request->anestesista;
        $orcamento->agentes_edicao = json_encode($request->agentes_edicao ?? []);
        $orcamento->agentes_visualizacao = json_encode($request->agentes_visualizacao ?? []);

        // Copia os dados da solicitação para o orçamento
        $orcamento->fill($solicitacao->toArray());

        $orcamento->save();

        return redirect()->route('orcamento.montarEquipe', $solicitacao->id)
                         ->with('success', 'Orçamento atribuído com sucesso.');
    }
}
