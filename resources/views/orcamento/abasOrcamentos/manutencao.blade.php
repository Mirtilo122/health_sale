<div class="row d-flex">
        <div class="col-auto flex-fill">
            <label for="nomeSolicitante">Nome do Solicitante:</label>
            <input type="text" id="nomeSolicitante" name="nome_solicitante" value="{{$solicitacao->nome_solicitante}}">
        </div>

        <div class="col-auto flex-fill">
            <label for="contato">Canal de Preferência de Contato:</label>
            <div class="select_alterar">
                <input type="hidden" id="contatoHidden" name="canal_contato" value="{{ $solicitacao->canal_contato }}">
                <select id="contato" name="contato" onchange="atualizarHidden('contato')" disabled>
                    <option value="telefone" @selected($solicitacao->canal_contato === "telefone")>Telefone</option>
                    <option value="email" @selected($solicitacao->canal_contato === "email")>E-mail</option>
                </select>
                <button type="button" class="alterar-btn" onclick="alterar('canalContato')">Alterar</button>
            </div>
        </div>

        <div class="col-auto flex-fill">
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="{{$solicitacao->telefone}}">
        </div>

        <div class="col-auto flex-fill">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="{{$solicitacao->email}}">
        </div>
</div>

<div class="row d-flex mt-2 mb-2">
    <div class="col-auto flex-fill">
        <label for="status">Status:</label>
        <div class="select_alterar">
            <input type="hidden" id="statusHidden" name="status" value="{{ $solicitacao->status}}">
            <select name="statusSelect" id="status" onchange="atualizarHidden('status')" disabled>
                <option value="novo" {{ $solicitacao->status == "novo" ? 'selected' : '' }}>Novo</option>
                <option value="atribuido" {{ $solicitacao->status == "atribuido" ? 'selected' : '' }}>Atribuída</option>
                <option value="cirurgiao" {{ $solicitacao->status == "cirurgiao" ? 'selected' : '' }}>Retorno Cirurgião</option>
                <option value="anestesista" {{ $solicitacao->status == "anestesista" ? 'selected' : '' }}>Retorno Anestesista</option>
                <option value="criacao" {{ $solicitacao->status == "criacao"  ? 'selected' : '' }}>Retorno Responsável</option>
                <option value="liberacao" {{ $solicitacao->status == "liberacao"  ? 'selected' : '' }}>Em Liberação</option>
                <option value="negociacao" {{ $solicitacao->status == "negociacao"  ? "selected" : '' }}>Em Negociação</option>
                <option value="aprovado" {{ $solicitacao->status == "aprovado" ? "selected" : '' }}>Aprovado</option>
                <option value="perdido" {{ $solicitacao->status =="perdido" ? 'selected' : '' }}>Perdido</option>
                <option value="recusado" {{ $solicitacao->status == "recusado" ? 'selected' : '' }}>Recusado</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('status')">Alterar</button>
        </div>

        <label for="convenio">Convenio:</label>
        <div class="select_alterar">
            <input type="hidden" id="convenioHidden" name="convenio" value="{{ $solicitacao->convenio}}">
            <select id="convenio" name="convenioSelect" onchange="atualizarHidden('convenio')" disabled>
                <option value="nenhum" @selected($solicitacao->convenio === "nenhum")>Nenhum</option>
                <option value="judicial" @selected($solicitacao->convenio === "judicial")>Judicial</option>
                <option value="luzvida" @selected($solicitacao->convenio === "luzvida")>Luz e Vida</option>
                <option value="particular" @selected($solicitacao->convenio === "particular")>Particular</option>
                <option value="particular" @selected($solicitacao->convenio === "particularpacote")>Particular Pacote</option>
                <option value="particular" @selected($solicitacao->convenio === "sinopaz")>Sinopaz/Primavera</option>
                <option value="viva" @selected($solicitacao->convenio === "viva")>Viva</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('convenio')">Alterar</button>
        </div>

        <label for="observacoesPaciente">Observações:</label>
        <textarea id="observacoesPaciente" name="observacoes_adicionais" rows="4" value="{{$solicitacao->observacoes_adicionais}}"></textarea>

    </div>

    <div class="col-auto flex-fill">
        <label for="tipoOrcamento">Tipo de Orçamento:</label>
        <div class="select_alterar">
            <input type="hidden" id="tipo_orcamentoHidden" name="tipo_orcamento" value="{{ $solicitacao->tipo_orcamento}}">
            <select id="tipo_orcamento" name="tipoOrcamento" onchange="atualizarHidden('tipo_orcamento')" disabled>
                <option value="cirurgia" @selected($solicitacao->tipo_orcamento === "cirurgia")>Cirurgia</option>
                <option value="parto" @selected($solicitacao->tipo_orcamento === "parto")>Parto</option>
                <option value="homecare" @selected($solicitacao->tipo_orcamento === "homecare")>Home Care</option>
                <option value="remocao" @selected($solicitacao->tipo_orcamento === "remocao")>Remoção</option>
                <option value="leito" @selected($solicitacao->tipo_orcamento === "leito")>Leito UTI</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('tipoOrcamento')">Alterar</button>
        </div>

        <p><strong>Origem do Orçamento:</strong> {{$solicitacao->origem_orcamento === 'site' ? 'Site' : $solicitacao->origem_orcamento}}</p>
        <input type="hidden" name="origem_orcamento" value="{{ $solicitacao->origem_orcamento }}">


    </div>

    <div class="col-auto flex-fill">
        <label for="cirurgiao">Tem cirurgião definido?</label>
        <div class="select_alterar">
            <input type="hidden" id="cirurgiaoHidden" name="cirurgiao" value="{{ $solicitacao->cirurgiao}}">
            <select id="cirurgiao" name="cirurgiaoSelect" onchange="toggleCirurgiaoAdmin(); atualizarHidden('cirurgiao')" disabled>
                <option value="nao" @selected($solicitacao->cirurgiao === "nao")>Não</option>
                <option value="sim" @selected($solicitacao->cirurgiao === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('cirurgiao')">Alterar</button>
        </div>
        <div id="cirurgiaoInfo" class="{{ $solicitacao->cirurgiao === 'sim' ? '' : 'd-none' }}">
            <label for="nomeCirurgiao">Nome do Cirurgião:</label>
            <input type="text" id="nomeCirurgiao" name="nome_cirurgiao" value="{{$solicitacao->nome_cirurgiao}}">

            <label for="crmCirurgiao">CRM:</label>
            <input type="text" id="crmCirurgiao" name="crm_cirurgiao" value="{{$solicitacao->crm_cirurgiao}}">
        </div>

    </div>
</div>
