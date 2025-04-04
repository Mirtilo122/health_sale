@extends('layouts.admin')

@section('titulo', 'Usuários')

@section('nome_pagina', 'USUÁRIOS')

@section('conteudo')


@include('auth.autenticacaoAdmin')

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
                @if (!empty($usuario_externo) && $usuario_externo->count() > 0)
                    @foreach ($usuario_externo as $usuario)
                        <tr>
                            <td class="text-center">{{ $usuario->id }}</td>
                            <td class="text-center">{{ $usuario->usuario }}</td>
                            <td class="text-center">{{ $usuario->email }}</td>
                            <td class="text-center">{{ $usuario->acesso }}</td>
                            <td class="text-center">
                                <a href="{{ route('prestadores.index') }}" class="btn btn-secondary">Ver Prestadores</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <button id="btn-ver-inativos" class="btn btn-danger">Ver Inativos</button>
    </div>

    <div class="table-responsive d-none" id="tabela-inativos">
        <h3 class="text-center mb-3">Usuários Inativos</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-secondary">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nome</th>
                    <th scope="col" class="text-center">E-mail</th>
                    <th scope="col" class="text-center">Nível de Acesso</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if ($inativos->count() > 0)
                    @foreach ($inativos as $usuario)
                        <tr>
                            <td class="text-center">{{ $usuario->id }}</td>
                            <td class="text-center">{{ $usuario->usuario }}</td>
                            <td class="text-center">{{ $usuario->email }}</td>
                            <td class="text-center">{{ $usuario->acesso }}</td>
                            <td class="text-center">
                                <a href="" class="btn btn-info">Visualizar</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Nenhum usuário inativo encontrado.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


<script>
    document.getElementById('btn-ver-inativos').addEventListener('click', function() {
        document.getElementById('tabela-inativos').classList.toggle('d-none');
    });
</script>

@endsection
