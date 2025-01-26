@extends('layouts.admin')

@section('titulo', 'Convênios')

@section('nome_pagina', 'CONVÊNIOS')

@section('conteudo')

    <div class="container">
        <h1>Criar Convênio</h1>

        <form action="{{ route('convenios.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome do Convênio</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tabela_de_precos_id">Tabela de Preço</label>
                <select id="tabela_de_precos_id" name="tabela_de_precos_id" class="form-control" required>
                    @foreach($tabelasDePrecos as $tabela)
                        <option value="{{ $tabela->id }}">{{ $tabela->nome }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Salvar Convênio</button>
        </form>
    </div>
@endsection
