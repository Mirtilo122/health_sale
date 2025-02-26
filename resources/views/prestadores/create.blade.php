@extends('layouts.admin')

@section('titulo', 'Cadastrar Prestador')

@section('nome_pagina', 'NOVO PRESTADOR')

@push('styles')
    <link rel="stylesheet" href="/css/cadastros_auxiliares.css">
@endpush

@section('conteudo')

@include('auth.autenticacaoAdmin')

<div class="container mt-4">
    <h1>Cadastrar Prestador</h1>

    <form action="{{ route('prestadores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="usuario" class="form-label">Nome</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="{{ old('usuario') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" required>
    </div>

        <div class="mb-3">
            <label for="funcao" class="form-label">Função</label>
            <select name="funcao" id="funcao" class="form-control" required onchange="toggleCRM()">
                <option value="">Selecione</option>
                <option value="Anestesista">Anestesista</option>
                <option value="Cirurgião">Cirurgião</option>
            </select>
        </div>

        <div class="mb-3" id="crmDiv" style="display: none;">
            <label for="crm" class="form-label">CRM</label>
            <input type="text" name="crm" id="crm" class="form-control">
        </div>

        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade</label>
            <select name="especialidade" id="especialidade" class="form-control">
                <option value="">Selecione uma especialidade</option>
                @forelse ($especialidades as $especialidade)
                    <option value="{{ $especialidade->nome }}">{{ $especialidade->nome }}</option>
                @empty
                    <option value="">Nenhuma especialidade encontrada</option>
                @endforelse
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>

<script>
    function toggleCRM() {
        var funcao = document.getElementById('funcao').value;
        var crmDiv = document.getElementById('crmDiv');
        var especialidade = document.getElementById('especialidade');

        if (funcao === 'Cirurgião') {
            crmDiv.style.display = 'block';
        } else {
            crmDiv.style.display = 'none';
            document.getElementById('crm').value = '';
        }

        if (funcao === 'Anestesista') {
            especialidade.value = 'Anestesista';
        }
    }
</script>

@endsection
