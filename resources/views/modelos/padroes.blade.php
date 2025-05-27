@extends('layouts.admin')

@section('titulo', 'Definir Modelos Padrão')

@section('nome_pagina', 'MODELOS PADRÃO')

@section('conteudo')

<div class="container my-4">
    <h1 class="text-center mb-4">Definir Padrões de Modelo</h1>

    <form action="{{ route('modelos.salvar_padrao') }}" method="POST">
        @csrf

        @php
            $tipos = [
                'condicoes_gerais' => 'Condições Gerais',
                'pagamento_hospital' => 'Condições de Pagamento do Hospital',
                'pagamento_cirurgiao' => 'Condições de Pagamento Cirurgião',
                'pagamento_anestesista' => 'Condições de Pagamento Anestesista',
            ];
        @endphp

        @foreach($tipos as $tipoKey => $tipoLabel)
            <div class="mb-3">
                <label for="{{ $tipoKey }}" class="form-label">{{ $tipoLabel }}</label>
                <select class="form-select" name="{{ $tipoKey }}" id="{{ $tipoKey }}">
                    <option value="">Nenhum</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->id }}"
                            @if(optional($modeloPadroes->get($tipoKey))->modelo_id == $modelo->id) selected @endif>
                            {{ $modelo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <div class="alert alert-info">
            Caso não deseje um padrão para auto-preenchimento, mantenha a opção <strong>"Nenhum"</strong> selecionada.
        </div>

        <button type="submit" class="btn btn-primary">Salvar Padrões</button>
    </form>
</div>

@endsection
