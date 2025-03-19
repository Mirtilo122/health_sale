@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'INÍCIO')

@section('conteudo')

<main>

<div class="container">
    <h2>Manutenção de Orçamentos</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cód. Solicitação</th>
                <th>Solicitante</th>
                <th>Paciente</th>
                <th>Status</th>
                <th>Usuário Responsável</th>
                <th>Data de Criação</th>
                <th>Última Atualização</th>
                <th>Valor Total</th>
                <th>Validade</th>
                <th>Emitido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orcamentos as $orcamento)
            <tr>
                <td>{{ $orcamento->codigo_orcamento }}</td>
                <td>{{ $orcamento->codigo_solicitacao }}</td>
                <td>{{ $orcamento->nome_solicitante }}</td>
                <td>{{ $orcamento->nome_paciente }}</td>
                <td>{{ $orcamento->status }}</td>
                <td>{{ $orcamento->id_usuario_responsavel }}</td>
                <td>{{ $orcamento->created_at }}</td>
                <td>{{ $orcamento->updated_at }}</td>
                <td>R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}</td>
                <td>{{ $orcamento->validade }}</td>
                <td>{{ $orcamento->orcamento_emitido ? 'Sim' : 'Não' }}</td>
                <td>
                    <a href="{{ route('manutencao.orcamentos.editar', $orcamento->codigo_solicitacao) }}" class="btn btn-primary btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</main>



@endsection
