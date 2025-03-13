@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'ORÇAMENTOS')

@push('styles')
    <link rel="stylesheet" href="/css/orcamentos.css">
@endpush

@section('conteudo')

@include('auth.auth_orcamento')


@if(session('mensagem'))
    <div class="alert alert-primary" role="alert">
        {{ session('mensagem') }}
    </div>
@endif

@php
session(['codigo_solicitacao' => $solicitacao->codigo_solicitacao]);
@endphp

<div class="container_cards mt-2 mb-2">

<form class="formulario-abas needs-validation" id="orcamento-form" method="POST" action="@yield('action')" enctype="multipart/form-data" novalidate>
@csrf

@include('orcamento.layoutsOrcamentos.infoOrcamento')

@yield('resumo')

    <div class="card shadow-sm p-0 card_info mt-2">




            <ul class="nav nav-tabs" id="myTab" role="tablist">

            @yield('abas')

            </ul>

            <div class="tab-content m-0 p-0" id="myTabContent">

            @yield('conteudoAbas')

            </div>

    </div>



</form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/etapasOrcamento.js"></script>
<script src="/js/tuss-search.js"></script>
<script>
try {

    if (!Array.isArray(procedimentosSecundarios)) {
    procedimentosSecundarios = [];
    }

    document.addEventListener("DOMContentLoaded", function () {
    const procedimentosSecundarios = @json($orcamento->procedimentos_secundarios ?? []);

    if (procedimentosSecundarios.length > 0) {
        procedimentosSecundarios.forEach(proc => adicionarSecundario(proc.cod_tuss, proc.procedimento));
    }
});

} catch (error) {
    
}







$(document).ready(function() {
    // Função para exibir as sugestões no formato "código - descrição"
    function showSuggestions(data, target) {
        let suggestions = '';
        data.forEach(function(item) {
            suggestions += `<div class="suggestion-item" data-id="${item.id}" data-value="${item.codigo}">${item.codigo} - ${item.descricao}</div>`;
        });
        $(target).html(suggestions).show();
    }

    // Buscar código TUSS
    $('#cod_tuss_principal').on('input', function() {
        const query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: "{{ route('search.tuss.codigo') }}",
                method: 'GET',
                data: { query: query },
                success: function(response) {
                    showSuggestions(response, '#cod_tuss_suggestions');
                }
            });
        } else {
            $('#cod_tuss_suggestions').hide();
        }
    });

    // Buscar descrição do procedimento
    $('#procedimento_principal').on('input', function() {
        const query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: "{{ route('search.tuss.descricao') }}",
                method: 'GET',
                data: { query: query },
                success: function(response) {
                    showSuggestions(response, '#procedimento_suggestions');
                }
            });
        } else {
            $('#procedimento_suggestions').hide();
        }
    });

    // Selecionar sugestão
    $(document).on('click', '.suggestion-item', function() {
        const value = $(this).data('value'); // Aqui pega o código
        const id = $(this).data('id');

        // Atualiza o valor do input com o código
        $(this).closest('div').find('input').val(value);

        // Esconder sugestões
        $(this).closest('div').find('.autocomplete-suggestions').hide();

        // Caso precise do ID para salvar em algum lugar
        $('#cod_tuss_principal').data('id', id); // Exemplo para o código TUSS
    });

    // Esconder sugestões quando clicar fora
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.autocomplete-suggestions').length) {
            $('.autocomplete-suggestions').hide();
        }
    });
});

</script>


@endsection
