@extends('layouts.admin')

@section('titulo', 'Editar Prestador')

@section('nome_pagina', 'EDITAR PRESTADOR')

@section('conteudo')
<div class="container">
    <h1 class="mb-4">Editar Prestador</h1>

    <form action="{{ route('prestadores.update', $prestador->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $prestador->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha (deixe em branco para não alterar)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="funcao" class="form-label">Função</label>
            <select name="funcao" id="funcao" class="form-select" required onchange="toggleCRM()">
                <option value="Anestesista" {{ $prestador->funcao == 'Anestesista' ? 'selected' : '' }}>Anestesista</option>
                <option value="Cirurgião" {{ $prestador->funcao == 'Cirurgião' ? 'selected' : '' }}>Cirurgião</option>
            </select>
        </div>

        <div class="mb-3" id="crmDiv" style="{{ $prestador->funcao == 'Cirurgião' ? 'display: block;' : 'display: none;' }}">
            <label for="crm" class="form-label">CRM</label>
            <input type="text" name="crm" id="crm" class="form-control" value="{{ $prestador->crm }}">
        </div>

        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade</label>
            <input type="text" name="especialidade" id="especialidade" class="form-control" value="{{ $prestador->especialidade }}">
        </div>

        <button type="submit" class="btn btn-primary w-100">Atualizar</button>
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
