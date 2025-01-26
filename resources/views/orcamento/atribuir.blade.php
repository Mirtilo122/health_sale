@extends('layouts.admin')

@section('titulo', 'Atribuir Orçamento')

@section('nome_pagina', 'ORÇAMENTOS')

@section('conteudo')

<div class="container my-5">
    <h1 class="mb-4">Orçamento #{{ $detalhes->codigo_solicitacao }}</h1>

    <form action="{{ route('orcamento.atualizar') }}" method="POST">
        @csrf
        <!-- Informações do solicitante -->
        <div class="card p-4 mb-4">
            <div class="info mb-3">
                <strong>Nome do Solicitante:</strong> <span class="text-muted">{{ $detalhes->nome_solicitante }}</span>
            </div>
            <div class="info mb-3">
                <strong>Telefone:</strong> <span class="text-muted">{{ $detalhes->telefone }}</span>
            </div>
            <div class="info mb-3">
                <strong>Email:</strong> <span class="text-muted">{{ $detalhes->email }}</span>
            </div>
            <div class="info mb-3">
                <strong>Nome do Paciente:</strong> <span class="text-muted">{{ $detalhes->nome_paciente }}</span>
            </div>
            <div class="info mb-3">
                <strong>Data de Nascimento:</strong> <span class="text-muted">{{ \Carbon\Carbon::parse($detalhes->data_nascimento)->format('d/m/Y') }}</span>
            </div>
            <div class="info mb-3">
                <strong>Tipo de Orçamento:</strong>
                                @php
                                    $tipoOrcamento = ucfirst(strtolower($detalhes->tipo_orcamento));
                                @endphp
                                @if($tipoOrcamento == 'cirurgia')
                                    Cirurgia
                                @elseif($tipoOrcamento == 'parto')
                                    Parto
                                @else
                                    {{ $tipoOrcamento }}
                                @endif
            </div>
            <div class="info mb-3">
                <strong>Convênio:</strong>
                                @php
                                    $convenio = ucfirst(strtolower($detalhes->convenio));
                                @endphp
                                @if($convenio == 'nenhum')
                                    Sem Convênio
                                @elseif($convenio == 'particular')
                                    Particular
                                @elseif($convenio == 'cartaoDesconto')
                                    Cartão Desconto
                                @elseif($convenio == 'judicial')
                                    Judicial
                                @else
                                    {{ $convenio }}
                                @endif
            </div>
            <div class="info mb-3">
                <strong>Cidade:</strong> <span class="text-muted">{{ $detalhes->cidade }}</span>
            </div>
            <div class="info mb-3">
                <strong>Status Atual:</strong> <span class="text-muted">{{ $detalhes->status }}</span>
            </div>
        </div>

        <!-- Formulário de vinculação a usuário -->
        <div class="card p-4 mb-4">
            <div class="info mb-3">
                <strong>Vincular a Usuário:</strong>
                <select name="id_usuario" class="form-select">
                    <option value="">Selecione um usuário</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $detalhes->id_usuario == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->usuario }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Botões -->
        <div class="buttons d-flex justify-content-between mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
            <input type="hidden" name="codigo_solicitacao" value="{{ $detalhes->codigo_solicitacao }}">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
@endsection
