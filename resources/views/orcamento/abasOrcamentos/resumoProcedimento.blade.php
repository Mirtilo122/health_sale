<h5>Informações do Paciente</h5>

<div class="row d-flex flex-direction-row">
    <div class="col-8 flex-fill">
        <label for="nome_paciente">Nome do Paciente:</label>
        <input type="text" name="nome_paciente" id="nome_paciente" value="{{$dados->nome_paciente}}">
    </div>

    <div class="col-2 flex-fill">
        <label for="dataNascPaciente">Data de Nascimento:</label>
        <div class="input-container">
            <input type="text" id="dataNascPaciente"
                placeholder="DD/MM/AAAA"
                value="{{ \Carbon\Carbon::parse($dados->data_nascimento)->format('d/m/Y') }}"
                oninput="formatDate(this)"/>
            <input type="date" id="hidden-dataNascPaciente"
                name="data_nascimento"
                value="{{ $dados->data_nascimento }}"
                style="display: none;" required/>
            <button type="button" class="calendar-button" title="Clique para abrir o calendário"
                    onclick="openDatePicker('dataNascPaciente')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="col-2 flex-fill">
        <label for="cidadePaciente">Cidade:</label>
        <input type="text" id="cidadePaciente" name="cidade" value="{{$dados->cidade}}" required>
    </div>
</div>

<div class="row d-flex flex-direction-row">
    <div class="col-2 flex-fill">
        <label for="comorbidades">Paciente tem Comorbidades?</label>
        <div class="select_alterar">
            <input type="hidden" id="comorbidadesHidden" name="comorbidades" value="{{ $dados->comorbidades }}">
            <select id="comorbidades" name="comorbidadesPaciente" onchange="toggleComorbidadesAdmin(); atualizarHidden('comorbidade')" disabled>
                <option value="nao" @selected($dados->comorbidades === "nao")>Não</option>
                <option value="sim" @selected($dados->comorbidades === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('comorbidades')">Alterar</button>
        </div>
    </div>

    <div class="col-10 flex-fill">
        <div id="comorbidade" class="{{ $dados->comorbidades === 'sim' ? '' : 'd-none' }}">
            <label for="descComorbidades">Descrição das Comorbidades:</label>
            <input type="text" id="descComorbidades" name="descricao_comorbidades" value="{{$dados->descricao_comorbidades}}"></input>
        </div>
    </div>
</div>

<h5 class="mt-4">Informações do Procedimento</h5>

<div class="row d-flex flex-direction-row">
    <div class="col-10 flex-fill">
        <p><strong>Resumo do Procedimento:</strong></p>
        <input type="text" class="resumo_procedimento" id="resumo_procedimento" value="{{$dados->resumo_procedimento}}"></input>
    </div>
    <div class="col-2 flex-fill">
        <label for="tempo_cirurgia">Tempo Previsto Em Horas:</label>
        <input type="number" id="tempo_cirurgia" class="tempo_cirurgia" value="{{$dados->tempo_cirurgia}}" step="0.5">
    </div>
</div>

<div class="row d-flex flex-direction-row">
    <div class="col-10 flex-fill">
        <p><strong>Detalhes do Procedimento:</strong></p>
        <input type="text" id="detalhes_procedimento" class="detalhesProcedimento" value="{{$dados->detalhes_procedimento}}"></input>
    </div>
    <!--
    <div class="col-2 flex-fill">
        <label for="data_provavel">Data Provável:</label>
        <div class="input-container">
            <input type="text" class="sync-date" id="data_provavel"
                placeholder="DD/MM/AAAA"
                value="{{ $dados->data_provavel ? \Carbon\Carbon::parse($dados->data_provavel)->timezone(config('app.timezone'))->format('d/m/Y') : '' }}"
                oninput="formatDate(this)"/>
            <input type="date" id="hidden-data_provavel" class="sync-date"
            value="{{ $dados->data_provavel ? \Carbon\Carbon::parse($dados->data_provavel)->timezone(config('app.timezone'))->format('Y-m-d') : '' }}"
            style="display: none;">
            <button type="button" class="calendar-button" title="Clique para abrir o calendário"
                    onclick="openDatePicker('data_provavel')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>
    </div>
    -->
</div>

<h5 class="mt-4">Acomodações e Procedimentos TUSS</h5>
<br>
<div class="row d-flex flex-direction-row">
    <div class="col-4 flex-fill d-flex gap-4">
        <p>Enfermaria:</p>
        <input type="number" class="diarias_enfermaria" id="diarias_enfermaria" value="{{$dados->diarias_enfermaria}}" class="w-25">
    </div>

    <div class="col-4 flex-fill d-flex gap-4">
        <p>Apartamento</p>
        <input type="number" class="diarias_apartamento" id="diarias_apartamento" value="{{$dados->diarias_apartamento}}" class="w-25">
    </div>

    <div class="col-4 flex-fill d-flex gap-4">
        <p>Diárias UTI</p>
        <input type="number" class="diarias_uti" id="diarias_uti" value="{{$dados->diarias_uti}}" class="w-25">
    </div>
</div>
<br>

<div class="row d-flex flex-direction-row">
    <div class="col-2 flex-fill d-flex">
        <p>Procedimento Principal:</p>
    </div>

    <div class="col-3 flex-fill d-flex">
        <input type="text" id="cod_tuss_principal" name="cod_tuss_principal" value="{{$orcamento->cod_tuss_principal ?? ''}}" placeholder="Insira o Código TUSS..." autocomplete="off" class="form-control">
        <div id="cod_tuss_suggestions" class="autocomplete-suggestions"></div>
    </div>

    <div class="col-6 flex-fill d-flex">
        <input type="text" id="procedimento_principal" name="procedimento_principal" value="{{$orcamento->procedimento_principal ?? ''}}" placeholder="Insira a Descrição do Procedimento..." autocomplete="off" class="form-control">
        <div id="procedimento_suggestions" class="autocomplete-suggestions"></div>
    </div>

    <div class="col-1 flex-fill d-flex">
    </div>
</div>

<input type="hidden" name="procedimentos_json" id="procedimentos_json">

<br>

<div id="procedimentos-container">

</div>

<button type="button" class="alterar-btn" onclick="adicionarSecundario()">Adicionar Procedimento Secundário</button>











