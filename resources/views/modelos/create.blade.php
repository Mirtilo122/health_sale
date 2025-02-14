@extends('layouts.admin')

@section('titulo', 'Modelos de Condições')

@section('nome_pagina', 'MODELOS')

@section('conteudo')

<style>

.form-check-input {
    transform: scale(1.5);
}

label{
font-size: 15px;
}

</style>

<div class="container">
    <h1>Cadastrar Novo Modelo</h1>

    <form action="{{ route('modelos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6 flex-fill mb-3">
                <label for="nome" class="form-label" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">Nome do Modelo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="col-6 flex-fill mb-3 form-check form-switch d-flex align-items-center justify-content-center">
                <input class="form-check-input" type="checkbox" name="ativo" id="checkbox">
                <label class="ms-4 mt-1" id="label">Desativo</label>
            </div>
        </div>


        <div class="mb-3">
            <label for="descricao" class="form-label" value="<?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ''; ?>">Descrição do Modelo</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>

        <div class="mb-3">
            <label for="conteudo" class="form-label" value="<?php echo isset($_POST['conteudo']) ? htmlspecialchars($_POST['conteudo']) : ''; ?>">Conteúdo do Modelo</label>
            <textarea id="editor" name="conteudo"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/z60j7ybmsne92rqccjp9unybou8qqjil0ot4mdkamd36zfyz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'advlist autolink lists link charmap preview anchor',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist',
        height: 300
    });


    const checkbox = document.getElementById("checkbox");
    const label = document.getElementById("label");

    label.textContent = checkbox.checked ? "Ativo" : "Desativo";

    checkbox.addEventListener("change", function () {
        label.textContent = this.checked ? "Ativo" : "Desativo";
    });
</script>

@endsection
