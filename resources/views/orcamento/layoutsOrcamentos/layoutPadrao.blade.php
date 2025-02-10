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

.list-group-item{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.agente-nome{
    flex: 1;
}

.agente-switch{
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.agente-actions{
    flex: 1;
    display: flex;
    justify-content: flex-end;
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
<form class="formulario-abas needs-validation" id="orcamento-form" method="POST" action="@yield('action')" enctype="multipart/form-data" novalidate>

@yield('resumo')
    <div class="card shadow-sm p-4 card_info">


        @csrf

            <ul class="nav nav-tabs" id="myTab" role="tablist">

            @yield('abas')

            </ul>

            <div class="tab-content" id="myTabContent">

            @yield('conteudoAbas')

            </div>

    </div>



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



try {

const agentesEditar = JSON.parse(document.getElementById('agentesEditarDesignadosLoad').value || '[]');
const agentesVisualizar = JSON.parse(document.getElementById('agentesVisualizarDesignadosLoad').value || '[]');

const agentesCombinados = [...new Set([...agentesEditar, ...agentesVisualizar])];

contarIdsAgentes()

} catch (error) {
    console.warn("Elemento não encontrado, ignorando erro.");
}


try {
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

    let nomeDiv = document.createElement("div");
    nomeDiv.className = "agente-nome";
    nomeDiv.style.color = "gray";
    nomeDiv.textContent = agenteNome;

    let switchContainerDiv = document.createElement("div");
    switchContainerDiv.className = "agente-switch";

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

    switchContainer.appendChild(input);
    switchContainer.appendChild(label);
    switchContainerDiv.appendChild(switchContainer);

    let actionsDiv = document.createElement("div");
    actionsDiv.className = "agente-actions";

    let removeBtn = document.createElement("button");
    removeBtn.className = "btn btn-danger btn-sm ms-2 remove-agente";
    removeBtn.textContent = "Remover";
    removeBtn.addEventListener("click", function() {
    removerAgente(agenteId);
});

    actionsDiv.appendChild(removeBtn);

    li.appendChild(nomeDiv);
    li.appendChild(switchContainerDiv);
    li.appendChild(actionsDiv);

    document.getElementById("lista-agentes").appendChild(li);

    selectedOption.style.color = "gray";
    selectedOption.disabled = true;

    contarIdsAgentes()
});

} catch (error) {
    console.warn("Elemento não encontrado, não é possível adicionar agentes.");
}


function removerAgente(agenteId) {
    let agenteElement = document.getElementById("agente-" + agenteId);

    if (agenteElement) {
        agenteElement.remove();

        let select = document.getElementById("agente-selecao");
        let selectedOption = [...select.options].find(option => option.value == agenteId);

        if (selectedOption) {
            selectedOption.disabled = false;
            selectedOption.style.color = "black";
        }
        contarIdsAgentes()
    }



}

function contarIdsAgentes() {
    let lista = document.getElementById("lista-agentes");
    let itens = lista.getElementsByTagName("li");
    let ids = [];

    for (let item of itens) {
        let id = item.id.replace("agente-", "");
        ids.push(parseInt(id, 10));
    }

    ids.shift();

    document.getElementById("agentesEnviadosInput").value = JSON.stringify(ids);
}








try {
document.getElementById("salvarProcedimento").addEventListener("click", function () {
    const nome = document.getElementById("procedimentoNome").value;
    const valor = document.getElementById("procedimentoValor").value;
    const tuss = document.getElementById("procedimentoTuss").value;

    if (nome.trim() === "" || valor.trim() === "") {
        alert("O nome e o valor do procedimento não podem estar vazios!");
        return;
    }

    adicionarProcedimento(nome, valor, tuss);


    document.getElementById("procedimentoNome").value = "";
    document.getElementById("procedimentoValor").value = "";
    document.getElementById("procedimentoTuss").value = "";


    bootstrap.Modal.getInstance(document.getElementById("procedimentoModal")).hide();
});
} catch (error) {
    console.warn("Elemento não encontrado, não é possível adicionar procedimentos.");
}


try {
document.getElementById("salvarProcedimentoAnestesista").addEventListener("click", function () {
    const nome = document.getElementById("procedimentoNomeAnestesista").value;
    const valor = document.getElementById("procedimentoValorAnestesista").value;
    const tuss = document.getElementById("procedimentoTussAnestesista").value;

    if (nome.trim() === "" || valor.trim() === "") {
        alert("O nome e o valor do procedimento não podem estar vazios!");
        return;
    }


    adicionarProcedimentoAnestesista(nome, valor, tuss);


    document.getElementById("procedimentoNomeAnestesista").value = "";
    document.getElementById("procedimentoValorAnestesista").value = "";
    document.getElementById("procedimentoTussAnestesista").value = "";


    bootstrap.Modal.getInstance(document.getElementById("procedimentoModalAnestesista")).hide();
});
} catch (error) {
    console.warn("Elemento não encontrado, não é possível adicionar procedimentos.");
}



function adicionarProcedimento(nome, valor, tuss) {

    const tabela = document.getElementById("tabela-procedimentos");

    const tr = document.createElement("tr");

    const tdNome = document.createElement("td");
    const inputNome = document.createElement("input");
    inputNome.type = "text";
    inputNome.className = "form-control procedimento-nome";
    inputNome.value = nome;
    tdNome.appendChild(inputNome);

    const tdTuss = document.createElement("td");
    const inputTuss = document.createElement("input");
    inputTuss.type = "number";
    inputTuss.className = "form-control procedimento-tuss";
    inputTuss.value = tuss;
    tdTuss.appendChild(inputTuss);

    const tdValor = document.createElement("td");
    const inputValor = document.createElement("input");
    inputValor.type = "number";
    inputValor.className = "form-control valor-procedimento";
    inputValor.value = valor;
    inputValor.step = "0.01";
    tdValor.appendChild(inputValor);

    const tdAcoes = document.createElement("td");
    const btnRemover = document.createElement("button");
    btnRemover.className = "btn btn-danger btn-sm";
    btnRemover.textContent = "Remover";
    btnRemover.onclick = function () {
        tabela.removeChild(tr);
        atualizarTotal();
        atualizarInputHidden();
    };

    tdAcoes.appendChild(btnRemover);

    tr.appendChild(tdNome);
    tr.appendChild(tdTuss);
    tr.appendChild(tdValor);
    tr.appendChild(tdAcoes);

    tabela.appendChild(tr);

    atualizarTotal();
    atualizarInputHidden();

    inputNome.addEventListener("input", atualizarInputHidden);
    inputTuss.addEventListener("input", atualizarInputHidden);
    inputValor.addEventListener("input", () => {
        atualizarTotal();
        atualizarInputHidden();
    });
}



function adicionarProcedimentoAnestesista(nome, valor, tuss) {
    const tabela = document.getElementById("tabela-procedimentosAnestesista");

    const tr = document.createElement("tr");

    const tdNome = document.createElement("td");
    const inputNome = document.createElement("input");
    inputNome.type = "text";
    inputNome.className = "form-control procedimento-nome";
    inputNome.value = nome;
    tdNome.appendChild(inputNome);

    const tdTuss = document.createElement("td");
    const inputTuss = document.createElement("input");
    inputTuss.type = "number";
    inputTuss.className = "form-control procedimento-tuss";
    inputTuss.value = tuss;
    tdTuss.appendChild(inputTuss);

    const tdValor = document.createElement("td");
    const inputValor = document.createElement("input");
    inputValor.type = "number";
    inputValor.className = "form-control valor-procedimento";
    inputValor.value = valor;
    inputValor.step = "0.01";
    tdValor.appendChild(inputValor);

    const tdAcoes = document.createElement("td");
    const btnRemover = document.createElement("button");
    btnRemover.className = "btn btn-danger btn-sm";
    btnRemover.textContent = "Remover";
    btnRemover.onclick = function () {
        tabela.removeChild(tr);
        atualizarTotal();
        atualizarInputHidden();
    };

    tdAcoes.appendChild(btnRemover);

    tr.appendChild(tdNome);
    tr.appendChild(tdTuss);
    tr.appendChild(tdValor);
    tr.appendChild(tdAcoes);

    tabela.appendChild(tr);

    atualizarInputHidden();

    atualizarTotal();

    inputNome.addEventListener("input", atualizarInputHidden);
    inputTuss.addEventListener("input", atualizarInputHidden);
    inputValor.addEventListener("input", () => {
        atualizarTotal();
        atualizarInputHidden();
    });
}


function atualizarTotal() {
    let total = 0;
    document.querySelectorAll(".valor-procedimento").forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    document.getElementById("totalValor").textContent = total.toFixed(2);
}

function atualizarInputHidden() {
    const procedimentos = [];

    document.querySelectorAll("#tabela-procedimentos tr").forEach(tr => {
        const nome = tr.querySelector(".procedimento-nome")?.value || "";
        const tuss = tr.querySelector(".procedimento-tuss")?.value || "";
        const valor = tr.querySelector(".valor-procedimento")?.value || "";

        if (nome && valor) {
            procedimentos.push({ nome, tuss, valor });
        }
    });

    try{

        document.querySelectorAll("#tabela-procedimentosAnestesista tr").forEach(tr => {
                const nome = tr.querySelector(".procedimento-nome")?.value || "";
                const tuss = tr.querySelector(".procedimento-tuss")?.value || "";
                const valor = tr.querySelector(".valor-procedimento")?.value || "";

                if (nome && valor) {
                    procedimentos.push({ nome, tuss, valor });

                }
        });
    } catch (error) {
        console.warn("Sem Tabela de Procedimentos Anestesista");
    }


    document.getElementById("precosProcedimentosInput").value = JSON.stringify(procedimentos);
}






try {
document.addEventListener("DOMContentLoaded", function() {
    const precosProcedimentosLoad = JSON.parse(document.getElementById("precosProcedimentosLoad").value);


    if (precosProcedimentosLoad.length > 0) {
        precosProcedimentosLoad.forEach(procedimento => {
            adicionarProcedimento(procedimento.nome, procedimento.valor, procedimento.tuss);
        });
    }
});
} catch (error) {
    console.warn("Elemento não encontrado");
}







document.addEventListener("DOMContentLoaded", function () {

try {
document.getElementById("prosseguir").addEventListener("click", function (event) {
        let cirurgiao = document.getElementById("id_usuarios_cirurgioes").value;
        let anestesista = document.getElementById("id_usuarios_anestesistas").value;

        if (cirurgiao === "") {
            alert("Selecione um cirurgião.");
            event.preventDefault();
            return;
        }

        if (anestesista === "") {
            alert("Selecione um anestesista.");
            event.preventDefault();
            return;
        }


        document.getElementById("status").value = "cirurgiao";
    });
} catch (error) {
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}




try {
document.getElementById("criar").addEventListener("click", function (event) {

        document.getElementById("status").value = "liberacao";
    });
} catch (error) {
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}




try {
    document.addEventListener("click", function (event) {
        if (event.target.id === "liberar") {
            document.getElementById("status").value = "negociacao";
        }
    });
} catch (error) {
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}



try {
    document.addEventListener("click", function (event) {
        if (event.target.id === "recusar") {
            document.getElementById("status").value = "recusado";
        }
    });
} catch (error) {
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}




try {
    document.addEventListener("click", function (event) {
        if (event.target.id === "ganho") {
            document.getElementById("status").value = "aprovado";
        }
    });
} catch (error) {
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}





try {
    document.addEventListener("click", function (event) {
        if (event.target.id === "perdido") {
            document.getElementById("status").value = "perdido";
        }
    });
} catch (error) {
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}

});









</script>





@endsection
