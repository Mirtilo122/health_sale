<h4>Informações da Solicitação</h4><br>
<div class="row mt-1 d-flex">

    <div class="col-md-4 border-end border-grey">
        <label for="tipoOrcamento">Tipo de Orçamento:</label>
        <div class="select_alterar">
            <input type="hidden" id="tipo_orcamentoHidden" name="tipo_orcamento" value="{{ $dados->tipo_orcamento}}">
            <select id="tipo_orcamento" name="tipoOrcamento" onchange="atualizarHidden('tipo_orcamento')" disabled>
                <option value="cirurgia" @selected($dados->tipo_orcamento === "cirurgia")>Cirurgia</option>
                <option value="parto" @selected($dados->tipo_orcamento === "parto")>Parto</option>
                <option value="homecare" @selected($dados->tipo_orcamento === "homecare")>Home Care</option>
                <option value="remocao" @selected($dados->tipo_orcamento === "remocao")>Remoção</option>
                <option value="leito" @selected($dados->tipo_orcamento === "leito")>Leito UTI</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('tipoOrcamento')">Alterar</button>
        </div>

        <input type="hidden" id="urgencia" name="urgencia" value="{{ $dados->urgencia}}">

        <label for="convenio">Convenio:</label>
        <div class="select_alterar">
            <input type="hidden" id="convenioHidden" name="convenio" value="{{ $dados->convenio}}">
            <select id="convenio" name="convenioSelect" onchange="atualizarHidden('convenio')" disabled>
                <option value="nenhum" @selected($dados->convenio === "nenhum")>Nenhum</option>
                <option value="judicial" @selected($dados->convenio === "judicial")>Judicial</option>
                <option value="luzvida" @selected($dados->convenio === "luzvida")>Luz e Vida</option>
                <option value="particular" @selected($dados->convenio === "particular")>Particular</option>
                <option value="particular" @selected($dados->convenio === "particularpacote")>Particular Pacote</option>
                <option value="particular" @selected($dados->convenio === "sinopaz")>Sinopaz/Primavera</option>
                <option value="viva" @selected($dados->convenio === "viva")>Viva</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('convenio')">Alterar</button>
        </div>

        <p><strong>Data de Solicitação:</strong> {{ \Carbon\Carbon::parse($dados->data_solicitacao)->format('d/m/Y H:i') }}</p>

        <p><strong>Origem do Orçamento:</strong> {{$dados->origem_orcamento === 'site' ? 'Site' : $dados->origem_orcamento}}</p>
        <input type="hidden" name="origem_orcamento" value="{{ $dados->origem_orcamento }}">

        <p><strong>Protocolo:</strong> {{$dados->protocolo}}</p>
        <input type="hidden" name="protocolo" value="{{ $dados->protocolo }}">

        <label for="cirurgiao">Tem cirurgião definido?</label>
        <div class="select_alterar">
            <input type="hidden" id="cirurgiaoHidden" name="cirurgiao" value="{{ $dados->cirurgiao}}">
            <select id="cirurgiao" name="cirurgiaoSelect" onchange="toggleCirurgiaoAdmin(); atualizarHidden('cirurgiao')" disabled>
                <option value="nao" @selected($dados->cirurgiao === "nao")>Não</option>
                <option value="sim" @selected($dados->cirurgiao === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('cirurgiao')">Alterar</button>
        </div>
        <div id="cirurgiaoInfo" class="{{ $dados->cirurgiao === 'sim' ? '' : 'd-none' }}">
            <label for="nomeCirurgiao">Nome do Cirurgião:</label>
            <input type="text" id="nomeCirurgiao" name="nome_cirurgiao" value="{{$dados->nome_cirurgiao}}">

            <label for="crmCirurgiao">CRM:</label>
            <input type="text" id="crmCirurgiao" name="crm_cirurgiao" value="{{$dados->crm_cirurgiao}}">
        </div>
    </div>

    <div class="col-md-4">
        <p><strong>Resumo do Procedimento:</strong></p>
        <textarea name="resumoProcedimento" id="resumo_procedimento" rows="4">{{$dados->resumo_procedimento}}</textarea>


        <p><strong>Detalhes do Procedimento:</strong></p>
        <textarea name="detalhesProcedimento" id="detalhes_procedimento" rows="4">{{$dados->detalhes_procedimento}}</textarea>

        <label for="data_provavel">Data Provável:</label>
        <div class="input-container">
            <input type="text" id="data_provavel"
                placeholder="DD/MM/AAAA"
                value="{{$dados->data_provavel}}"
                oninput="formatDate(this)"/>
            <input type="date" id="hidden-data_provavel"
                name="data_provavel"
                value="{{$dados->data_provavel}}"
                style="display: none;"/>
            <button type="button" class="calendar-button" title="Clique para abrir o calendário"
                    onclick="openDatePicker('data_provavel')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>

    </div>
    <div class="col-md-4 border-end border-grey">

    @if($dados->tempo_cirurgia == 0)
            <p><strong>Tempo Cirúrgico Previsto:</strong> Não Informado</p>
        @else
            <p><strong>Tempo Cirúrgico Previsto:</strong> {{$dados->tempo_cirurgia}} Horas</p>
        @endif

        <p><strong>Anestesias Selecionadas:</strong></p>

        @php
            $anestesias = [];

            if ($dados->anestesia_raqui) $anestesias[] = 'Raquianestesia';
            if ($dados->anestesia_sma) $anestesias[] = 'SMA (Sedação + Monitorização Anestésica)';
            if ($dados->anestesia_peridural) $anestesias[] = 'Peridural';
            if ($dados->anestesia_sedacao) $anestesias[] = 'Sedação';
            if ($dados->anestesia_externo) $anestesias[] = 'Anestesia Externa';
            if ($dados->anestesia_bloqueio) $anestesias[] = 'Bloqueio';
            if ($dados->anestesia_local) $anestesias[] = 'Anestesia Local';
            if (!empty($dados->anestesia_outros)) $anestesias[] = $dados->anestesia_outros;

            $diarias = [];
            if ($dados->diarias_enfermaria > 0) $diarias[] = "Enfermaria: {$dados->diarias_enfermaria} diária(s)";
            if ($dados->diarias_apartamento > 0) $diarias[] = "Apartamento: {$dados->diarias_apartamento} diária(s)";
            if ($dados->diarias_uti > 0) $diarias[] = "UTI: {$dados->diarias_uti} diária(s)";
        @endphp

        @if (!empty($anestesias))
            <ul>
                @foreach ($anestesias as $anestesia)
                    <li>{{ $anestesia }}</li>
                @endforeach
            </ul>
        @else
            <p>Nenhuma anestesia selecionada.</p>
        @endif

        <br>

        <p><strong>Diárias Selecionadas:</strong></p>

        @if (!empty($diarias))
            <h3>Diárias</h3>
            <ul>
                @foreach ($diarias as $diaria)
                    <li>{{ $diaria }}</li>
                @endforeach
            </ul>
        @else
            <p>Nenhuma diária selecionada.</p>
        @endif

        <br>

        <p class="text-info d-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
            <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg> As anestesias e diárias apresentadas foram informadas pelo cliente, elas ainda devem ser inserdas no campo de Procedimentos caso seja necessário
        </p>

    </div>

</div>
