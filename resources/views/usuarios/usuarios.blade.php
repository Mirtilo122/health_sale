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

<div class="container my-4">
    <h1 class="text-center mb-4">Gerenciamento de Usuários</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('usuarios.registrar') }}" class="btn btn-success">Cadastrar Novo Usuário</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-secondary">
                <tr>
                    <th scope="col" class="text-center">
                        <a href="{{ route('usuarios.usuarios', ['sort' => 'id', 'order' => $orderDirection]) }}" class="text-decoration-none text-dark">ID</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a href="{{ route('usuarios.usuarios', ['sort' => 'usuario', 'order' => $orderDirection]) }}" class="text-decoration-none text-dark">Nome</a>
                    </th>
                    <th scope="col" class="text-center">E-mail</th>
                    <th scope="col" class="text-center">
                        <a href="{{ route('usuarios.usuarios', ['sort' => 'acesso', 'order' => $orderDirection]) }}" class="text-decoration-none text-dark">Nível de Acesso</a>
                    </th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if ($usuarios->count() > 0)
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="text-center">{{ $usuario->id }}</td>
                            <td class="text-center">{{ $usuario->usuario }}</td>
                            <td class="text-center">{{ $usuario->email }}</td>
                            <td class="text-center">{{ $usuario->acesso }}</td>
                            <td class="text-center">
                                <a href="{{ route('usuarios.editar', $usuario->id) }}" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
