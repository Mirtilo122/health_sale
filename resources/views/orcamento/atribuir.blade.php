@extends('layouts.admin')

@section('titulo', 'Atribuir Orçamento')

@section('nome_pagina', 'ORÇAMENTOS')

@section('conteudo')

<div class="container my-2 mb-0 mt-1 bg-white border-0 shadow-none">
    <h1 class="mb-4">Orçamento #{{ $detalhes->codigo_solicitacao }}</h1>

    <form action="{{ route('orcamento.atualizar') }}" method="POST">
        @csrf

        <input type="hidden" name="aba_ativa" id="aba_ativa" value="novo-tab">

        <div class="card p-4 mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="info">
                        <strong>Nome do Solicitante:</strong> <span class="text-muted">{{ $detalhes->nome_solicitante }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <strong>Telefone:</strong> <span class="text-muted">{{ $detalhes->telefone }}</span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="info">
                        <strong>Email:</strong> <span class="text-muted">{{ $detalhes->email }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <strong>Nome do Paciente:</strong> <span class="text-muted">{{ $detalhes->nome_paciente }}</span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="info">
                        <strong>Data de Nascimento:</strong> <span class="text-muted">{{ \Carbon\Carbon::parse($detalhes->data_nascimento)->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <strong>Tipo de Orçamento:</strong>
                        @php
                            $tipoOrcamento = ucfirst(strtolower($detalhes->tipo_orcamento));
                        @endphp
                        @if($tipoOrcamento == 'cirurgia')
                            <span class="text-muted">Cirurgia</span>
                        @elseif($tipoOrcamento == 'parto')
                            <span class="text-muted">Parto</span>
                        @elseif($tipoOrcamento == 'homecare')
                            <span class="text-muted">Home Care</span>
                        @elseif($tipoOrcamento == 'remocao')
                            <span class="text-muted">Remoção</span>
                        @elseif($tipoOrcamento == 'leito')
                            <span class="text-muted">Leito Uti</span>
                        @else
                            <span class="text-muted">{{ $tipoOrcamento }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="info">
                        <strong>Convênio:</strong>
                        @php
                            $convenio = ucfirst(strtolower($detalhes->convenio));
                        @endphp
                        @if($convenio == 'nenhum')
                            <span class="text-muted">Sem Convênio</span>
                        @elseif($convenio == 'Particular')
                            <span class="text-muted">Particular</span>
                        @elseif($convenio == 'Cartaodesconto')
                            <span class="text-muted">Cartão Desconto</span>
                        @elseif($convenio == 'Judicial')
                            <span class="text-muted">Judicial</span>
                        @else
                            <span class="text-muted">{{ $convenio }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <strong>Cidade:</strong> <span class="text-muted">{{ $detalhes->cidade }}</span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="info">
                        <strong>Status Atual:</strong>
                        @php
                            $status_orcamento = ucfirst(strtolower($detalhes->status));
                        @endphp
                        @if($status_orcamento == 'Novo')
                            <span class="badge bg-info text-light">Novo</span>
                        @else
                            <span class="badge bg-secondary text-light">{{ $status_orcamento }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                <div class="info">
                    <strong>Arquivo:</strong>
                    @if(is_null($detalhes->arquivo_pdf) || $detalhes->arquivo_pdf === '')
                        <p class="text-danger">Arquivo de Solicitação Não Enviado</p>
                    @else
                        @php
                            $caminhoArquivo = asset($detalhes->arquivo_pdf);
                        @endphp
                        <a href="{{ $caminhoArquivo }}" class="btn btn-primary" download>Baixar Arquivo</a>
                    @endif
                </div>
                </div>
            </div>
        </div>


        <div class="card p-4 mb-4">
            <div class="info mb-3">
                <strong>Atribuir a Responsávelo pelo Orçamento:</strong>
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

        <div class="buttons d-flex justify-content-between mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">Cancelar</a>
            <input type="hidden" name="codigo_solicitacao" value="{{ $detalhes->codigo_solicitacao }}">
            <button type="submit" class="btn btn-primary btn-lg">Salvar</button>
        </div>
    </form>
</div>
@endsection
