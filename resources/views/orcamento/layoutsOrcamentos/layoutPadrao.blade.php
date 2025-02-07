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
    margin-top: 20px;
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

p{
    margin-top: 20px;
}

@media (max-width: 768px) {
    .col-md-4 {
        width: 100%;
    }
}


</style>

@php
session(['codigo_solicitacao' => $solicitacao->codigo_solicitacao]);
@endphp

<div class="container_cards mt-4">

@include('orcamento.layoutsOrcamentos.infoOrcamento')
<form class="formulario-abas needs-validation" id="formRepresent" method="POST" action="@yield('action')" enctype="multipart/form-data" novalidate>

    <div class="card shadow-sm p-4 card_info">


        @csrf

            <ul class="nav nav-tabs" id="myTab" role="tablist">

            @yield('abas')

            </ul>

            <div class="tab-content" id="myTabContent">

            @yield('conteudoAbas')

            </div>

    </div>

    @include('orcamento.layoutsOrcamentos.resumoOrcamento')

</form>
</div>

<script>

function atualizarHidden(info) {
    document.getElementById(info + "Hidden").value = document.getElementById(info).value;
}


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
    const cirurgiaoDefinido = document.getElementById("cirurgiao").value;
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

document.getElementById("add-agente").addEventListener("click", function() {
    let select = document.getElementById("agente-selecao");
    let selectedOption = select.options[select.selectedIndex];
    if (!selectedOption.value) return;

    let agenteId = selectedOption.value;
    let agenteNome = selectedOption.text;

    if (document.getElementById("agente-" + agenteId)) return;

    let li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.id = "agente-" + agenteId;

    let span = document.createElement("span");
    span.textContent = agenteNome;
    span.style.color = "gray";

    let switchContainer = document.createElement("div");
    switchContainer.className = "form-check form-switch d-flex align-items-center";

    let input = document.createElement("input");
    input.className = "form-check-input";
    input.type = "checkbox";
    input.checked = false;
    input.name = "agentes[" + agenteId + "]";
    input.dataset.agenteId = agenteId;

    let label = document.createElement("label");
    label.textContent = "Visualizar";
    label.className = "ms-2";


    input.addEventListener("change", function() {
        label.textContent = this.checked ? "Editar" : "Visualizar";
    });

    let removeBtn = document.createElement("button");
    removeBtn.className = "btn btn-danger btn-sm ms-2";
    removeBtn.textContent = "Remover";
    removeBtn.addEventListener("click", function() {
        li.remove();
        selectedOption.disabled = false;
        selectedOption.style.color = "black";
    });

    switchContainer.appendChild(input);
    switchContainer.appendChild(label);
    li.appendChild(span);
    li.appendChild(switchContainer);
    li.appendChild(removeBtn);

    document.getElementById("lista-agentes").appendChild(li);

    selectedOption.style.color = "gray";
    selectedOption.disabled = true;
});

// aaaaaaaaaa

let hiddenInput = document.createElement("input");
hiddenInput.type = "hidden";
hiddenInput.name = "agentes[" + agenteId + "]";
hiddenInput.value = input.checked ? "editar" : "visualizar";
hiddenInput.classList.add("agente-hidden-" + agenteId);

input.addEventListener("change", function() {
    hiddenInput.value = this.checked ? "editar" : "visualizar";
});

li.appendChild(hiddenInput);


removeBtn.addEventListener("click", function() {
    li.remove();
    selectedOption.disabled = false;
    selectedOption.style.color = "black";


    let hiddenInput = document.querySelector(".agente-hidden-" + agenteId);
    if (hiddenInput) {
        hiddenInput.remove();
    }
});

// aaaaaaaaaaaaa






document.addEventListener("DOMContentLoaded", function () {
    const listaProcedimentos = document.getElementById("lista-procedimentos");
    const precosProcedimentosInput = document.getElementById("precosProcedimentosInput");

    // Recupera os procedimentos do input hidden e converte para array, garantindo que seja um JSON válido
    let precosProcedimentos = [];
    try {
        precosProcedimentos = JSON.parse(precosProcedimentosInput.value) || [];
    } catch (e) {
        console.error("Erro ao analisar JSON dos procedimentos:", e);
    }

    function atualizarLista() {
        listaProcedimentos.innerHTML = ""; // Limpa a lista antes de recriá-la

        precosProcedimentos.forEach((procedimento, index) => {
            const listItem = document.createElement("li");
            listItem.className = "list-group-item d-flex justify-content-between align-items-center";
            listItem.innerHTML = `
                <span><strong>${procedimento.nome}</strong> - R$ ${parseFloat(procedimento.valor).toFixed(2)} - TUSS: ${procedimento.tuss}</span>
                <button class="btn btn-danger btn-sm remover-procedimento" data-index="${index}">Remover</button>
            `;
            listaProcedimentos.appendChild(listItem);
        });

        // Atualiza o input hidden com os dados
        precosProcedimentosInput.value = JSON.stringify(precosProcedimentos);
    }

    atualizarLista(); // Carrega a lista ao iniciar a página

    // Adiciona novo procedimento ao clicar no botão "Prosseguir"
    document.getElementById("salvarProcedimento").addEventListener("click", function () {
        const nome = document.getElementById("procedimentoNome").value.trim();
        const valor = document.getElementById("procedimentoValor").value.trim();
        const tuss = document.getElementById("procedimentoTuss").value.trim();

        if (nome && valor && tuss) {
            precosProcedimentos.push({ nome, valor, tuss });
            atualizarLista();

            // Limpa os campos do modal
            document.getElementById("procedimentoNome").value = "";
            document.getElementById("procedimentoValor").value = "";
            document.getElementById("procedimentoTuss").value = "";

            // Fecha o modal usando Bootstrap 5 corretamente
            const modal = bootstrap.Modal.getInstance(document.getElementById("procedimentoModal"));
            if (modal) modal.hide();
        } else {
            alert("Preencha todos os campos!");
        }
    });

    // Remove um procedimento da lista ao clicar no botão "Remover"
    listaProcedimentos.addEventListener("click", function (event) {
        if (event.target.classList.contains("remover-procedimento")) {
            const index = event.target.getAttribute("data-index");
            precosProcedimentos.splice(index, 1);
            atualizarLista();
        }
    });
});






</script>





@endsection
