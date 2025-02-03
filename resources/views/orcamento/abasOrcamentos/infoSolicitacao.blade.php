<h4>Informações da Solicitação</h4><br>
<div class="row mt-1 d-flex">

    <div class="col-md-4 border-end border-grey">
        <label for="solicitante">Solicitante:</label>
        <div class="select_alterar">
        <select id="solicitante" name="solicitante" disabled>
            <option value="paciente" @selected($solicitacao->solicitante === "paciente")>Paciente ou Representante</option>
            <option value="medico" @selected($solicitacao->solicitante === "medico")>Médico</option>
        </select>
        <button type="button" class="alterar-btn" onclick="alterar('solicitante')">Alterar</button>
        </div><br><br>

        <label for="nomeSolicitante">Nome do Solicitante:</label>
        <input type="text" id="nomeSolicitante" name="nomeSolicitante" value="{{$solicitacao->nome_solicitante}}"><br><br>

        <label for="canalContato">Canal de Preferência de Contato:</label>
        <div class="select_alterar">
            <select id="canalContato" name="canalContato" disabled>
                <option value="telefone" @selected($solicitacao->canal_contato === "telefone")>Telefone</option>
                <option value="email" @selected($solicitacao->canal_contato === "email")>E-mail</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('canalContato')">Alterar</button>
        </div><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="{{$solicitacao->telefone}}"><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="{{$solicitacao->email}}"><br><br>
    </div>

    <div class="col-md-4 border-end border-grey">
        <label for="tipoOrcamento">Tipo de Orçamento:</label>
        <div class="select_alterar">
            <select id="tipoOrcamento" name="tipoOrcamento" disabled>
                <option value="cirurgia" @selected($solicitacao->tipo_orcamento === "cirurgia")>Cirurgia</option>
                <option value="parto" @selected($solicitacao->tipo_orcamento === "parto")>Parto</option>
                <option value="homecare" @selected($solicitacao->tipo_orcamento === "homecare")>Home Care</option>
                <option value="remocao" @selected($solicitacao->tipo_orcamento === "remocao")>Remoção</option>
                <option value="leito" @selected($solicitacao->tipo_orcamento === "leito")>Leito UTI</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('tipoOrcamento')">Alterar</button>
        </div><br>

        <label for="convenio">Convenio:</label>
        <div class="select_alterar">
            <select id="convenio" name="convenio" disabled>
                <option value="cirurgia" @selected($solicitacao->tipo_orcamento === "cirurgia")>Cirurgia</option>
                <option value="parto" @selected($solicitacao->tipo_orcamento === "parto")>Parto</option>
                <option value="homecare" @selected($solicitacao->tipo_orcamento === "homecare")>Home Care</option>
                <option value="remocao" @selected($solicitacao->tipo_orcamento === "remocao")>Remoção</option>
                <option value="leito" @selected($solicitacao->tipo_orcamento === "leito")>Leito UTI</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('convenio')">Alterar</button>
        </div><br>

        <p><strong>Data de Solicitação:</strong> {{ \Carbon\Carbon::parse($solicitacao->data_solicitacao)->format('d/m/Y H:i') }}</p><br>

        <p><strong>Origem do Orçamento:</strong> {{$solicitacao->origem_orcamento === 'site' ? 'Site' : $solicitacao->origem_orcamento}}</p><br>

        <p><strong>Protocolo:</strong> {{$solicitacao->protocolo}}</p><br>
    </div>

    <div class="col-md-4">
        <label for="cirurgiaoDefinido">Tem cirurgião definido?</label>
        <div class="select_alterar">
            <select id="cirurgiaoDefinido" name="cirurgiaoDefinido" onchange="toggleCirurgiao()" disabled>
                <option value="nao" @selected($solicitacao->cirurgiao === "nao")>Não</option>
                <option value="sim" @selected($solicitacao->cirurgiao === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('cirurgiaoDefinido')">Alterar</button>
        </div><br><br>
        <div id="cirurgiaoInfo" class="{{ $solicitacao->cirurgiao === 'sim' ? '' : 'd-none' }}">
            <label for="nomeCirurgiao">Nome do Cirurgião:</label>
            <input type="text" id="nomeCirurgiao" name="nomeCirurgiao" value="{{$solicitacao->nome_cirurgiao}}"><br><br>

            <label for="crmCirurgiao">CRM:</label>
            <input type="text" id="crmCirurgiao" name="crmCirurgiao" value="{{$solicitacao->crm_cirurgiao}}"><br><br>
        </div>
    </div>

</div>
