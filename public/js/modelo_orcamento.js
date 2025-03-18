document.addEventListener("DOMContentLoaded", function () {
    var total_hospital = 0;

    var precosProcedimentosElement = document.getElementById("precosProcedimentosLoad");
    if (precosProcedimentosElement) {
        try {
            const precosProcedimentosLoad = JSON.parse(precosProcedimentosElement.value || "[]");

            if (precosProcedimentosLoad.length > 0) {


                precosProcedimentosLoad.forEach(procedimento => {
                    let valor_unit_procedimento = parseFloat(procedimento.valor.toString().replace(',', '.')) || 0;
                    let qntd_procedimento = parseFloat(procedimento.qntd.toString().replace(',', '.')) || 0;

                    let valor_total = valor_unit_procedimento * qntd_procedimento;
                    total_hospital += valor_total;

                    adicionarProcedimento(procedimento.nome, valor_unit_procedimento, qntd_procedimento, valor_total);
                });

                adicionarLinhaTotal(total_hospital);

            } else {
                console.warn("Elemento com id 'precosProcedimentosLoad' não encontrado");
            }
            } catch (error) {
            console.warn("Erro ao processar precosProcedimentos:", error);
        }}
    });

function adicionarProcedimento(nome, valor, qntd, total) {
    const tabela = document.getElementById("tabela-procedimentos");
    const tr = document.createElement("tr");

    const tdNome = document.createElement("td");
    const inputNome = document.createElement("p");
    inputNome.textContent = nome;
    tdNome.appendChild(inputNome);

    const tdQntd = document.createElement("td");
    const inputQntd = document.createElement("p");
    inputQntd.className = "procedimento-qntd text-end";
    inputQntd.textContent = qntd;
    tdQntd.appendChild(inputQntd);

    const tdValor = document.createElement("td");
    const inputValor = document.createElement("p");
    inputValor.className = "valor-procedimento money text-end";
    inputValor.textContent = valor.toFixed(2).replace(".", ","); // Formatação do valor
    tdValor.appendChild(inputValor);


    const tdTotal = document.createElement("td");
    const inputTotal = document.createElement("p");
    inputTotal.className = "valor-total money text-end";
    inputTotal.textContent = total.toFixed(2).replace(".", ",");
    tdTotal.appendChild(inputTotal);

    tr.appendChild(tdNome);
    tr.appendChild(tdQntd);
    tr.appendChild(tdValor);
    tr.appendChild(tdTotal);

    tabela.appendChild(tr);

    // Atualizar total ao alterar valores
    inputQntd.addEventListener("input", atualizarTotal);
    inputValor.addEventListener("input", atualizarTotal);
}

function adicionarLinhaTotal(total) {
    const tabela = document.getElementById("tabela-procedimentos");
    const trTotal = document.createElement("tr");
    trTotal.id = "linha-total";
    trTotal.innerHTML = `
        <td colspan="3" class="text-end"><p><strong>Total:</strong></p></td>
        <td class="money text-end"><p><strong>${total.toFixed(2).replace(".", ",")}</strong></p></td>
    `;
    tabela.appendChild(trTotal);
}

function atualizarTotal() {
    let total_hospital = 0;
    const tabela = document.getElementById("tabela-procedimentos");
    const linhas = tabela.querySelectorAll("tr");

    linhas.forEach(tr => {
        const inputQntd = tr.querySelector(".procedimento-qntd");
        const inputValor = tr.querySelector(".valor-procedimento");
        const tdTotal = tr.querySelector(".valor-total");

        if (inputQntd && inputValor && tdTotal) {
            let qntd = parseFloat(inputQntd.value) || 0;
            let valor = parseFloat(inputValor.value.replace(",", ".")) || 0;
            let total = qntd * valor;
            tdTotal.textContent = total.toFixed(2).replace(".", ",");
            total_hospital += total;
        }
    });

    // Atualiza a linha de total
    const linhaTotal = document.getElementById("linha-total");
    if (linhaTotal) {
        linhaTotal.querySelector("td:last-child").innerHTML = `<strong>${total_hospital.toFixed(2).replace(".", ",")}</strong>`;
    }
}






try {
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".money").forEach(input => {
            input.addEventListener("input", formatarMoeda);
            formatarMoeda({ target: input });
        });
    });

    function formatarMoeda(event) {
        let input = event.target;
        let valor = input.value || "";


        valor = valor.replace(/[^\d,]/g, "");


        valor = valor.replace(/,{2,}/g, ",");


        let partes = valor.split(",");
        if (partes.length > 2) {
            valor = partes[0] + "," + partes.slice(1).join("");
        }

        let numero = parseFloat(valor.replace(",", "."));

        if (!isNaN(numero)) {
            input.value = numero.toFixed(2).replace(".", ",");
        } else {
            input.value = "0,00";
        }
    }
} catch (error) {
    console.warn("Erro ao formatar moeda:", error);
}
