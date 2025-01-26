@extends('layouts.admin')

@section('titulo', 'Convênios')

@section('nome_pagina', 'CONVÊNIOS')

@section('conteudo')

    <div class="container">
        <h1>Convênios</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('convenios.create') }}" class="btn btn-primary mb-3">Criar Novo Convênio</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tabela de Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($convenios as $convenio)
                    <tr>
                        <td>{{ $convenio->nome }}</td>
                        <td>{{ $convenio->tabelaDePrecos->nome }}</td>
                        <td>
                            <a href="{{ route('convenios.edit', $convenio->id) }}" class="btn btn-warning">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
