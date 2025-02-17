@extends('layouts.admin')

@section('titulo', 'Cadastrar Prestador')

@section('nome_pagina', 'NOVO PRESTADOR')

@push('styles')
    <link rel="stylesheet" href="/css/cadastros_auxiliares.css">
@endpush

@section('conteudo')

<div class="container mt-2">
    <h1>Cadastrar Novo Modelo</h1>

    <form action="{{ route('modelos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6 flex-fill mb-3">
                <label for="nome" class="form-label">Nome do Modelo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="col-6 flex-fill mb-3 form-check form-switch d-flex align-items-center justify-content-center">
                <input class="form-check-input" type="checkbox" name="ativo" id="checkbox">
                <label class="ms-4 mt-1" id="label">Desativo</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Modelo</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo do Modelo</label>
            <textarea id="editor" name="conteudo"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    CKEDITOR.replace('editor', {
        height: 300,
        toolbar: [
            { name: 'clipboard', items: ['Undo', 'Redo'] },
            { name: 'styles', items: ['Format'] },
            { name: 'basicstyles', items: ['Bold', 'Italic'] },
            { name: 'paragraph', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'list', items: ['Outdent', 'Indent', 'BulletedList', 'NumberedList'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'tools', items: ['Preview'] }
        ]
    });

    const checkbox = document.getElementById("checkbox");
    const label = document.getElementById("label");

    label.textContent = checkbox.checked ? "Ativo" : "Desativo";

    checkbox.addEventListener("change", function () {
        label.textContent = this.checked ? "Ativo" : "Desativo";
    });
</script>

@endsection
