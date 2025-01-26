@extends('layouts.admin')

@section('titulo', 'Procedimentos')

@section('nome_pagina', 'PROCEDIMENTOS')

@section('conteudo')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container-md mt-5" style="width:40%">
    <div class="card shadow-sm p-4 bg-white rounded">

        <h2 class="text-center mb-4">Editar Procedimento</h2>

        <form method="POST" action="{{ route('procedimentos.update', $procedimento->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $procedimento->nome_procedimento }}" required>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Procedimento</label>
                <select class="form-select" name="tipo" id="tipo">
                    <option value="anestesia" {{ $procedimento->tipo == 'anestesia' ? 'selected' : '' }}>Anestesia</option>
                    <option value="diaria" {{ $procedimento->tipo == 'diaria' ? 'selected' : '' }}>Diária</option>
                    <option value="cirurgia" {{ $procedimento->tipo == 'cirurgia' ? 'selected' : '' }}>Procedimento Cirúrgico</option>
                    <option value="outro" {{ $procedimento->tipo == 'outro' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="ativo" class="form-label">Ativo</label>
                <select class="form-select" name="ativo" id="ativo">
                    <option value=1 {{ $procedimento->ativo == '1' ? 'selected' : '' }}>Sim</option>
                    <option value=0 {{ $procedimento->ativo == '0' ? 'selected' : '' }}>Não</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>

        <!-- Botão de Deletar -->
        <form method="POST" action="{{ route('procedimentos.destroy', $procedimento->id) }}" id="delete-form">
        @csrf
        @method('DELETE')
            <button type="button" class="btn btn-danger w-100 mt-3" onclick="confirmDelete()">Deletar Procedimento</button>
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Tem certeza de que deseja excluir este procedimento?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>



@endsection
