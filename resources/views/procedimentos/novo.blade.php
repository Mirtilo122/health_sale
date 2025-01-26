@extends('layouts.admin')

@section('titulo', 'Procedimentos')

@section('nome_pagina', 'PROCEDIMENTOS')

@section('conteudo')

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container-md mt-5" style="width:40%">
        <div class="card shadow-sm p-4 bg-white rounded">
            <h2 class="text-center mb-4">Cadastro de Procedimento</h2>

            <form method="POST" action="{{ route('procedimentos.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Procedimento</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select class="form-select" name="tipo" id="tipo">
                        <option value="anestesia">Anestesia</option>
                        <option value="diaria">Diária</option>
                        <option value="cirurgia">Procedimento Cirúrgico</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ativo" class="form-label">Ativo</label>
                    <select class="form-select" name="ativo" id="ativo">
                        <option value=1>Sim</option>
                        <option value=0>Não</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </form>
        </div>
    </div>

@endsection
