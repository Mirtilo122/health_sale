<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SolicitacaoOrcamento;
use App\Models\Usuarios;

class PainelController extends Controller
{
    public function index()
    {
        $solicitacoes = SolicitacaoOrcamento::orderByDesc('urgencia')
                                            ->get();

        $usuarios = Usuarios::whereIn('acesso', ['Agente', 'Externo'])->get();

        return view('admin/painel', [
            'solicitacoes' => $solicitacoes,
            'usuarios' => $usuarios
        ]);

    }
 
    public function filtrar(Request $request)
    {
        $selected_status = $request->input('status');

        if ($selected_status) {
            $solicitacoes = SolicitacaoOrcamento::where('status', $selected_status)
                                                ->orderByDesc('urgencia')
                                                ->orderByRaw("FIELD(status, 'pendente', 'aguardando', 'negociação', 'aprovado', 'cancelado')")
                                                ->get();
        } else {
            $solicitacoes = SolicitacaoOrcamento::orderByDesc('urgencia')
                                                ->orderByRaw("FIELD(status, 'pendente', 'aguardando', 'negociação', 'aprovado', 'cancelado')")
                                                ->get();
        }

        return view('admin/painel', ['solicitacoes' => $solicitacoes, 'selected_status' => $selected_status]);
    }



    public function ordenar(Request $request)
    {
            $orderBy = $request->input('order_by', 'nome_solicitante');
            $direction = $request->input('direction', 'asc');

            $solicitacoes = SolicitacaoOrcamento::orderBy($orderBy, $direction)
                                                ->orderByDesc('urgencia')
                                                ->orderByRaw("FIELD(status, 'pendente', 'aguardando', 'negociação', 'aprovado')")
                                                ->get();

            return view('admin.painel', [
                'solicitacoes' => $solicitacoes,
                'order_by' => $orderBy,
                'direction' => $direction,
            ]);
    }
}
