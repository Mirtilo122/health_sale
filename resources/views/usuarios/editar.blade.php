@extends('layouts.admin')

@section('titulo', 'Usuários')

@section('nome_pagina', 'USUÁRIOS')

@section('conteudo')

@include('auth.autenticacaoAdmin')

<div class="container-md mt-5" style="max-width: 600px;">
    <div class="card shadow-sm p-4 bg-white rounded">

        <h2 class="text-center mb-4">Editar Usuário</h2>

        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
            @csrf

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="{{ $usuario->usuario }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Alterar Senha (Deixe em branco para não alterar)</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>

            <div class="mb-3">
                <label for="acesso" class="form-label">Nível de Acesso</label>
                <select class="form-select" name="acesso" id="acesso">
                    <option value="Agente" {{ $usuario->acesso == 'Agente' ? 'selected' : '' }}>Agente</option>
                    <option value="Gerente" {{ $usuario->acesso == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                    <option value="Administrador" {{ $usuario->acesso == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>

        <!-- Botão de Deletar -->
        <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}" id="delete-form" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger w-100 mt-3" onclick="confirmDelete()">Inativar Usuário</button>
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Tem certeza de que deseja excluir este usuário?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection
