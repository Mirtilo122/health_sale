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
  <div class="form-container">
    <h1>Formulário de Solicitação por Paciente ou Resposável</h1>    

    <form class="formulario-abas" id="formRepresent" method="POST" action="processar_formulario.php" enctype="multipart/form-data">
        <input type="hidden" name="formulario" value="paciente">
        <input type="hidden" name="anestesia[]" value="">

        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="paciente-tab" data-bs-toggle="tab" data-bs-target="#paciente-tab-pane" type="button" role="tab" aria-controls="paciente-tab-pane" aria-selected="true">Informações do Paciente</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="solicitante-tab" data-bs-toggle="tab" data-bs-target="#solicitante-tab-pane" type="button" role="tab" aria-controls="solicitante-tab-pane" aria-selected="false">Informações do Solicitante</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="geral-tab" data-bs-toggle="tab" data-bs-target="#geral-tab-pane" type="button" role="tab" aria-controls="geral-tab-pane" aria-selected="false">Informações Gerais do Orçamento</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link disabled" id="detalhes-tab" data-bs-toggle="tab" data-bs-target="#detalhes-tab-pane" type="button" role="tab" aria-controls="detalhes-tab-pane" aria-selected="false">Informações do Procedimento</button>
            </li>
        </ul>            

            <div class="tab-content" id="myTabContent">

                <!-- Paciente -->

                <div class="tab-pane fade show active" id="paciente-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="teste">

                    <label for="nomePaciente">Nome do Paciente</label>
                    <input type="text" id="nomePaciente" name="nomePaciente">

                    <label for="dataNasc">Data de Nascimento</label>
                    <input type="date" id="dataNasc" name="dataNasc" required>

                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade">

                    <label for="comorbidades">Paciente tem Comorbidades?</label>
                    <select id="comorbidades" name="comorbidades" onchange="toggleComorbidades()">
                        <option value="nao">Selecione...</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>

                    <div class="textareadiv; hidden" id="descricaoComorbidades">
                        <label for="descComorbidades">Descrever as Comorbidades</label>
                        <textarea id="descComorbidades" name="descComorbidades"  rows="10" cols="50"></textarea>
                    </div>

                </div>
                </div>

                <!-- Solicitante -->

                <div class="tab-pane fade" id="solicitante-tab-pane" role="tabpanel" aria-labelledby="solicitante-tab" tabindex="0">

                    <label for="nome">Nome do Solicitante</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="nome">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" required>
                    
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" required>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="contato">Canal de Preferência para Contato</label>
                    <select id="contato" name="contato">
                    <option value="telefone">Telefone</option>
                    <option value="email">Email</option>
                    </select>

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
                    </select>
                        <select id="cirurgiaoDefinido" name="cirurgiaoDefinido" onchange="toggleCirurgiao()">
                        <option value="">Selecione...</option>
                        <option value="nao">Não</option>
                        <option value="sim">Sim</option>
                    </select>        

                    <div class="hidden" id="dadosCirurgiao">                        
                        <h3>Dados do Cirurgião</h3>
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome">
                        
                        <label for="telefoneCirurgiao">Telefone</label>
                        <input type="tel" id="telefone" name="telefone">
                        
                        <label for="emailCirurgiao">Email</label>
                        <input type="email" id="email" name="email">
                        
                        <label for="crmCirurgiao">CRM</label>
                        <input type="crmCirurgiao" id="crmCirurgiao" name="crmCirurgiao">
                    </div> 



                    <label for="tipoOrcamento">Tipo de Orçamento</label>
                    <select id="tipoOrcamento" name="tipoOrcamento" onchange="mostrarInfoProcedimentos()" required>
                        <option value="nao">Selecione...</option>
                        <option value="cirurgia">Cirurgia</option>
                        <option value="parto">Parto e Maternidade</option>
                    </select>

                    <div class="upload">
                        <h2>Envio da Solicitação</h2>
                        <label>Arquivo</label>
                        <input type="file" name="arquivo_solicitacao"><br><br>
                    </div>

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

                    <button type="submit" name="enviarFormulario" class="submit-btn">Enviar</button>

                    

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
     
            if (tipoOrcamento === "nao") {
                infoProcedimentos.classList.add("disabled");
            } else {
                infoProcedimentos.classList.remove("disabled");
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

   
    
    </script>
</body>
</html>
