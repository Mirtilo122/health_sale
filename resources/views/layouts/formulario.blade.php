<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">

</head>
<body>

    <div id="alertError" class="alert alert-danger d-none" role="alert">
        Preencha todos os campos necessários!
    </div>

  <div class="form-container">

    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
        <a href="inicio" class="btn btn-sm btn-secondary">Voltar</a>
        <h1 class="flex-grow-1 text-center">@yield('nomeForm')</h1>
    </div>

    <form class="formulario-abas needs-validation" id="formRepresent" method="POST" action="/processarFormulario" enctype="multipart/form-data" novalidate>
    @csrf
    @yield('tipo')
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
                    <div class="input-container">
                        <input type="text" id="dataNasc" placeholder="DD/MM/AAAA" oninput="formatDate(this)">
                        <input type="date" name="dataNasc" id="hidden-dataNasc" style="display: none;" required>
                        <button type="button" class="calendar-button mb-3" title="Clique para abrir o calendário" onclick="openDatePicker('dataNasc')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                        </button>
                    </div>
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

                    <div class="textareadiv; d-none" id="descricaoComorbidades">
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
                        <option value="luzvida">Luz e Vida</option>
                        <option value="viva">Viva</option>
                        <option value="sinopaz">Sinopaz/Primavera</option>
                        <option value="judicial">Judicial</option>
                    </select>

                    <label for="cirurgiaoDefinido">Tem cirurgião definido?</label>
                    <select id="cirurgiaoDefinido" name="cirurgiaoDefinido" onchange="toggleCirurgiao()">
                        <option value="indefinido">Selecione...</option>
                        <option value="nao">Não</option>
                        <option value="sim">Sim</option>
                    </select>

                    @yield('cirurgiao')

                    <label for="tipoOrcamento">Tipo de Orçamento</label>
                    <select id="tipoOrcamento" name="tipoOrcamento" onchange="mostrarInfoProcedimentos()" required>
                        <option value="nao">Selecione...</option>
                        <option value="cirurgia">Cirurgia</option>
                        <option value="parto">Parto e Maternidade</option>
                        <option value="homecare">Home Care</option>
                        <option value="remocao">Remoção</option>
                        <option value="leito">Leito de Uti</option>
                    </select>

                    <button type="button" class="btn btn-secondary" onclick="navigateTo('geral', 'solicitante')">Voltar</button>
                    <button type="button" class="btn btn-primary" disabled id="detalhes-button" onclick="navigateTo('geral', 'detalhes')">Prosseguir</button>
                </div>

                <div class="tab-pane fade" id="detalhes-tab-pane" role="tabpanel" aria-labelledby="detalhes-tab" tabindex="0">

                    <!-- Parto -->

                    <div class="d-none" id="divParto">
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

                    <div class="d-none" id="divCirurgia">
                        <br>
                        <h1>Tipo de Procedimento: Cirurgia</h1>
                        <label for="descSumaria">Descrição Sumária do Procedimento</label>
                        <textarea id="descSumaria" name="descSumaria"></textarea>

                        @yield('descDetalhe')

                    </div>

                    <label for="urgenteImediato">Urgente/Imediato?</label>
                    <select id="urgenteImediato" name="urgenteImediato">
                        <option value="">Selecione...</option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>

                    <label for="dataProvavel">Data Provável</label>
                    <div class="input-container">
                        <input type="text" id="dataProvavel" placeholder="DD/MM/AAAA" oninput="formatDate(this)" />
                        <input type="date" id="hidden-dataProvavel" name="dataProvavel" style="display: none;">

                        <button type="button" class="calendar-button mb-3" title="Clique para abrir o calendário" onclick="openDatePicker('dataProvavel')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="mb-3">
                            <label for="formFile" class="form-label">Envio da Solicitação</label>
                            <input class="form-control" type="file" id="arquivo_solicitacao" name="arquivo_solicitacao">
                    </div>

                    @yield('maisInfo')

                    <label for="observacoes">Observações Adicionais</label>
                    <textarea id="observacoes" name="observacoes"></textarea>

                    <button type="button" class="btn btn-secondary" onclick="navigateTo('detalhes', 'geral')">Voltar</button>

                    <button type="submit" name="enviarFormulario" class="btn btn-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="/js/script.js"></script>
</body>
</html>
