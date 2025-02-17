

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



// Agentes


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






// Procedimentos Hospital

try {
    document.getElementById("salvarProcedimento").addEventListener("click", function () {
        const nome = document.getElementById("procedimentoNome").value;
        const valor = parseFloat(document.getElementById("procedimentoValor").value) || 0;
        const qntd = parseInt(document.getElementById("procedimentoQntd").value) || 1;

        if (nome.trim() === "" || valor <= 0) {
            alert("O nome e o valor do procedimento não podem estar vazios ou zerados!");
            return;
        }

        adicionarProcedimento(nome, valor, qntd);

        document.getElementById("procedimentoNome").value = "";
        document.getElementById("procedimentoValor").value = "";
        document.getElementById("procedimentoQntd").value = "";

        bootstrap.Modal.getInstance(document.getElementById("procedimentoModal")).hide();
    });
} catch (error) {
    console.warn("Elemento não encontrado, não é possível adicionar procedimentos.");
}


function adicionarProcedimento(nome, valor, qntd) {
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
    inputQntd.className = "form-control procedimento-qntd";
    inputQntd.value = qntd;
    inputQntd.min = "1";
    tdQntd.appendChild(inputQntd);

    const tdValor = document.createElement("td");
    const inputValor = document.createElement("input");
    inputValor.type = "number";
    inputValor.className = "form-control valor-procedimento";
    inputValor.value = valor.toFixed(2);
    inputValor.step = "0.01";
    tdValor.appendChild(inputValor);

    const tdTotal = document.createElement("td");
    tdTotal.className = "valor-total";
    tdTotal.textContent = (valor * qntd).toFixed(2);

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
    tr.appendChild(tdTotal);
    tr.appendChild(tdAcoes);

    tabela.appendChild(tr);
    atualizarTotal();
    atualizarInputHidden();

    inputQntd.addEventListener("input", () => {
        atualizarValorTotal(tr);
        atualizarTotal();
        atualizarInputHidden();
    });

    inputValor.addEventListener("input", () => {
        atualizarValorTotal(tr);
        atualizarTotal();
        atualizarInputHidden();
    });

}

function atualizarValorTotal(tr) {
    const qntd = parseInt(tr.querySelector(".procedimento-qntd").value) || 1;
    const valor = parseFloat(tr.querySelector(".valor-procedimento").value) || 0;
    tr.querySelector(".valor-total").textContent = (qntd * valor).toFixed(2);
}

function atualizarTotal() {
    let total = 0;

    total += parseFloat(document.getElementById("totalAnestesia").textContent) || 0;

    total += parseFloat(document.getElementById("totalCirurgiao").textContent) || 0;

    document.querySelectorAll("#tabela-procedimentos tr").forEach(tr => {
        const valorTotal = parseFloat(tr.querySelector(".valor-total").textContent) || 0;
        total += valorTotal;
    });

    document.getElementById("totalValor").textContent = total.toFixed(2);
    document.getElementById("valor_total").value = total.toFixed(2);
}

function atualizarInputHidden() {
    const procedimentos = [];

    document.querySelectorAll("#tabela-procedimentos tr").forEach(tr => {
        const nome = tr.querySelector(".procedimento-nome")?.value || "";
        const qntd = tr.querySelector(".procedimento-qntd")?.value || "";
        const valor = tr.querySelector(".valor-procedimento")?.value || "";

        if (nome && valor) {
            procedimentos.push({ nome, qntd, valor });
        }
    });

    document.getElementById("precosProcedimentosInput").value = JSON.stringify(procedimentos);
}

try {
    document.addEventListener("DOMContentLoaded", function () {
        var precosProcedimentosElement = document.getElementById("precosProcedimentosLoad");
        if (precosProcedimentosElement) {
            const precosProcedimentosLoad = JSON.parse(precosProcedimentosElement.value || "[]");

            if (precosProcedimentosLoad.length > 0) {
                precosProcedimentosLoad.forEach(procedimento => {
                    let valor_unit_procedimento = parseFloat(procedimento.valor) || 0;
                    let qntd_procedimento = parseFloat(procedimento.qntd) || 0;

                    adicionarProcedimento(procedimento.nome, valor_unit_procedimento, qntd_procedimento);
                });
            }
        } else {
            console.warn("Elemento com id 'precosProcedimentosLoad' não encontrado");
        }
    });
} catch (error) {
    console.warn("Erro ao carregar precosProcedimentos:", error);
}

function calcularTotal() {
    var inputs = document.querySelectorAll('input[id="valorCirurgiao"]');
    var total = 0;

    if (inputs.length > 0) {
        inputs.forEach(function(input) {
            total += parseFloat(input.value) || 0;
        });

        var totalCirurgiaoElement = document.getElementById('totalCirurgiao');
        if (totalCirurgiaoElement) {
            totalCirurgiaoElement.textContent = total.toFixed(2);
        } else {
            console.warn("Elemento com id 'totalCirurgiao' não encontrado");
        }

        atualizarTotal();
    } else {
        console.warn("Nenhum input com id 'valorCirurgiao' encontrado");
    }
}

function atualizarTaxaCirurgiao() {
    let taxaCirurgiao = {};

    const inputs = document.querySelectorAll("input[id='valorCirurgiao']");
    if (inputs.length > 0) {
        inputs.forEach(input => {
            const nome = input.getAttribute("name");
            const valor = parseFloat(input.value) || 0;

            taxaCirurgiao[nome] = valor;
        });

        const taxaCirurgiaoHidden = document.getElementById("taxa_cirurgiao_hidden");
        if (taxaCirurgiaoHidden) {
            taxaCirurgiaoHidden.value = JSON.stringify(taxaCirurgiao);
        } else {
            console.warn("Elemento com id 'taxa_cirurgiao_hidden' não encontrado");
        }
    } else {
        console.warn("Nenhum input com id 'valorCirurgiao' encontrado");
    }
}

try {
    const inputs = document.querySelectorAll("input[id='valorCirurgiao']");
    if (inputs.length > 0) {
        inputs.forEach(input => {
            input.addEventListener("input", atualizarTaxaCirurgiao);
        });
    } else {
        console.warn("Nenhum input com id 'valorCirurgiao' encontrado para adicionar evento");
    }
} catch (error) {
    console.warn("Erro ao adicionar evento de 'input':", error);
}






function calcularTotalAnestesia() {
    // Verifica se existem inputs com id 'taxaAnestesia'
    const inputs = document.querySelectorAll('input[id="taxaAnestesia"]');
    if (inputs.length > 0) {
        var total = 0;

        // Soma os valores de todos os inputs encontrados
        inputs.forEach(function(input) {
            total += parseFloat(input.value) || 0;
        });

        // Verifica se o elemento 'totalAnestesia' existe antes de atualizar seu conteúdo
        const totalAnestesia = document.getElementById('totalAnestesia');
        if (totalAnestesia) {
            totalAnestesia.textContent = total.toFixed(2);
        } else {
            console.warn("Elemento com id 'totalAnestesia' não encontrado");
        }

        atualizarTotal();
    } else {
        console.warn("Nenhum input com id 'taxaAnestesia' encontrado");
    }
}

function atualizarTaxaAnestesia() {
    let taxaAnestesia = {};

    // Verifica se existem inputs com id 'taxaAnestesia'
    const inputs = document.querySelectorAll("input[id='taxaAnestesia']");
    if (inputs.length > 0) {
        // Processa cada input encontrado
        inputs.forEach(input => {
            const nome = input.getAttribute("name");
            const valor = parseFloat(input.value) || 0;

            taxaAnestesia[nome] = valor;
        });

        // Verifica se o elemento com id 'taxa_anestesia_hidden' existe antes de atualizar seu valor
        const taxaAnestesiaHidden = document.getElementById("taxa_anestesia_hidden");
        if (taxaAnestesiaHidden) {
            taxaAnestesiaHidden.value = JSON.stringify(taxaAnestesia);
        } else {
            console.warn("Elemento com id 'taxa_anestesia_hidden' não encontrado");
        }
    } else {
        console.warn("Nenhum input com id 'taxaAnestesia' encontrado");
    }
}

try{
document.querySelectorAll("input[id='taxaAnestesia']").forEach(input => {
    input.addEventListener("input", atualizarTaxaAnestesia);
});
} catch (error) {
    console.warn("Elemento não encontrado");
}

try {
    document.addEventListener("DOMContentLoaded", function () {
        calcularTotal();
        atualizarTaxaCirurgiao();
        calcularTotalAnestesia();
        atualizarTaxaAnestesia();
});
} catch (error) {
    console.warn("Elemento não encontrado");
}

















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
    console.warn("Elemento não encontrado, formulário enviado sem verificar Cirugião ou Anestesista");
}







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
            document.getElementById("status").value = "cirurgiao";
            break;

        case "cirurgiao":
            document.getElementById("status").value = "anestesista";
            break;

        case "anestesista":
            document.getElementById("status").value = "criacao";
            break;

        case "criar":
            document.getElementById("status").value = "liberacao";
            break;

        case "liberar":
            document.getElementById("status").value = "negociacao";
            break;

        case "recusar":
            document.getElementById("status").value = "recusado";
            break;

        case "ganho":
            document.getElementById("status").value = "aprovado";
            break;

        case "perdido":
            document.getElementById("status").value = "perdido";
            break;


    }
}







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
    console.warn("Elemento não encontrado");
}




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
            console.warn(`Erro ao inicializar CKEditor para ${id}:`, e);
        }
    } else {
        console.warn(`Elemento com ID ${id} não encontrado. CKEditor não será inicializado.`);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    inicializarCKEditor('condPagamentoAnestesista');
    inicializarCKEditor('condPagamentoCirurgiao');
    inicializarCKEditor('condPagamentoHosp');
});


try {
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof CKEDITOR === "undefined") {
            console.warn("CKEditor não carregado corretamente.");
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
            console.warn("Elemento 'editor' não encontrado.");
        }

        var presetSelect = document.getElementById('presetSelect');
        if (!presetSelect) {
            console.warn("Elemento 'presetSelect' não encontrado.");
        }

        var insertPresetButton = document.getElementById('insertPreset');
        if (!insertPresetButton) {
            console.warn("Elemento 'insertPreset' não encontrado.");
        }
    });
} catch (error) {
    console.warn("Rich Text não disponível:", error);
}







