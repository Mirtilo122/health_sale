@extends('layouts.admin')

@section('titulo', 'Atualizar Tabela Tuss')

@section('nome_pagina', 'TABELA TUSS')

@section('conteudo')

<div class="container">
    <h2>Importar Tabela TUSS</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('importar.tuss.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="csv_file" class="form-label">Selecione o arquivo CSV</label>
            <input type="file" name="csv_file" id="csv_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>
</div>
@endsection
