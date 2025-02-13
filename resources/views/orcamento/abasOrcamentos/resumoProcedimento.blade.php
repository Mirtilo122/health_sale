<h5>Informações do Paciente</h5>

<div class="row d-flex flex-direction-row">
    <div class="col-8 flex-fill">
        <label for="nome_paciente">Nome do Paciente:</label>
        <input type="text" name="nome_paciente" id="nome_paciente" value="{{$solicitacao->nome_paciente}}">
    </div>

    <div class="col-2 flex-fill">
        <label for="dataNascPaciente">Data de Nascimento:</label>
        <input type="date" id="dataNascPaciente" name="data_nascimento" value="{{$solicitacao->data_nascimento}}" required>
    </div>

    <div class="col-2 flex-fill">
        <label for="cidadePaciente">Cidade:</label>
        <input type="text" id="cidadePaciente" name="cidade" value="{{$solicitacao->cidade}}" required>
    </div>
</div>

<div class="row d-flex flex-direction-row">
    <div class="col-2 flex-fill">
        <label for="comorbidades">Paciente tem Comorbidades?</label>
        <div class="select_alterar">
            <input type="hidden" id="comorbidadesHidden" name="comorbidades" value="{{ $solicitacao->comorbidades }}">
            <select id="comorbidades" name="comorbidadesPaciente" onchange="toggleComorbidades(); atualizarHidden('comorbidade')" disabled>
                <option value="nao" @selected($solicitacao->comorbidades === "nao")>Não</option>
                <option value="sim" @selected($solicitacao->comorbidades === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('comorbidades')">Alterar</button>
        </div>
    </div>

    <div class="col-10 flex-fill">
        <div id="comorbidade" class="{{ $solicitacao->comorbidades === 'sim' ? '' : 'd-none' }}">
            <label for="descComorbidades">Descrição das Comorbidades:</label>
            <input type="text" id="descComorbidades" name="descricao_comorbidades" value="{{$solicitacao->descricao_comorbidades}}"></input>
        </div>
    </div>
</div>

<h5 class="mt-4">Informações do Procedimento</h5>

<div class="row d-flex flex-direction-row">
    <div class="col-10 flex-fill">
        <p><strong>Resumo do Procedimento:</strong></p>
        <input type="text" name="resumoProcedimento" id="resumo_procedimento" value="{{$solicitacao->resumo_procedimento}}"></input>
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Tempo Previsto Em Horas:</label>
        <input type="number" id="tempo_cirurgia" name="tempo_cirurgia" value="{{$solicitacao->tempo_cirurgia}}" step="0.5">
    </div>
</div>

<div class="row d-flex flex-direction-row">
    <div class="col-10 flex-fill">
        <p><strong>Detalhes do Procedimento:</strong></p>
        <input type="text" name="detalhesProcedimento" id="detalhes_procedimento" value="{{$solicitacao->detalhes_procedimento}}"></input>
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Data Provável:</label>
        <input type="date" id="data_provavel" name="data_provavel" value="{{$solicitacao->data_provavel}}">
    </div>
</div>

<h5 class="mt-4">Acomodações e Procedimentos TUSS</h5>
<br>
<div class="row d-flex flex-direction-row">
    <div class="col-4 flex-fill d-flex gap-4">
        <p>Enfermaria:</p>
        <input type="number" id="diarias_enfermaria" name="diarias_enfermaria" value="{{$solicitacao->diarias_enfermaria}}" class="w-25">
    </div>

    <div class="col-4 flex-fill d-flex gap-4">
        <p>Apartamento</p>
        <input type="number" id="diarias_apartamento" name="diarias_apartamento" value="{{$solicitacao->diarias_apartamento}}" class="w-25">
    </div>

    <div class="col-4 flex-fill d-flex gap-4">
        <p>Diárias UTI</p>
        <input type="number" id="diarias_uti" name="diarias_uti" value="{{$solicitacao->diarias_uti}}" class="w-25">
    </div>
</div>
<br>

<div class="row d-flex flex-direction-row">
    <div class="col-2 flex-fill d-flex">
        <p>Procedimento Principal:</p>
    </div>

    <div class="col-3 flex-fill d-flex">
        <input type="number" id="cod_tuss_principal" name="cod_tuss_principal" value="{{$orcamento->cod_tuss_principal ?? 0}}" placeholder="Insira o Código TUSS...">
    </div>

    <div class="col-6 flex-fill d-flex">
        <input type="text" id="procedimento_principal" name="procedimento_principal" value="{{$orcamento->procedimento_principal ?? ''}}" placeholder="Insira o Procedimento...">
    </div>

    <div class="col-1 flex-fill d-flex">
    </div>
</div>

<input type="hidden" name="procedimentos_json" id="procedimentos_json">

<br>

<div id="procedimentos-container">

</div>

<button type="button" class="alterar-btn" onclick="adicionarSecundario()">Adicionar Procedimento Secundário</button>











