


function toggleCirurgiao() {
    const cirurgiaoDefinido = document.getElementById("cirurgiaoDefinido").value;
    const dadosCirurgiao = document.getElementById("dadosCirurgiao");

    if (cirurgiaoDefinido === "sim") {
        dadosCirurgiao.classList.remove("d-none");
    } else {
        dadosCirurgiao.classList.add("d-none");
    }
}

function toggleComorbidades() {
    const comorbidades = document.getElementById("comorbidades").value;
    const descricaoComorbidades = document.getElementById("descricaoComorbidades");

    if (comorbidades === "sim") {
        descricaoComorbidades.classList.remove("d-none");
    } else {
        descricaoComorbidades.classList.add("d-none");
    }
}

function mostrarInfoProcedimentos() {
    const tipoOrcamento = document.getElementById("tipoOrcamento").value;
    const infoProcedimentos = document.getElementById("detalhes-tab");
    const infoParto = document.getElementById("divParto");
    const infoCirurgia = document.getElementById("divCirurgia");
    const detalhesButton = document.getElementById("detalhes-button");

    if (tipoOrcamento === "nao") {
        infoProcedimentos.classList.add("disabled");
        detalhesButton.disabled = true;
    } else {
        infoProcedimentos.classList.remove("disabled");
        detalhesButton.disabled = false;
    }

    if (tipoOrcamento === "parto") {
        infoCirurgia.classList.add("d-none");
        infoParto.classList.remove("d-none");
    }

    if (tipoOrcamento === "cirurgia") {
        infoParto.classList.add("d-none");
        infoCirurgia.classList.remove("d-none");
    }
}

function navigateTo(origem, destino) {
    const origemTab = document.getElementById(origem + "-tab");
    const destinoTab = document.getElementById(destino + "-tab");
    destinoTab.click();
}

(function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

document.getElementById("formRepresent").addEventListener("submit", function (event) {
    const alertError = document.getElementById("alertError");
    if (!this.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        alertError.classList.remove("d-none");
        alertError.classList.add("show");

        const invalidField = this.querySelector(":invalid");
        if (invalidField) {
            const tabPane = invalidField.closest(".tab-pane");
            const tabId = tabPane.getAttribute("id");

            const tabButton = document.querySelector(`[data-bs-target="#${tabId}"]`);
            if (tabButton) {
                const tab = new bootstrap.Tab(tabButton);
                tab.show();
            }

            invalidField.focus();
        }
    } else {
        alertError.classList.add("d-none");
    }

    this.classList.add("was-validated");
});





