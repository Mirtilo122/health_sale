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


try{
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

} catch (error) {
    console.warn("Elemento não encontrado, ignorando erro.");
}


function openDatePicker() {
    const hiddenDateInput = document.getElementById("hiddenDateInput");
    hiddenDateInput.style.display = "block"; // Torna visível para funcionar
    hiddenDateInput.focus(); // Abre o seletor de data
    hiddenDateInput.style.display = "none"; // Esconde novamente após a escolha
}

try{
    document.getElementById("hiddenDateInput").addEventListener("change", function () {
        const dateInput = document.getElementById("dateInput");
        const date = new Date(this.value);
        if (!isNaN(date.getTime())) {
            dateInput.value = date.toLocaleDateString("pt-BR");
        }
    });
} catch {
    console.log('Data Não Disponível');
}


function formatDate(input) {
    let value = input.value.replace(/\D/g, "");
    if (value.length > 8) value = value.slice(0, 8);

    if (value.length >= 4) {
        value = value.replace(/(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
    } else if (value.length >= 2) {
        value = value.replace(/(\d{2})(\d{0,2})/, "$1/$2");
    }

    input.value = value;
}








function openDatePicker(id_data) {
    const hiddenDateInput = document.getElementById("hidden-" + id_data);
    const dateInput = document.getElementById(id_data);

    if (hiddenDateInput.style.display === "block") {
        hiddenDateInput.style.display = "none";
        dateInput.style.display = "block";
        dateInput.focus();
    } else {
        hiddenDateInput.style.display = "block";
        dateInput.style.display = "none";
        hiddenDateInput.focus();
    }
}

function formatDate(input) {
    let value = input.value.replace(/\D/g, "");
    if (value.length > 8) value = value.slice(0, 8);

    if (value.length >= 4) {
        value = value.replace(/(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
    } else if (value.length >= 2) {
        value = value.replace(/(\d{2})(\d{0,2})/, "$1/$2");
    }

    input.value = value;

    if (value.length === 10) {
        const [day, month, year] = value.split("/");
        if (day && month && year) {
            const formattedDate = `${year}-${month}-${day}`;
            document.getElementById("hidden-" + input.id).value = formattedDate;
        }
    }
}

try{
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("input[type='date']").forEach(function (dateInput) {
            dateInput.addEventListener("change", function () {
                const textInput = document.getElementById(this.id.replace("hidden-", ""));
                if (this.value) {
                    const [year, month, day] = this.value.split("-");
                    textInput.value = `${day}/${month}/${year}`;
                }
            });
        });
    });
}catch{

}
