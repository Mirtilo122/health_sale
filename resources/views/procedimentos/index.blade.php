@extends('layouts.admin')

@section('titulo', 'Procedimentos')

@section('nome_pagina', 'PROCEDIMENTOS')

@section('conteudo')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container" style="display: flex;flex-direction:column; gap:15px;">
    <h1>Gerenciamento de Procedimentos</h1>

    <a href="{{ route('procedimentos.criar') }}" class="btn btn-success" style="max-width: 200px;">Cadastrar Procedimento</a>

    <table class="table table-hover">
        <thead class="table-secondary">
            <tr>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('procedimentos.index', ['sort' => 'id', 'order' => $orderDirection]) }}">ID</a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('procedimentos.index', ['sort' => 'nome_procedimento', 'order' => $orderDirection]) }}">Nome</a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('procedimentos.index', ['sort' => 'tipo', 'order' => $orderDirection]) }}">Tipo</a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('procedimentos.index', ['sort' => 'ativo', 'order' => $orderDirection]) }}">Ativo</a>
                </th>
                <th scope="col" class="align-middle text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($procedimentos->count() > 0)
                @foreach ($procedimentos as $procedimento)
                    <tr>
                        <td scope="row" class="align-middle text-center">{{ $procedimento->id }}</td>
                        <td scope="row" class="align-middle text-center">{{ $procedimento->nome_procedimento }}</td>
                        <td scope="row" class="align-middle text-center">
                                @php
                                    $tipoProcedimento = ucfirst(strtolower($procedimento->tipo));
                                @endphp
                                @if($tipoProcedimento == 'anestesia')
                                    Anestesia
                                @elseif($tipoProcedimento == 'diaria')
                                    Diária
                                @elseif($tipoProcedimento == 'cirurgia')
                                    Procedimento Cirúrgico
                                @elseif($tipoProcedimento == 'outro')
                                    Outro
                                @else
                                    {{ $tipoProcedimento }}
                                @endif
                        </td>
                        <td scope="row" class="align-middle text-center">
                                @php
                                    $ativo = ucfirst(strtolower($procedimento->ativo));
                                @endphp
                                @if($ativo == 0)
                                    Não
                                @elseif($ativo == 1)
                                    Sim
                                @else
                                    {{ $ativo }}
                                @endif
                        </td>
                        <td scope="row" class="align-middle text-center">
                            <a href="{{ route('procedimentos.editar', $procedimento->id) }}" class="btn btn-primary">Editar</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Nenhum usuário encontrado.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection
