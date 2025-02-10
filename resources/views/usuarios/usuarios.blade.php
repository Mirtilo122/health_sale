@extends('layouts.admin')

@section('titulo', 'Usuários')

@section('nome_pagina', 'USUÁRIOS')

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

<div class="container" style="display: flex;flex-direction:column; gap:15px;">
    <h1>Gerenciamento de Usuários</h1>

    <a href="{{ route('usuarios.registrar') }}" class="btn btn-success" style="max-width: 200px;">Cadastrar Novo Usuário</a>

    <table class="table table-hover">
        <thead class="table-secondary">
            <tr>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('usuarios.usuarios', ['sort' => 'id', 'order' => $orderDirection]) }}">ID</a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('usuarios.usuarios', ['sort' => 'usuario', 'order' => $orderDirection]) }}">Nome</a>
                </th>
                <th scope="col" class="align-middle text-center">E-mail</th>
                <th scope="col" class="align-middle text-center">
                    <a href="{{ route('usuarios.usuarios', ['sort' => 'acesso', 'order' => $orderDirection]) }}">Nível de Acesso</a>
                </th>
                <th scope="col" class="align-middle text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($usuarios->count() > 0)
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td scope="row" class="align-middle text-center">{{ $usuario->id }}</td>
                        <td scope="row" class="align-middle text-center">{{ $usuario->usuario }}</td>
                        <td scope="row" class="align-middle text-center">{{ $usuario->email }}</td>
                        <td scope="row" class="align-middle text-center">{{ $usuario->acesso }}</td>
                        <td scope="row" class="align-middle text-center">
                            <a href="{{ route('usuarios.editar', $usuario->id) }}" class="btn btn-primary">Editar</a>
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
