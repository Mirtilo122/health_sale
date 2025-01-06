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


<form id="formMedico" method="POST" action="processar_formulario.php" enctype="multipart/form-data">
        <input type="hidden" name="formulario" value="medico">
       
        <div>
            <label for="nome">Nome do Solicitante</label>
            <input type="text" id="nome" name="nome" required>

            <label for="sobrenome">Sobrenome</label>
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

            <label for="tipoOrcamento">Tipo de Orçamento</label>
            <select id="tipoOrcamento" name="tipoOrcamento">
                <option value="cirurgia">Cirurgia</option>
                <option value="parto">Parto e Maternidade</option>
            </select>
            

            <label for="convenio">Convênio</label>
            <select id="convenio" name="convenio">
                <option value="nenhum">Sem Convênio</option>
                <option value="particular">Particular</option>
                <option value="cartaoDesconto">Cartão Desconto</option>
                <option value="judicial">Judicial</option>
            </select>
        </div>

        <div>
            <h3>Informações do Paciente</h3>
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

            <div class="hidden" id="descricaoComorbidades">
                <label for="descComorbidades">Descrever as Comorbidades</claslabel>
                <textarea id="descComorbidades" name="descComorbidades"></textarea>
            </div>
        </div>

        <div>

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
            
        </div>

       

        <div>
            <h3>Informações do Procedimento</h3>

            <label for="descSumaria">Descrição Sumária do Procedimento</label>
            <textarea id="descSumaria" name="descSumaria"></textarea>

            <label for="descDetalhada">Descrição Detalhada do Procedimento</label>
            <textarea id="descDetalhada" name="descDetalhada"></textarea>

            <label for="tempoCirurgico">Tempo Cirúrgico Previsto (em horas)</label>
            <input type="number" id="tempoCirurgico" name="tempoCirurgico" min="0" step="0.5">

            <label for="dataProvavel">Data Provável</label>
            <input type="date" id="dataProvavel" name="dataProvavel">

            <label for="urgenteImediato">Urgente/Imediato?</label>
            <select id="urgenteImediato" name="urgenteImediato">
                <option value="">Selecione...</option>
                <option value="nao">Não</option>
                <option value="sim">Sim</option>
            </select>
        </div>


        <div>
            <h3>Definição das Acomodações</h3>

            <label for="enfermaria">Enfermaria (Quantas diárias)</label>
            <input type="number" id="enfermaria" name="enfermaria" min="0">

            <label for="apartamento">Apartamento (Quantas diárias)</label>
            <input type="number" id="apartamento" name="apartamento" min="0">

            <label for="utiAdulto">UTI Adulto (Quantas diárias)</label>
            <input type="number" id="utiAdulto" name="utiAdulto" min="0">
        </div>


        <div>
            <h3>Anestesia</h3>

            <label><input type="checkbox" name="anestesia[]" value="raqui"> Raqui</label><br>
            <label><input type="checkbox" name="anestesia[]" value="sma"> SMA</label><br>
            <label><input type="checkbox" name="anestesia[]" value="peridural"> Peridural</label><br>
            <label><input type="checkbox" name="anestesia[]" value="sedacao"> Sedação</label><br>
            <label><input type="checkbox" name="anestesia[]" value="externo"> Externo</label><br>
            <label><input type="checkbox" name="anestesia[]" value="bloqueio"> Bloqueio</label><br>
            <label><input type="checkbox" name="anestesia[]" value="local"> Local</label><br>
            <label>
                <input type="checkbox" name="anestesia[]" value="outros"> Outros:
                <input type="text" id="anestesiaOutros" name="anestesiaOutros" placeholder="Especifique">
            </label>
        </div>

        <div>
            <label for="observacoes">Observações Adicionais</label>
            <textarea id="observacoes" name="observacoes"></textarea>
        </div>

        <div class="upload">
            <h2>Envio da Solicitação</h2>
            <label for="arquivo_pdf">Solicitação (PDF):</label>
            <input type="file" id="arquivo_pdf" name="arquivo_solicitacao" accept=".pdf" required><br><br>
        </div>
      

     
        <button type="submit" name="enviarFormulario" class="submit-btn">Enviar</button>
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

  function toggleCirurgiaoo() {
    const cirurgiaoDefinido = document.getElementById("cirurgiaoDefinidoo").value;
    const dadosCirurgiao = document.getElementById("dadosCirurgiaoo");
  
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

  function toggleComorbidadess() {
    const comorbidades = document.getElementById("comorbidadess").value;
    const descricaoComorbidades = document.getElementById("descricaoComorbidadess");
  
    if (comorbidades === "sim") {
        descricaoComorbidades.classList.remove("hidden");
    } else {
        descricaoComorbidades.classList.add("hidden");
    }
  }
  
  </script>
</body>
</html>
