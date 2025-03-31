<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SolicitacaoOrcamento;
use App\Models\Usuarios;

class PainelController extends Controller
{
    public function index(Request $request)
    {
        $query = SolicitacaoOrcamento::orderByDesc('urgencia');


        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome_solicitante', 'LIKE', "%{$search}%")
                ->orWhere('protocolo', 'LIKE', "%{$search}%")
                ->orWhere('convenio', 'LIKE', "%{$search}%")
                ->orWhere('nome_paciente', 'LIKE', "%{$search}%");
            });
        }

        $solicitacoes = $query->get();
        $agentes = Usuarios::whereIn('acesso', ['Agente', 'Externo'])->get();
        $usuarios = Usuarios::orderByDesc('acesso');

        return view('admin/painel', [
            'solicitacoes' => $solicitacoes,
            'usuarios' => $usuarios,
            'agentes' => $agentes
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

        $agentes = Usuarios::whereIn('acesso', ['Agente', 'Externo'])->get();
        $usuarios = Usuarios::orderByDesc('acesso');

        return view('admin/painel', ['solicitacoes' => $solicitacoes, 'selected_status' => $selected_status, 'usuarios' => $usuarios, 'agentes' => $agentes]);
    }



    public function ordenar(Request $request)
    {
            $orderBy = $request->input('order_by', 'nome_solicitante');
            $direction = $request->input('direction', 'asc');

            $solicitacoes = SolicitacaoOrcamento::orderBy($orderBy, $direction)
                                                ->orderByDesc('urgencia')
                                                ->orderByRaw("FIELD(status, 'pendente', 'aguardando', 'negociação', 'aprovado')")
                                                ->get();

            $agentes = Usuarios::whereIn('acesso', ['Agente', 'Externo'])->get();
            $usuarios = Usuarios::orderByDesc('acesso');

            return view('admin.painel', [
                'solicitacoes' => $solicitacoes,
                'order_by' => $orderBy,
                'direction' => $direction,
                'usuarios' => $usuarios,
                'agentes' => $agentes
            ]);
    }
}
