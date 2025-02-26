@extends('layouts.admin')

@section('titulo', 'Modelos de Condições')

@section('nome_pagina', 'MODELOS')

@section('conteudo')

@include('auth.autenticacaoGerente')

<div class="container my-4">
    <h1 class="text-center mb-4">Gerenciamento de Modelos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('modelos.create') }}" class="btn btn-success">Cadastrar Novo Modelo</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-secondary">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nome do Modelo</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if ($modelos->count() > 0)
                    @foreach ($modelos as $modelo)
                        <tr>
                            <td class="text-center">{{ $modelo->id }}</td>
                            <td class="text-center">{{ $modelo->nome }}</td>
                            <td class="text-center">
                                <a href="{{ route('modelos.edit', $modelo->id) }}" class="btn btn-warning">Editar</a>
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
                        <td colspan="3" class="text-center">Nenhum modelo encontrado.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
