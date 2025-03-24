@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'ORÇAMENTOS')

@push('styles')
    <link rel="stylesheet" href="/css/orcamentos.css">
@endpush

@section('conteudo')



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
    function showSuggestions(data, target) {
        let suggestions = '';
        data.forEach(function(item) {
            suggestions += `<div class="suggestion-item" data-id="${item.id}" data-value="${item.codigo}">${item.codigo} - ${item.descricao}</div>`;
        });
        $(target).html(suggestions).show();
    }

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

    $(document).on('click', '.suggestion-item', function() {
        const codigo = $(this).data('value'); // Código TUSS
        const descricao = $(this).text().split(' - ')[1]; // Descrição do procedimento
        const id = $(this).data('id'); // ID (caso precise armazenar)

        // Preenche os campos corretos
        $('#cod_tuss_principal').val(codigo).data('id', id);
        $('#procedimento_principal').val(descricao);

        // Esconde todas as sugestões
        $('.autocomplete-suggestions').hide();
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.autocomplete-suggestions').length) {
            $('.autocomplete-suggestions').hide();
        }
    });
});

</script>


@endsection
