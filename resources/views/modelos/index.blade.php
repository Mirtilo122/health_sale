@extends('layouts.admin')

@section('titulo', 'Modelos de Condições')

@section('nome_pagina', 'MODELOS')

@section('conteudo')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@php
    $idUsuario = auth()->id();
    $usuario = auth()->user();
    $nivelAcesso = $usuario->acesso;
@endphp

@if ($nivelAcesso !== "Administrador")
    <div class="text-center">
        <img src="{{ asset('images/nao-autorizado.png') }}" alt="Acesso Negado" style="max-width: 300px;">
        <p class="text-danger">Você não tem permissão para acessar esta página.</p>
    </div>
    @php exit; @endphp
@endif

<div class="container" style="display: flex; flex-direction:column; gap:15px;">
    <h1>Gerenciamento de Modelos</h1>

    <a href="{{ route('modelos.create') }}" class="btn btn-success" style="max-width: 200px;">Cadastrar Novo Modelo</a>

    <table class="table table-hover">
        <thead class="table-secondary">
            <tr>
                <th scope="col" class="align-middle text-center">ID</th>
                <th scope="col" class="align-middle text-center">Nome do Modelo</th>
                <th scope="col" class="align-middle text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($modelos->count() > 0)
                @foreach ($modelos as $modelo)
                    <tr>
                        <td class="align-middle text-center">{{ $modelo->id }}</td>
                        <td class="align-middle text-center">{{ $modelo->nome }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('modelos.edit', $modelo->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('modelos.destroy', $modelo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este modelo?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Nenhum modelo encontrado.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>



@endsection
