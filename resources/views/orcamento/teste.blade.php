@extends('layouts.admin')

@section('titulo', 'Painel Administrativo')

@section('nome_pagina', 'ORÇAMENTOS')

@section('conteudo')

<style>


label {
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
input[type="email"],
select,
textarea {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    transition: all 0.3s ease-in-out;
    background-color: #f8f9fa;
    color: #333;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #007bff;
    background-color: #fff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

select {
    appearance: none;
    cursor: pointer;
    background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23666" d="M2 0L0 2h4zM2 5l2-2H0z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 10px;
}

button.alterar-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out, transform 0.1s ease-in-out;
}

button.alterar-btn:hover {
    background-color: #0056b3;
}

button.alterar-btn:active {
    transform: scale(0.95);
}

textarea {
    resize: none;
    height: 100px;
}

/* Responsividade */
@media (max-width: 768px) {
    .col-md-4 {
        width: 100%;
    }
}
</style>


<div class="container_cards mt-4">

@include('orcamento.layoutsOrcamentos.infoOrcamento')

<div class="card shadow-sm p-4">

        <form class="formulario-abas needs-validation" id="formRepresent" method="POST" action="" enctype="multipart/form-data" novalidate>
        @csrf

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="paciente-tab" data-bs-toggle="tab" data-bs-target="#paciente-tab-pane" type="button" role="tab" aria-controls="paciente-tab-pane" aria-selected="true">Paciente</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="solicitacao-tab" data-bs-toggle="tab" data-bs-target="#solicitacao-tab-pane" type="button" role="tab" aria-controls="solicitacao-tab-pane" aria-selected="false">Solicitação</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Procedimentos</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="equipe-tab" data-bs-toggle="tab" data-bs-target="#equipe-tab-pane" type="button" role="tab" aria-controls="equipe-tab-pane" aria-selected="false">Equipe</button>
            </li>


        </ul>

        <div class="tab-content" id="myTabContent">

            <!-- Paciente -->

            <div class="tab-pane fade show active align-top text-start row mt-1" id="paciente-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.infoPaciente')

            </div>

            <!-- Solicitação -->

            <div class="tab-pane fade show" id="solicitacao-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            @include('orcamento.abasOrcamentos.infoSolicitacao')

            </div>

            <!-- Procedimentos -->

            <div class="tab-pane fade show" id="procedimentos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Procedimentos</h4>



            </div>

            <!-- Equipe -->

            <div class="tab-pane fade show" id="equipe-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Equipe</h4>



            </div>



        </div>

        </form>
    </div>
</div>


<script>

function toggleComorbidades() {
    const comorbidades = document.getElementById("comorbidadesPaciente").value;
    const descricaoComorbidade = document.getElementById("comorbidade");

    if (comorbidades === "sim") {
        descricaoComorbidade.classList.remove("d-none");
    } else {
        descricaoComorbidade.classList.add("d-none");
    }
}

function toggleCirurgiao() {
    const cirurgiaoDefinido = document.getElementById("cirurgiaoDefinido").value;
    const cirurgiaoInfo = document.getElementById("cirurgiaoInfo");

    if (cirurgiaoDefinido === "sim") {
        cirurgiaoInfo.classList.remove("d-none");
    } else {
        cirurgiaoInfo.classList.add("d-none");
    }
}

function alterar(lista) {

    const selectField = document.getElementById(lista);
    selectField.disabled = !selectField.disabled;
    if (!selectField.disabled) {
        selectField.focus();
    }
}

</script>

@endsection
