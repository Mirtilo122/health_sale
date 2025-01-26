@extends('layouts.admin')

@section('titulo', 'Usuários')

@section('nome_pagina', 'USUÁRIOS')

@section('conteudo')
 
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container-md mt-5" style="width:40%">
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
                        <option value="Externo">Externo</option>
                        <option value="Agente">Agente</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="funcao" class="form-label">Possui Função Específica?</label>
                    <select class="form-select" name="funcao" id="funcao">
                        <option value="Nenhum">Nenhum</option>
                        <option value="Anestesista">Anestesista</option>
                        <option value="Cirurgião">Cirurgião</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </form>
        </div>
    </div>

@endsection
