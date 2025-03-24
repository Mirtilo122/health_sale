// funções para converter os valores vindo do banco

try{
    let taxaAnestesiaHidden = document.getElementById("taxa_anestesia_hidden").value;
    let dados;

    try {
        dados = JSON.parse(taxaAnestesiaHidden);
    } catch (error) {
        console.error("Erro ao converter JSON:", error);
    }

    var taxaAnestesiaJson = dados;
    if ("taxaAnestesia" in dados && "outrosCustosAnestesia" in dados) {
        valorTaxaAnestesiaJson = dados.taxaAnestesia;
        valoroutrosCustosAnestesiaJson = dados.outrosCustosAnestesia;


        valorTaxaAnestesiaJson = parseFloat(valorTaxaAnestesiaJson.toFixed(2));


        valoroutrosCustosAnestesiaJson = parseFloat(valoroutrosCustosAnestesiaJson.toFixed(2));

        dados = {
            id0: {
                Nome: "Taxa Anestesista",
                Valor: valorTaxaAnestesiaJson,
                Prazo: 0
            },
            id1: {
                Nome: "Outros Custos de Anestesia",
                Valor: valoroutrosCustosAnestesiaJson,
                Prazo: 0
            }
        };
    }

    taxaAnestesiaJson = dados;
} catch {
}

try{
    let taxaCirurgiaoHidden = document.getElementById("precosCirurgiaoLoad").value;
    let dadosCir;

    try {
        dadosCir = JSON.parse(taxaCirurgiaoHidden);
    } catch (error) {
        console.error("Erro ao converter JSON:", error);
    }

    var taxaCirurgiaoJson = dadosCir;

    if ("cirurgiaoPrincipal" in dadosCir) {

        valorcirurgiaoPrincipalJson = dadosCir.cirurgiaoPrincipal;
        valorcirurgiaoAuxiliarJson = dadosCir.cirurgiaoAuxiliar;
        valorinstrumentadorJson = dadosCir.instrumentador;
        valoroutrosCustosJson = dadosCir.outrosCustos;

        valorcirurgiaoPrincipalJson = Number(parseFloat(valorcirurgiaoPrincipalJson).toFixed(2));
        valorcirurgiaoAuxiliarJson = Number(parseFloat(valorcirurgiaoAuxiliarJson).toFixed(2));
        valorinstrumentadorJson = Number(parseFloat(valorinstrumentadorJson).toFixed(2));
        valoroutrosCustosJson = Number(parseFloat(valoroutrosCustosJson).toFixed(2));

        dadosCir = {
            id0: {
                Nome: "Cirurgião Principal",
                Valor: valorcirurgiaoPrincipalJson,
                Prazo: 0
            },
            id1: {
                Nome: "Cirurgião Auxiliar",
                Valor: valorcirurgiaoAuxiliarJson,
                Prazo: 0
            },
            id2: {
                Nome: "Instrumentador",
                Valor: valorinstrumentadorJson,
                Prazo: 0
            },
            id3: {
                Nome: "Taxa de Video",
                Valor: 0,
                Prazo: 0
            },
            id4: {
                Nome: "Outros Custos de Cirurgião",
                Valor: valoroutrosCustosJson,
                Prazo: 0
            }
        };
    }

    taxaCirurgiaoJson = dadosCir;
} catch {
}




// Funções simples os selects de informações

function atualizarHidden(info) {
    document.getElementById(info + "Hidden").value = document.getElementById(info).value;
}


function toggleComorbidadesAdmin() {
    const comorbidades = document.getElementById("comorbidades").value;
    const descricaoComorbidade = document.getElementById("comorbidade");

    if (comorbidades === "sim") {
        descricaoComorbidade.classList.remove("d-none");
    } else {
        descricaoComorbidade.classList.add("d-none");
    }
}

function toggleCirurgiaoAdmin() {
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





// Funções de Adição de Agentes

try {

const agentesEditar = JSON.parse(document.getElementById('agentesEditarDesignadosLoad').value || '[]');
const agentesVisualizar = JSON.parse(document.getElementById('agentesVisualizarDesignadosLoad').value || '[]');

const agentesCombinados = [...new Set([...agentesEditar, ...agentesVisualizar])];

contarIdsAgentes()

} catch (error) {
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







document.getElementById("orcamento-form").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        console.log("Envio bloqueado ao pressionar Enter!");
    }
});



// Procedimentos Hospital

try {
    document.getElementById("salvarProcedimento").addEventListener("click", function () {
        const nome = document.getElementById("procedimentoNome").value;
        const valorTexto = document.getElementById("procedimentoValor").value;

        const valor = parseFloat(valorTexto.replace(/\./g, '').replace(',', '.')) || 0;
        const qntd = parseInt(document.getElementById("procedimentoQntd").value) || 1;

        if (nome.trim() === "" || valor === 0) {
            alert("O nome e o valor do procedimento não podem estar vazios ou zerados!");
            return;
        }

        adicionarProcedimento(nome, valor, qntd, 0);

        document.getElementById("procedimentoNome").value = "";
        document.getElementById("procedimentoValor").value = "0,00";
        document.getElementById("procedimentoQntd").value = "1";

        bootstrap.Modal.getInstance(document.getElementById("procedimentoModal")).hide();
    });
} catch (error) {
}

function adicionarProcedimento(nome, valor, qntd, valorPrazo) {
    const tabela = document.getElementById("tabela-procedimentos");
    const tr = document.createElement("tr");

    const tdNome = document.createElement("td");
    const inputNome = document.createElement("input");
    inputNome.type = "text";
    inputNome.className = "form-control procedimento-nome";
    inputNome.value = nome;
    tdNome.appendChild(inputNome);

    const tdQntd = document.createElement("td");
    const inputQntd = document.createElement("input");
    inputQntd.type = "number";
    inputQntd.className = "form-control procedimento-qntd text-end";
    inputQntd.value = qntd;
    inputQntd.min = "1";
    tdQntd.appendChild(inputQntd);

    const tdValor = document.createElement("td");
    const inputValor = document.createElement("input");
    inputValor.type = "text";
    inputValor.className = "form-control valor-procedimento money text-end";
    inputValor.value = valor.toFixed(2).replace(".", ",");
    tdValor.appendChild(inputValor);

    const tdTotal = document.createElement("td");
    tdTotal.className = "valor-total money text-center";
    tdTotal.textContent = (valor * qntd).toFixed(2).replace(".", ",");

    const tdPrazo = document.createElement("td");
    tdPrazo.className = "prazoHospital d-none";
    const inputPrazo = document.createElement("input");
    inputPrazo.type = "text";
    inputPrazo.className = "form-control prazoHospital taxaPrazoHospital d-none money text-end";
    inputPrazo.value = valorPrazo.toFixed(2).replace(".", ",");
    tdPrazo.appendChild(inputPrazo);

    const tdTotalPrazo = document.createElement("td");
    tdTotalPrazo.className = "valor-totalHospital prazoHospital d-none money text-center";
    tdTotalPrazo.textContent = (valorPrazo * qntd).toFixed(2).replace(".", ",");

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
    tr.appendChild(tdQntd);
    tr.appendChild(tdValor);
    tr.appendChild(tdPrazo);
    tr.appendChild(tdTotal);
    tr.appendChild(tdTotalPrazo);
    tr.appendChild(tdAcoes);

    tabela.appendChild(tr);
    atualizarTotal();
    atualizarInputHidden();

    inputQntd.addEventListener("blur", () => {
        atualizarValorTotal(tr);
        atualizarValorTotalPrazo(tr);
        atualizarTotal();
        atualizarInputHidden();
    });

    inputValor.addEventListener("blur", () => {
        atualizarValorTotal(tr);
        atualizarTotal();
        atualizarInputHidden();
        formatarMoeda({ target: inputValor });
    });

    inputPrazo.addEventListener("blur", () => {
        atualizarValorTotalPrazo(tr);
        atualizarTotal();
        atualizarInputHidden();
        formatarMoeda({ target: inputPrazo });
    });


    formatarMoeda({ target: inputValor });
}

function atualizarValorTotal(tr) {
    const qntd = parseInt(tr.querySelector(".procedimento-qntd").value) || 1;
    const valor = parseFloat(tr.querySelector(".valor-procedimento").value.replace(',', '.')) || 0;

    const total = (qntd * valor).toFixed(2).replace('.', ',');
    tr.querySelector(".valor-total").textContent = total;

    formatarMoeda({ target: tr.querySelector(".valor-total") });
}

function atualizarValorTotalPrazo(tr) {
    const qntd = parseInt(tr.querySelector(".procedimento-qntd").value) || 1;
    const valor = parseFloat(tr.querySelector(".taxaPrazoHospital").value.replace(',', '.')) || 0;

    const total = (qntd * valor).toFixed(2).replace('.', ',');
    tr.querySelector(".valor-totalHospital").textContent = total;

    formatarMoeda({ target: tr.querySelector(".valor-totalHospital") });
}

function atualizarTotal() {
    let total = 0;

    total += converterStringToMoney(document.getElementById("totalAnestesia").textContent) || 0;
    total += converterStringToMoney(document.getElementById("totalCirurgiao").textContent) || 0;

    document.querySelectorAll("#tabela-procedimentos tr").forEach(tr => {
        const valorTotal = converterStringToMoney(tr.querySelector(".valor-total").textContent) || 0;
        total += valorTotal;
    });

    if (isNaN(total)) {
        total = 0;
    }
    let totalFormatado = total.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });


    document.getElementById("totalValor").textContent = totalFormatado;
    document.getElementById("valor_total").value = total;
}

function atualizarInputHidden() {
    const procedimentos = [];

    document.querySelectorAll("#tabela-procedimentos tr").forEach(tr => {
        const nome = tr.querySelector(".procedimento-nome")?.value || "";
        const qntd = tr.querySelector(".procedimento-qntd")?.value || "";
        const valor = tr.querySelector(".valor-procedimento")?.value.replace(',', '.') || "";
        const valorPrazo = tr.querySelector(".taxaPrazoHospital")?.value.replace(',', '.') || "";

        if (nome && valor) {
            procedimentos.push({ nome, qntd, valor: parseFloat(valor).toFixed(2), valorPrazo: parseFloat(valorPrazo).toFixed(2)});
        }
    });

    document.getElementById("precosProcedimentosInput").value = JSON.stringify(procedimentos);
}

let visibilidade_valor_prazo_hospital = false;

try {
    document.addEventListener("DOMContentLoaded", function () {
        var precosProcedimentosElement = document.getElementById("precosProcedimentosLoad");
        if (precosProcedimentosElement) {
            const precosProcedimentosLoad = JSON.parse(precosProcedimentosElement.value || "[]");

            if (precosProcedimentosLoad.length > 0) {
                precosProcedimentosLoad.forEach(procedimento => {
                    let valor_unit_procedimento = parseFloat(procedimento.valor.toString()) || 0;
                    let qntd_procedimento = parseFloat(procedimento.qntd.toString()) || 0;
                    let valor_prazo = parseFloat(procedimento.valorPrazo) || 0;

                    if (valor_prazo > 0){
                        visibilidade_valor_prazo_hospital = true;
                    }

                    adicionarProcedimento(procedimento.nome, valor_unit_procedimento, qntd_procedimento, valor_prazo);
                });
            }
            if (visibilidade_valor_prazo_hospital){
                addVisibilidadePrazoHospital();
            }
        } else {
        }
    });
} catch (error) {
}





function addVisibilidadePrazoHospital() {
    document.querySelectorAll(".prazoHospital").forEach(element => {
        element.classList.remove("d-none");
    });

    document.querySelector('button[onclick="addVisibilidadePrazoHospital()"]').classList.add("d-none");
    document.querySelector('button[onclick="removeVisibilidadePrazoHospital()"]').classList.remove("d-none");

    visibilidade_valor_prazo_hospital = true;
}

function removeVisibilidadePrazoHospital() {
    document.querySelectorAll(".prazoHospital").forEach(element => {
        element.classList.add("d-none");
    });

    document.querySelector('button[onclick="addVisibilidadePrazoHospital()"]').classList.remove("d-none");
    document.querySelector('button[onclick="removeVisibilidadePrazoHospital()"]').classList.add("d-none");

    document.querySelectorAll(".taxaPrazoHospital").forEach(input => {
        input.value = "0,00";
    });
    document.querySelectorAll(".valor-totalHospital").forEach(input => {
        input.textContent = "0,00";
    });


    visibilidade_valor_prazo_hospital = false;
}






// Adicionar preços dinâmicos anestesia



let id_linha = 0;
visibilidade_valor_prazo = false;

function adicionarOutroCusto(id = null, nome = "", valor = "00,00", prazo = "0,00") {
    let tabela = document.getElementById("tabelaAnestesia");
    let novaLinha = document.createElement("tr");

    if (id === null) {
        id_linha++;
        id = id_linha;
    } else {
        id_linha = Math.max(id_linha, id);
    }

    let novaLinhaHTML = `
        <td><input type="text" name="taxaAnestesiaNome${id}" class="form-control" placeholder="Nome do custo" value="${nome}"></td>
        <td><input type="text" id="taxaAnestesiaValor${id}" name="taxaAnestesiaValor${id}" class="form-control money taxaAnestesia text-end" value="${valor}" oninput="calcularTotalAnestesia()"></td>
    `;

    if (visibilidade_valor_prazo) {
        novaLinhaHTML += `
            <td class="prazoAnestesia"><input type="text" id="taxaAnestesiaPrazo${id}" name="taxaAnestesiaPrazo${id}" class="form-control prazoAnestesia taxaPrazoAnestesia money text-end" value="${prazo}" onblur="calcularTotalPrazoAnestesia()"></td>
        `;
    } else {
        novaLinhaHTML += `
            <td class="prazoAnestesia d-none"><input type="text" id="taxaAnestesiaPrazo${id}" name="taxaAnestesiaPrazo${id}" class="form-control prazoAnestesia taxaPrazoAnestesia d-none money text-end" value="${prazo}" onblur="calcularTotalPrazoAnestesia()"></td>
        `;
    }

    novaLinhaHTML += `
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removerLinha(this)">Excluir</button></td>
    `;

    novaLinha.innerHTML = novaLinhaHTML;

    let totalRow = tabela.lastElementChild;
    tabela.insertBefore(novaLinha, totalRow);

    novaLinha.querySelectorAll(".money").forEach(element => {
        element.addEventListener("blur", formatarMoeda);
        formatarMoeda({ target: element });
    });

    atualizarTaxaAnestesiaJson();
    calcularTotalAnestesia();
    calcularTotalPrazoAnestesia();
}


function carregarTaxasAnestesia() {
    let dados = taxaAnestesiaJson;

    if (!dados) return;

    let maiorID = 0;
    let exibirColunaPrazo = false;

    Object.keys(dados).forEach(id => {

        let item = dados[id];
        if (!id === "id0") {
            adicionarOutroCusto(id, item.Nome, item.Valor, item.Prazo);
        }

        if (item.Prazo > 0) {
            exibirColunaPrazo = true;
        }

        id = id.replace(/\D/g, "");
        maiorID = Math.max(maiorID, parseInt(id));
    });

    id_linha = maiorID++;

    if (exibirColunaPrazo) {
        addVisibilidadePrazoAnestesia();
    }
}


function removerLinha(botao) {
    botao.closest("tr").remove();
    atualizarTaxaAnestesiaJson();
    calcularTotalAnestesia();
    calcularTotalPrazoAnestesia();
}

try{
    document.addEventListener("DOMContentLoaded", carregarTaxasAnestesia);
} catch {
}





// Funções de atualização de campos anestesia




function addVisibilidadePrazoAnestesia() {
    document.querySelectorAll(".prazoAnestesia").forEach(element => {
        element.classList.remove("d-none");
    });

    document.querySelector('button[onclick="addVisibilidadePrazoAnestesia()"]').classList.add("d-none");
    document.querySelector('button[onclick="removeVisibilidadePrazoAnestesia()"]').classList.remove("d-none");

    visibilidade_valor_prazo = true;
}

function removeVisibilidadePrazoAnestesia() {
    document.querySelectorAll(".prazoAnestesia").forEach(element => {
        element.classList.add("d-none");
    });

    document.querySelector('button[onclick="addVisibilidadePrazoAnestesia()"]').classList.remove("d-none");
    document.querySelector('button[onclick="removeVisibilidadePrazoAnestesia()"]').classList.add("d-none");

    document.querySelectorAll(".taxaPrazoAnestesia").forEach(input => {
        input.value = "0,00";
    });


    visibilidade_valor_prazo = false;

    calcularTotalPrazoAnestesia();
}



function calcularTotalAnestesia() {
    const inputs = document.querySelectorAll('.taxaAnestesia');
    if (inputs.length > 0) {
        var total = 0;

        inputs.forEach(function(input) {
            valor = input.value.replace(/[^0-9,\.]/g, "");

            numero = converterStringToMoney(valor);

            if (!isNaN(numero)) {
                total += numero;
            }
        });

        const totalAnestesia = document.getElementById('totalAnestesia');
        if (totalAnestesia) {
            totalAnestesia.textContent = total.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            document.getElementById('totalAnestesia').textContent = "0,00";
        }

        atualizarTotal();
        atualizarTaxaAnestesiaJson();
    } else {
        document.getElementById('totalAnestesia').textContent = "0,00";
    }
}

function calcularTotalPrazoAnestesia() {
    const inputs = document.querySelectorAll('.taxaPrazoAnestesia');
    if (inputs.length > 0) {
        var total = 0;

        inputs.forEach(function(input) {
            valor = input.value.replace(/[^0-9,\.]/g, "");

            numero = converterStringToMoney(valor);

            if (!isNaN(numero)) {
                total += numero;
            }
        });

        const totalAnestesia = document.getElementById('totalPrazoAnestesia');
        if (totalAnestesia) {
            totalAnestesia.textContent = total.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            document.getElementById('totalPrazoAnestesia').textContent = "0,00";
        }
        atualizarTotal();
        atualizarTaxaAnestesiaJson();
    } else {
        document.getElementById('totalPrazoAnestesia').textContent = "0,00";
    }
}



function atualizarTaxaAnestesiaJson() {
    let dados = {};
    let linhas = document.querySelectorAll('#tabelaAnestesia tr');

    linhas.forEach(function (linha, index) {
        if (index === linhas.length - 1) {
            return;
        }

        let nomeInput = linha.querySelector('input[name^="taxaAnestesiaNome"]');
        let valorInput = linha.querySelector('input[name^="taxaAnestesiaValor"]');
        let valorinputPrazo = linha.querySelector('input[name^="taxaAnestesiaPrazo"]');

        let valorVista = valorInput.value;
        let valorPrazo = valorinputPrazo.value;

        valorVista = converterStringToMoney(valorVista);
        valorPrazo = converterStringToMoney(valorPrazo);

        let idLinha = nomeInput.name.match(/\d+$/);
        idLinha = idLinha ? idLinha[0] : index;

        dados['id' + idLinha] = {
            "Nome": nomeInput.value,
            "Valor": valorVista,
            "Prazo": valorPrazo
        }
    });

    document.getElementById("taxa_anestesia_hidden").value = JSON.stringify(dados);
}


try{
document.querySelectorAll('.taxaAnestesia').forEach(input => {
    input.addEventListener("blur", atualizarTaxaAnestesia);
});
} catch (error) {
}

try {
    document.addEventListener("DOMContentLoaded", function () {
        calcularTotalAnestesia();
        atualizarTaxaAnestesiaJson();
});
} catch (error) {
}






// Adicionar preços dinâmicos cirurgião




let id_linha_cir = 0;
visibilidade_valor_prazo_cir = false;

function adicionarOutroCustoCirurgiao(id = null, nome = "", valor = "00,00", prazo = "0,00") {
    let tabela = document.getElementById("tabelaCirurgiao");
    let novaLinha = document.createElement("tr");

    if (id === null) {
        id_linha_cir++;
        id = id_linha_cir;
    } else {
        id_linha_cir = Math.max(id_linha_cir, id);
    }

    let novaLinhaHTML = `
        <td><input type="text" name="taxaCirurgiaoNome${id}" class="form-control" placeholder="Nome do custo" value="${nome}"></td>
        <td><input type="text" id="taxaCirurgiaoValor${id}" name="taxaCirurgiaoValor${id}" class="form-control money taxaCirurgiao text-end" value="${valor}" oninput="calcularTotal()"></td>
    `;

    if (visibilidade_valor_prazo_cir) {
        novaLinhaHTML += `
            <td class="prazoCirurgiao"><input type="text" id="taxaCirurgiaoPrazo${id}" name="taxaCirurgiaoPrazo${id}" class="form-control prazoCirurgiao taxaPrazoCirurgiao money text-end" value="${prazo}" onblur="calcularTotalPrazoCirurgiao()"></td>
        `;
    } else {
        novaLinhaHTML += `
            <td class="prazoCirurgiao d-none"><input type="text" id="taxaCirurgiaoPrazo${id}" name="taxaCirurgiaoPrazo${id}" class="form-control prazoCirurgiao taxaPrazoCirurgiao d-none money text-end" value="${prazo}" onblur="calcularTotalPrazoCirurgiao()"></td>
        `;
    }

    novaLinhaHTML += `
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removerLinhaCir(this)">Excluir</button></td>
    `;

    novaLinha.innerHTML = novaLinhaHTML;

    let totalRow = tabela.lastElementChild;
    tabela.insertBefore(novaLinha, totalRow);

    novaLinha.querySelectorAll(".money").forEach(element => {
        element.addEventListener("blur", formatarMoeda);
        formatarMoeda({ target: element });
    });

    atualizarTaxaCirurgiaoJson();
    calcularTotal();
    calcularTotalPrazoCirurgiao();
}


function carregarTaxasCirurgiao() {
    let dados = taxaCirurgiaoJson;

    if (!dados) return;

    let maiorID = 0;
    let exibirColunaPrazoCirurgiao = false;

    Object.keys(dados).forEach(id => {

        let item = dados[id];

        if (!id === "id0" || !id === "id1" || !id === "id2" || !id === "id3") {
            adicionarOutroCustoCirurgiao(id, item.Nome, item.Valor, item.Prazo);
        }

        if (item.Prazo > 0) {
            exibirColunaPrazoCirurgiao = true;
        }

        id = id.replace(/\D/g, "");
        maiorID = Math.max(maiorID, parseInt(id));


    });

    id_linha = maiorID++;

    if (exibirColunaPrazoCirurgiao) {
        addVisibilidadePrazoCirurgiao();
    }
}


function removerLinhaCir(botao) {
    botao.closest("tr").remove();
    atualizarTaxaCirurgiaoJson();
    calcularTotal();
    calcularTotalPrazoCirurgiao();
}

try{
    document.addEventListener("DOMContentLoaded", carregarTaxasCirurgiao);
} catch {
}







//Valores Cirurgião




function addVisibilidadePrazoCirurgiao() {
    document.querySelectorAll(".prazoCirurgiao").forEach(element => {
        element.classList.remove("d-none");
    });

    document.querySelector('button[onclick="addVisibilidadePrazoCirurgiao()"]').classList.add("d-none");
    document.querySelector('button[onclick="removeVisibilidadePrazoCirurgiao()"]').classList.remove("d-none");

    visibilidade_valor_prazo_cir = true;
}

function removeVisibilidadePrazoCirurgiao() {
    document.querySelectorAll(".prazoCirurgiao").forEach(element => {
        element.classList.add("d-none");
    });

    document.querySelector('button[onclick="addVisibilidadePrazoCirurgiao()"]').classList.remove("d-none");
    document.querySelector('button[onclick="removeVisibilidadePrazoCirurgiao()"]').classList.add("d-none");

    document.querySelectorAll(".taxaPrazoCirurgiao").forEach(input => {
        input.value = "0,00";
    });


    visibilidade_valor_prazo_cir = false;

    calcularTotalPrazoCirurgiao();
}



function calcularTotal() {
    const inputs = document.querySelectorAll('.taxaCirurgiao');
    if (inputs.length > 0) {
        var total = 0;

        inputs.forEach(function(input) {
            valor = input.value.replace(/[^0-9,\.]/g, "");


            numero = converterStringToMoney(valor);


            if (!isNaN(numero)) {
                total += numero;
            }
        });

        const totalCirurgiao = document.getElementById('totalCirurgiao');
        if (totalCirurgiao) {
            totalCirurgiao.textContent = total.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            document.getElementById('totalCirurgiao').textContent = "0,00";
        }

        atualizarTotal();
        atualizarTaxaCirurgiaoJson();
    } else {
        try{document.getElementById('totalCirurgiao').textContent = "0,00";} catch {}
    }
}



function calcularTotalPrazoCirurgiao() {
    const inputs = document.querySelectorAll('.taxaPrazoCirurgiao');
    if (inputs.length > 0) {
        var total = 0;

        inputs.forEach(function(input) {
            valor = input.value.replace(/[^0-9,\.]/g, "");

            numero = converterStringToMoney(valor);

            if (!isNaN(numero)) {
                total += numero;
            }
        });

        const totalCirurgiao = document.getElementById('totalPrazoCirurgiao');
        if (totalCirurgiao) {
            totalCirurgiao.textContent = total.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            document.getElementById('totalPrazoCirurgiao').textContent = "0,00";
        }
        atualizarTotal();
        atualizarTaxaCirurgiaoJson();
    } else {
        document.getElementById('totalPrazoCirurgiao').textContent = "0,00";
    }
}







function atualizarTaxaCirurgiaoJson() {
    let dados = {};
    let linhas = document.querySelectorAll('#tabelaCirurgiao tr');

    linhas.forEach(function (linha, index) {
        if (index === linhas.length - 1) {
            return;
        }

        let nomeInput = linha.querySelector('input[name^="taxaCirurgiaoNome"]');
        let valorInput = linha.querySelector('input[name^="taxaCirurgiaoValor"]');
        let valorinputPrazo = linha.querySelector('input[name^="taxaCirurgiaoPrazo"]');

        let valorVista = valorInput.value;
        let valorPrazo = valorinputPrazo.value;

        valorVista = converterStringToMoney(valorVista);
        valorPrazo = converterStringToMoney(valorPrazo);

        let idLinha = nomeInput.name.match(/\d+$/);
        idLinha = idLinha ? idLinha[0] : index;

        dados['id' + idLinha] = {
            "Nome": nomeInput.value,
            "Valor": valorVista,
            "Prazo": valorPrazo
        }
    });

    document.getElementById("taxa_cirurgiao_hidden").value = JSON.stringify(dados);
}



try{
    document.querySelectorAll('.taxaCirugiao').forEach(input => {
    input.addEventListener("blur", atualizarTaxaCirurgiao);
});
} catch (error) {
}

try {
    document.addEventListener("DOMContentLoaded", function () {
        calcularTotal();
        atualizarTaxaCirurgiaoJson();
});
} catch (error) {
}


// Formatar Valores Monetários

function converterStringToMoney(valor){
    if (!valor) {
        valor = "0.00";
    }

    valor = valor.replace(/[^0-9,\.]/g, "");

    if (valor.includes('.')) {
        let partes = valor.split('.');
        let parteDecimal = partes.pop();

        if (parteDecimal.length <= 2) {
        } else {
            valor = valor.replace(/\./g, "");
            valor = valor.replace(",", ".")
        }
    } else {
        valor = valor.replace(",", ".");
    }
    return numero = parseFloat(valor);
}

try {
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".money").forEach(element => {
            element.addEventListener("blur", formatarMoeda);
            formatarMoeda({ target: element });
        });
    });

    function formatarMoeda(event) {
        let element = event.target;
        let valor = element.value || element.textContent;

        numero = converterStringToMoney(valor);
        if (isNaN(numero)) {
            numero = 0;
        }
        let formatado = numero.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        if (element.tagName === "INPUT") {
            element.value = formatado;
        } else {
            element.textContent = formatado;
        }
    }
} catch (error) {
    console.error("Erro ao formatar moeda:", error);
}







// Alteração de Agente Responsável


try {
document.getElementById("confirmar-novo-responsavel").addEventListener("click", function () {
    let novoResponsavelId = document.getElementById("novo-responsavel").value;
    let listaAgentes = document.getElementById("lista-agentes");

    if (!novoResponsavelId) {
        alert("Selecione um novo responsável.");
        return;
    }

    let novoResponsavelNome = document.querySelector(`#novo-responsavel option[value="${novoResponsavelId}"]`).textContent;

    let selectAgentes = document.getElementById("agente-selecao");
    Array.from(selectAgentes.options).forEach(option => {
        if (option.value === novoResponsavelId) {
            option.disabled = true;
            option.style.color = "gray";
        } else if (option.value === document.getElementById("id_usuario_responsavel").value) {
            option.disabled = false;
            option.style.color = "black";
        }
    });

    let agenteDuplicado = document.getElementById("agente-" + novoResponsavelId);
    if (agenteDuplicado) {
        agenteDuplicado.remove();
    }

    let responsavelAtual = document.getElementById("agente-" + document.getElementById("id_usuario_responsavel").value);
    if (responsavelAtual) {
        responsavelAtual.remove();
    }

    let liResponsavel = document.createElement("li");
    liResponsavel.className = "list-group-item d-flex justify-content-between align-items-center";
    liResponsavel.id = "agente-" + novoResponsavelId;
    liResponsavel.innerHTML = `
        <div class="agente-nome" style="color: gray;">${novoResponsavelNome}</div>
        <div class="agente-switch">
            <span>Responsável</span>
        </div>
            <div>
                <button type="button" class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#modalAlterarResponsavel">
                    Alterar Responsável
                </button>
            </div>
        <div class="agente-actions"></div>
        <input type="hidden" id="id_usuario_responsavel" name="id_usuario_responsavel" value="${novoResponsavelId}">
    `;


    listaAgentes.prepend(liResponsavel);

    let modal = bootstrap.Modal.getInstance(document.getElementById("modalAlterarResponsavel"));
    modal.hide();
});
} catch (error) {
}









//Verifica se foi selecionado um cirurgião e um anestesista na tela Designar

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
    });
} catch (error) {
}







//Adição de Procedimentos Secundarios

function adicionarSecundario(codTuss = "", procedimento = "") {
    const novaDiv = document.createElement("div");
    novaDiv.classList.add("row", "d-flex", "flex-direction-row", "mb-2");

    novaDiv.innerHTML = `
        <div class="col-2 flex-fill d-flex">
            <p>Procedimento Secundário:</p>
        </div>

        <div class="col-3 flex-fill d-flex">
            <input type="number" name="cod_tuss_sec" placeholder="Insira o Código TUSS..." value="${codTuss}">
        </div>

        <div class="col-6 flex-fill d-flex">
            <input type="text" name="procedimento_sec" placeholder="Insira o Procedimento..." value="${procedimento}">
        </div>

        <div class="col-1 flex-fill d-flex">
            <button type="button" class="remover-btn btn btn-danger" onclick="removerProcedimento(this)">Remover</button>
        </div>
    `;

    document.getElementById("procedimentos-container").appendChild(novaDiv);
}

function removerProcedimento(botao) {
    botao.parentElement.parentElement.remove();
}



function excluirOrcamento() {
    let formulario = document.getElementById('orcamento-form');

    let camposObrigatorios = formulario.querySelectorAll('[required]');
    camposObrigatorios.forEach(campo => campo.removeAttribute('required'));

    document.getElementById("statusHidden").value = "inativo";
}


function recusarOrcamento() {
    let formulario = document.getElementById('orcamento-form');

    let camposObrigatorios = formulario.querySelectorAll('[required]');
    camposObrigatorios.forEach(campo => campo.removeAttribute('required'));

    document.getElementById("statusHidden").value = "recusado";
}

function salvarAndSair() {
    let formulario = document.getElementById('orcamento-form');

    let camposObrigatorios = formulario.querySelectorAll('[required]');
    camposObrigatorios.forEach(campo => campo.removeAttribute('required'));
}

function prepararEnvio(funcao) {

    try{
        const procedimentos = [];
        const codTussInputs = document.querySelectorAll('[name="cod_tuss_sec"]');
        const procedimentoInputs = document.querySelectorAll('[name="procedimento_sec"]');


        codTussInputs.forEach((input, index) => {
            if (input.value.trim() !== "" && procedimentoInputs[index].value.trim() !== "") {
                procedimentos.push({
                    cod_tuss: input.value,
                    procedimento: procedimentoInputs[index].value
                });
            }
        });

        document.getElementById("procedimentos_json").value = JSON.stringify(procedimentos);
    } catch {
    }

    switch (funcao){
        case "designar":
            document.getElementById("statusHidden").value = "cirurgiao";
            break;

        case "cirurgiao":
            document.getElementById("statusHidden").value = "anestesista";
            break;

        case "anestesista":
            document.getElementById("statusHidden").value = "criacao";
            break;

        case "criar":
            document.getElementById("statusHidden").value = "liberacao";
            document.getElementById("orcamento_emitido").value = 1;
            break;

        case "liberar":
            document.getElementById("statusHidden").value = "negociacao";
            break;

        case "recusar":
            document.getElementById("statusHidden").value = "recusado";
            break;

        case "ganho":
            document.getElementById("statusHidden").value = "aprovado";
            break;

        case "inativo":
            document.getElementById("statusHidden").value = "inativo";
            break;

        case "perdido":
            document.getElementById("statusHidden").value = "perdido";
            break;


    }
}






// Desabilita data Provável quando Urgente

try {
document.getElementById('urgente').addEventListener('change', function() {
    var dataInput = document.getElementById('data_provavel2');
    if (this.checked) {
        dataInput.disabled = true;
    } else {
        dataInput.disabled = false;
    }
});


window.onload = function() {
    var urgenteCheckbox = document.getElementById('urgente');
    var dataInput = document.getElementById('data_provavel');
    if (urgenteCheckbox.checked) {
        dataInput.readonly = true;
    }
}

} catch (error) {
}







// Atualiza inputs com os mesmos dados

try{


document.addEventListener("DOMContentLoaded", function () {
    function syncInputsByClass(className) {
        const inputs = document.querySelectorAll(`.${className}`);

        inputs.forEach(input => {
            input.addEventListener("blur", function () {
                inputs.forEach(otherInput => {
                    if (otherInput !== input) {
                        otherInput.value = input.value;
                    }
                });
            });
        });
    }

    syncInputsByClass("resumo_procedimento");
    syncInputsByClass("tempo_cirurgia");
    syncInputsByClass("detalhesProcedimento");
    syncInputsByClass("diarias_enfermaria");
    syncInputsByClass("diarias_apartamento");
    syncInputsByClass("diarias_uti");
});
} catch {}






// Funções do Richtext CKEditor

function inicializarCKEditor(id) {
    var elemento = document.getElementById(id);
    if (elemento) {
        try {
            CKEDITOR.replace(id, {
                toolbar: [
                    { name: 'clipboard', items: ['Undo', 'Redo'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'links', items: ['Link'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] }
                ],
                removePlugins: 'elementspath',
                resize_enabled: false,
                height: 100
            });
        } catch (e) {
        }
    } else {
    }
}

document.addEventListener('DOMContentLoaded', function() {
    inicializarCKEditor('condPagamentoAnestesista');
    inicializarCKEditor('condPagamentoCirurgiao');
});


try {
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof CKEDITOR === "undefined") {
            return;
        }

        var editorElement = document.getElementById('editor');
        if (editorElement) {
            var editorInstance = CKEDITOR.replace('editor', {
                toolbar: [
                    { name: 'clipboard', items: ['Undo', 'Redo'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'links', items: ['Link'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] }
                ],
                removePlugins: 'elementspath',
                resize_enabled: false,
            });

            editorInstance.on('instanceReady', function () {
                var selectedOption = document.getElementById('presetSelect')?.selectedOptions[0];
                var selectedContent = selectedOption ? selectedOption.value : '';
                editorInstance.setData(selectedContent);
            });

            var insertPresetButton = document.getElementById('insertPreset');
            if (insertPresetButton) {
                insertPresetButton.addEventListener('click', function () {
                    var selectedOption = document.getElementById('presetSelect')?.selectedOptions[0];
                    var selectedContent = selectedOption ? selectedOption.value : '';
                    CKEDITOR.instances.editor.setData(selectedContent);
                });
            }
        } else {
        }

        var presetSelect = document.getElementById('presetSelect');
        if (!presetSelect) {
        }

        var insertPresetButton = document.getElementById('insertPreset');
        if (!insertPresetButton) {
        }
    });
} catch (error) {
}







try {
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof CKEDITOR === "undefined") {
            return;
        }

        var editorCondPag = document.getElementById('condPagamentoHosp');
        if (editorCondPag) {
            var editorInstancePag = CKEDITOR.replace('condPagamentoHosp', {
                toolbar: [
                    { name: 'clipboard', items: ['Undo', 'Redo'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'links', items: ['Link'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] }
                ],
                removePlugins: 'elementspath',
                resize_enabled: false,
            });

            editorInstancePag.on('instanceReady', function () {
                var selectedOption = document.getElementById('presetSelectPag')?.selectedOptions[0];
                var selectedContent = selectedOption ? selectedOption.value : '';
                editorInstancePag.setData(selectedContent);
            });

            var insertPresetPagButton = document.getElementById('insertPresetPag');
            if (insertPresetPagButton) {
                insertPresetPagButton.addEventListener('click', function () {
                    var selectedOption = document.getElementById('presetSelectPag')?.selectedOptions[0];
                    var selectedContent = selectedOption ? selectedOption.value : '';
                    CKEDITOR.instances.condPagamentoHosp.setData(selectedContent);
                });
            }
        } else {
        }

        var presetSelectPag = document.getElementById('presetSelectPag');
        if (!presetSelectPag) {
        }

        var insertPresetPagButton = document.getElementById('insertPresetPag');
        if (!insertPresetPagButton) {
        }
    });
} catch (error) {
}
