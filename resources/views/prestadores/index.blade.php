@extends('layouts.admin')

@section('titulo', 'Prestadores de Serviço')

@section('nome_pagina', 'PRESTADORES')

@section('conteudo')

@include('auth.autenticacaoAdmin')

<div class="container my-4">
    <h1 class="text-center mb-4">Gerenciamento de Prestadores</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('prestadores.create') }}" class="btn btn-success">Cadastrar Novo Prestador</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-secondary">
                <tr>
                    <th scope="col" class="text-center">Nome</th>
                    <th scope="col" class="text-center">Função</th>
                    <th scope="col" class="text-center">E-mail</th>
                    <th scope="col" class="text-center">Especialidade</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if ($prestadores->count() > 0)
                    @foreach ($prestadores as $prestador)
                        <tr>
                            <td class="text-center">{{ $prestador->nome }}</td>
                            <td class="text-center">{{ $prestador->funcao }}</td>
                            <td class="text-center">{{ $prestador->usuario->email }}</td>
                            <td class="text-center">{{ $prestador->especialidade ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('prestadores.edit', $prestador->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('prestadores.destroy', $prestador->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este prestador?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Nenhum prestador encontrado.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
