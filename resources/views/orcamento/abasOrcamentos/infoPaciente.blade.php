<h4>Informações do Paciente</h4>
<div class="row mt-1 d-flex">
    <div class="col-md-4 border-end border-grey">
        <label for="nome_paciente">Nome do Paciente:</label>
        <input type="text" name="nome_paciente" id="nome_paciente" value="{{$solicitacao->nome_paciente}}">

        <label for="dataNascPaciente">Data de Nascimento:</label>
        <div class="input-container">
            <input type="text" id="dataNascPaciente"
                placeholder="DD/MM/AAAA"
                value="{{ \Carbon\Carbon::parse($solicitacao->data_nascimento)->format('d/m/Y') }}"
                oninput="formatDate(this)">
            <input type="date" id="hidden-dataNascPaciente"
                name="data_nascimento"
                value="{{$solicitacao->data_nascimento}}"
                style="display: none;" required>
            <button type="button" class="calendar-button" title="Clique para abrir o calendário"
                    onclick="openDatePicker('dataNascPaciente')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>

        <label for="cidadePaciente">Cidade:</label>
        <input type="text" id="cidadePaciente" name="cidade" value="{{$solicitacao->cidade}}" required>
    </div>

    <div class="col-md-4 border-end border-grey">
        <label for="comorbidades">Paciente tem Comorbidades?</label>
        <div class="select_alterar">
            <input type="hidden" id="comorbidadesHidden" name="comorbidades" value="{{ $solicitacao->comorbidades }}">
            <select id="comorbidades" name="comorbidadesPaciente" onchange="toggleComorbidadesAdmin(); atualizarHidden('comorbidades')" disabled>
                <option value="nao" @selected($solicitacao->comorbidades === "nao")>Não</option>
                <option value="sim" @selected($solicitacao->comorbidades === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('comorbidadesPaciente')">Alterar</button>
        </div>


        <div id="comorbidade" class="{{ $solicitacao->comorbidades === 'sim' ? '' : 'd-none' }}">
            <label for="descComorbidades">Descrição das Comorbidades:</label>
            <textarea id="descComorbidades" name="descricao_comorbidades" rows="4" value="{{$solicitacao->descricao_comorbidades}}"></textarea>
        </div>

        <label for="observacoesPaciente">Observações:</label>
        <textarea id="observacoesPaciente" name="observacoes_adicionais" rows="4" value="{{$solicitacao->observacoes_adicionais}}"></textarea>
    </div>

    <div class="col-md-4">

        <label for="solicitante">Solicitante:</label>
        <div class="select_alterar">
        <input type="hidden" id="solicitanteHidden" name="solicitante" value="{{ $solicitacao->solicitante }}">
        <select id="solicitante" name="solicitanteOrcamento" onchange="atualizarHidden('solicitante')" disabled>
            <option value="paciente" @selected($solicitacao->solicitante === "paciente")>Paciente ou Representante</option>
            <option value="medico" @selected($solicitacao->solicitante === "medico")>Médico</option>
        </select>
        <button type="button" class="alterar-btn" onclick="alterar('solicitante')">Alterar</button>
        </div>

        <label for="nomeSolicitante">Nome do Solicitante:</label>
        <input type="text" id="nomeSolicitante" name="nome_solicitante" value="{{$solicitacao->nome_solicitante}}">

        <label for="contato">Canal de Preferência de Contato:</label>
        <div class="select_alterar">
            <input type="hidden" id="contatoHidden" name="canal_contato" value="{{ $solicitacao->canal_contato }}">
            <select id="contato" name="contato" onchange="atualizarHidden('contato')" disabled>
                <option value="telefone" @selected($solicitacao->canal_contato === "telefone")>Telefone</option>
                <option value="email" @selected($solicitacao->canal_contato === "email")>E-mail</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('canalContato')">Alterar</button>
        </div>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="{{$solicitacao->telefone}}">

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="{{$solicitacao->email}}">

    </div>
</div>
