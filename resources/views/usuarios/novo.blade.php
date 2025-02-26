@extends('layouts.admin')

@section('titulo', 'Cadastrar Prestador')

@section('nome_pagina', 'NOVO PRESTADOR')

@push('styles')
    <link rel="stylesheet" href="/css/cadastros_auxiliares.css">
@endpush

@section('conteudo')

@include('auth.autenticacaoAdmin')

<div class="container-md mt-4">
    <div class="card shadow-sm p-4 bg-white rounded">
        <h2 class="text-center mb-4">Cadastro de Usuário</h2>

        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>

            <div class="mb-3">
                <label for="acesso" class="form-label">Nível de Acesso</label>
                <select class="form-select" name="acesso" id="acesso">
                    <option value="Agente">Agente</option>
                    <option value="Gerente">Gerente</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>
</div>

@endsection
