@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'INÍCIO')

@section('conteudo')

<main>

<Style>
    input[type="text"],
    input[type="date"],
    input[type="email"],
    input[type="number"],
    select,
    textarea {
        width: 100%;
        height: 2rem;
        padding: 7px;
        font-size: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
        background-color: #f8f9fa;
        color: #333;
}
</Style>


<div class="container">
    <h2>Editar Orçamento</h2>

    <form action="{{ route('manutencao.orcamentos.atualizar', $orcamento->codigo_solicitacao) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Código do Orçamento</label>
            <input type="text" class="form-control" value="{{ $orcamento->codigo_orcamento }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Código da Solicitação</label>
            <input type="text" class="form-control" value="{{ $orcamento->codigo_solicitacao }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Nome do Solicitante</label>
            <input type="text" class="form-control" name="nome_solicitante" value="{{ $orcamento->nome_solicitante }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nome do Paciente</label>
            <input type="text" class="form-control" name="nome_paciente" value="{{ $orcamento->nome_paciente }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label> <br>
            <select name="status" id="status">
                <option value="novo" {{ $solicitacao->status == "novo" ? 'selected' : '' }}>Novo</option>
                <option value="atribuido" {{ $solicitacao->status == "atribuido" ? 'selected' : '' }}>Atribuída</option>
                <option value="cirurgiao" {{ $solicitacao->status == "cirurgiao" ? 'selected' : '' }}>Retorno Cirurgião</option>
                <option value="anestesista" {{ $solicitacao->status == "anestesista" ? 'selected' : '' }}>Retorno Anestesista</option>
                <option value="criacao" {{ $solicitacao->status == "criacao"  ? 'selected' : '' }}>Retorno Responsável</option>
                <option value="liberacao" {{ $solicitacao->status == "liberacao"  ? 'selected' : '' }}>Em Liberação</option>
                <option value="negociacao" {{ $solicitacao->status == "negociacao"  ? "selected" : '' }}>Em Negociação</option>
                <option value="aprovado" {{ $solicitacao->status == "aprovado" ? "selected" : '' }}>Aprovado</option>
                <option value="perdido" {{ $solicitacao->status =="perdido" ? 'selected' : '' }}>Perdido</option>
                <option value="recusado" {{ $solicitacao->status == "recusado" ? 'selected' : '' }}>Recusado</option>
                <option value="inativo" {{ $solicitacao->status == "inativo" ? 'selected' : '' }}>Inativo</option>
                <option value="indefinido" {{ $solicitacao->status == "indefinido" ? 'selected' : '' }}>Indefinido</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Usuário Responsável</label>
            <input type="number" class="form-control" name="id_usuario_responsavel" value="{{ $orcamento->id_usuario_responsavel }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Validade</label>
            <input type="date" class="form-control" name="validade" value="{{ $orcamento->validade }}">
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('manutencao.orcamentos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>


</main>



@endsection




