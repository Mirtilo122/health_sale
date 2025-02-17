@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'ORÇAMENTOS')

@push('styles')
    <link rel="stylesheet" href="/css/orcamentos.css">
@endpush

@section('conteudo')

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


<script src="/js/etapasOrcamento.js"></script>
<script>
try {

document.addEventListener("DOMContentLoaded", function () {
    const procedimentosSecundarios = @json($orcamento->procedimentos_secundarios ?? []);

    if (procedimentosSecundarios.length > 0) {
        procedimentosSecundarios.forEach(proc => adicionarSecundario(proc.cod_tuss, proc.procedimento));
    }
});

} catch (error) {
    console.warn("Elemento não encontrado, não é possível inserir procedimentos secundários");
}
</script>


@endsection
