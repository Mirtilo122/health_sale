@extends('layouts.admin')

@section('titulo', 'Modelos de Condições')

@section('nome_pagina', 'MODELOS')

@section('conteudo')

<div class="container">
    <h1>Editar Modelo</h1>

    <form action="{{ route('modelos.update', $modelo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-6 flex-fill mb-3">
                <label for="nome" class="form-label">Nome do Modelo</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $modelo->nome) }}" required>
            </div>

            <div class="col-6 flex-fill mb-3 form-check form-switch d-flex align-items-center justify-content-center">
                <input class="form-check-input" type="checkbox" name="ativo" id="checkbox"{{ $modelo->ativo == 1 ? 'checked' : '' }}>
                <label class="ms-4 mt-1" id="label">Desativo</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Modelo</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao', $modelo->descricao) }}" required>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label">Conteúdo do Modelo</label>
            <textarea id="editor" name="conteudo">{{ old('conteudo', $modelo->conteudo) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
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
