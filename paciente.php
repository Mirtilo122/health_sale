<?php
session_start();
$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;
unset($_SESSION['status']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Orçamentos - Health Sales</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>

        .teste{
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 25px;
            padding-left: 100px;
            padding-right: 100px;
        }

        .textareadiv {            
            display: flex;
            flex-direction: column;
        }

        .teste label{
            margin-top: 15px;
        }

    </style>

</head>

<body>    
        <?php if ($status == 'success'): ?>
            <div class="alert alert-warning" role="alert">
                Houve um erro de redirecionamento, contate um administrador
            </div>
        <?php elseif ($status == 'error'): ?>
            <div class="alert alert-danger" role="alert">
                Erro ao processar o formulário!
            </div>
        <?php endif; ?>
        
        <div id="alertError" class="alert alert-danger d-none" role="alert">
            Preencha todos os campos necessários!
        </div>
        
   <div class="form-container">

    <h1>Formulário de Solicitação por Paciente ou Responsável</h1>    

    <form class="formulario-abas needs-validation" id="formRepresent" method="POST" action="processar_formulario.php" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="formulario" value="paciente">
        <input type="hidden" name="anestesia[]" value="">

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="paciente-tab" data-bs-toggle="tab" data-bs-target="#paciente-tab-pane" type="button" role="tab" aria-controls="paciente-tab-pane" aria-selected="true">Paciente</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="solicitante-tab" data-bs-toggle="tab" data-bs-target="#solicitante-tab-pane" type="button" role="tab" aria-controls="solicitante-tab-pane" aria-selected="false">Solicitante</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="geral-tab" data-bs-toggle="tab" data-bs-target="#geral-tab-pane" type="button" role="tab" aria-controls="geral-tab-pane" aria-selected="false">Geral</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link disabled" id="detalhes-tab" data-bs-toggle="tab" data-bs-target="#detalhes-tab-pane" type="button" role="tab" aria-controls="detalhes-tab-pane" aria-selected="false">Procedimento</button>
            </li>
        </ul>            

            <div class="tab-content" id="myTabContent">

                <!-- Paciente -->

                <div class="tab-pane fade show active" id="paciente-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                    <label for="nomePaciente">Nome do Paciente</label>
                    <input type="text" id="nomePaciente" name="nomePaciente" required>
                    <div class="invalid-feedback">Por favor, insira o nome do paciente.</div>

                    <label for="dataNasc">Data de Nascimento</label>
                    <input type="date" id="dataNasc" name="dataNasc" required>
                    <div class="invalid-feedback">Por favor, insira a data de nascimento.</div>

                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" required>
                    <div class="invalid-feedback">Por favor, insira a cidade.</div>

                    <label for="comorbidades">Paciente tem Comorbidades?</label>
                    <select id="comorbidades" name="comorbidades" onchange="toggleComorbidades()">
                        <option value="nao">Selecione...</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>

                    <div class="textareadiv; hidden" id="descricaoComorbidades">
                        <label for="descComorbidades">Descrever as Comorbidades</label>
                        <textarea id="descComorbidades" name="descComorbidades" rows="10" cols="50"></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="navigateTo('paciente', 'solicitante')">Prosseguir</button>
                </div>

                <!-- Solicitante -->

                <div class="tab-pane fade" id="solicitante-tab-pane" role="tabpanel" aria-labelledby="solicitante-tab" tabindex="0">

                    <label for="nome">Nome do Solicitante</label>
                    <input type="text" id="nome" name="nome" required>
                    <div class="invalid-feedback">Por favor, insira o nome do solicitante.</div>

                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" required>
                    <div class="invalid-feedback">Por favor, insira o sobrenome.</div>
                    
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" required>
                    <div class="invalid-feedback">Por favor, insira um número de telefone válido.</div>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <div class="invalid-feedback">Por favor, insira um email válido.</div>
                    
                    <label for="contato">Canal de Preferência para Contato</label>
                    <select id="contato" name="contato">
                        <option value="telefone">Telefone</option>
                        <option value="email">Email</option>
                    </select>
                    <div class="invalid-feedback">Por favor, selecione o tipo de orçamento.</div>

                    <button type="button" class="btn btn-secondary" onclick="navigateTo('solicitante', 'paciente')">Voltar</button>
                    <button type="button" class="btn btn-primary" onclick="navigateTo('solicitante', 'geral')">Prosseguir</button>
                </div>

                <!-- Orçamento -->

                <div class="tab-pane fade" id="geral-tab-pane" role="tabpanel" aria-labelledby="geral-tab" tabindex="0">
                    <label for="convenio">Convênio</label>
                    <select id="convenio" name="convenio">
                        <option value="nenhum">Sem Convênio</option>
                        <option value="particular">Particular</option>
                        <option value="cartaoDesconto">Cartão Desconto</option>
                        <option value="judicial">Judicial</option>
                    </select>

                    <label for="cirurgiaoDefinido">Tem cirurgião definido?</label>
                    <select id="cirurgiaoDefinido" name="cirurgiaoDefinido" onchange="toggleCirurgiao()">
                        <option value="indefinido">Selecione...</option>
                        <option value="nao">Não</option>
                        <option value="sim">Sim</option>
                    </select>        

                    <div class="hidden" id="dadosCirurgiao">                        
                        <h3>Dados do Cirurgião</h3>
                        <label for="nomeCirurgiao">Nome Completo</label>
                        <input type="text" id="nomeCirurgiao" name="nomeCirurgiao">
                    </div> 

                    <label for="tipoOrcamento">Tipo de Orçamento</label>
                    <select id="tipoOrcamento" name="tipoOrcamento" onchange="mostrarInfoProcedimentos()" required>
                        <option value="nao">Selecione...</option>
                        <option value="cirurgia">Cirurgia</option>
                        <option value="parto">Parto e Maternidade</option>
                    </select>
                    
                    <button type="button" class="btn btn-secondary" onclick="navigateTo('geral', 'solicitante')">Voltar</button>
                    <button type="button" class="btn btn-primary" disabled id="detalhes-button" onclick="navigateTo('geral', 'detalhes')">Prosseguir</button>
                </div>

                <div class="tab-pane fade" id="detalhes-tab-pane" role="tabpanel" aria-labelledby="detalhes-tab" tabindex="0">

                    <!-- Parto -->

                    <div class="hidden" id="divParto">
                        <br>
                        <h1>Tipo de Procedimento: Parto</h1>
                        <label for="tipoParto">Tipo de Parto</label>
                        <select id="tipoParto" name="tipoParto">
                            <option value="indefinido">Selecione...</option>
                            <option value="normal">Parto Normal</option>
                            <option value="cesarea">Cesárea</option>
                        </select>
                    </div>

                    <!-- Cirurgia -->
                    
                    <div class="hidden" id="divCirurgia">
                        <br>
                        <h1>Tipo de Procedimento: Cirurgia</h1>
                        <label for="descSumaria">Descrição Sumária do Procedimento</label>
                        <textarea id="descSumaria" name="descSumaria"></textarea>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Envio da Solicitação</label>
                            <input class="form-control" type="file" id="arquivo_solicitacao" name="arquivo_solicitacao">
                        </div>
                        
                    </div>

                    <label for="urgenteImediato">Urgente/Imediato?</label>
                    <select id="urgenteImediato" name="urgenteImediato">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>

                    <label for="dataProvavel">Data Provável</label>
                    <input type="date" id="dataProvavel" name="dataProvavel">

                    <label for="observacoes">Observações Adicionais</label>
                    <textarea id="observacoes" name="observacoes"></textarea>

                    <button type="button" class="btn btn-secondary" onclick="navigateTo('detalhes', 'geral')">Voltar</button>

                    <button type="submit" name="enviarFormulario" class="btn btn-success">Enviar</button>

                    

                </div>           

            </div>
        </form>
    </div>  
    <script>

        function toggleCirurgiao() {
            const cirurgiaoDefinido = document.getElementById("cirurgiaoDefinido").value;
            const dadosCirurgiao = document.getElementById("dadosCirurgiao");
        
            if (cirurgiaoDefinido === "sim") {
            dadosCirurgiao.classList.remove("hidden");
            } else {
            dadosCirurgiao.classList.add("hidden");
            }
        }

   

        function toggleComorbidades() {
            const comorbidades = document.getElementById("comorbidades").value;
            const descricaoComorbidades = document.getElementById("descricaoComorbidades");
        
            if (comorbidades === "sim") {
                descricaoComorbidades.classList.remove("hidden");
            } else {
                descricaoComorbidades.classList.add("hidden");
            }
        }

        function mostrarInfoProcedimentos() {
            const tipoOrcamento = document.getElementById("tipoOrcamento").value;
            const infoProcedimentos = document.getElementById("detalhes-tab");
            const infoParto = document.getElementById("divParto");
            const infoCirurgia = document.getElementById("divCirurgia");
            const detalhesButton = document.getElementById("detalhes-button") ;
     
            if (tipoOrcamento === "nao") {
                infoProcedimentos.classList.add("disabled");
                detalhesButton.disabled = true;

            } else {
                infoProcedimentos.classList.remove("disabled");
                detalhesButton.disabled = false;
            }

            if (tipoOrcamento === "parto") {                
                infoCirurgia.classList.add("hidden");              
                infoParto.classList.remove("hidden");
            }
            

            if (tipoOrcamento === "cirurgia") {
                infoParto.classList.add("hidden"); 
                infoCirurgia.classList.remove("hidden");
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





//        document.addEventListener('DOMContentLoaded', function () {
//           const alertElement = document.querySelector('.alert');
//            if (alertElement) {
//                setTimeout(() => {
//                  alertElement.style.display = 'none';
//                }, 5000);
//            }
//        });

    </script>
</body>
</html>
