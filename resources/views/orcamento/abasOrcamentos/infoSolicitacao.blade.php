<h4>Informações da Solicitação</h4><br>
<div class="row mt-1 d-flex">

    <div class="col-md-4 border-end border-grey">
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

        <input type="hidden" id="urgencia" name="urgencia" value="{{ $solicitacao->urgencia}}">

        <label for="convenio">Convenio:</label>
        <div class="select_alterar">
            <input type="hidden" id="convenioHidden" name="convenio" value="{{ $solicitacao->convenio}}">
            <select id="convenio" name="convenioSelect" onchange="atualizarHidden('convenio')" disabled>
                <option value="nenhum" @selected($solicitacao->convenio === "nenhum")>Nenhum</option>
                <option value="particular" @selected($solicitacao->convenio === "particular")>Particular</option>
                <option value="luzvida" @selected($solicitacao->convenio === "luzvida")>Luz e Vida</option>
                <option value="viva" @selected($solicitacao->convenio === "viva")>Viva</option>
                <option value="judicial" @selected($solicitacao->convenio === "judicial")>Judicial</option>
            </select>
        <button type="button" class="alterar-btn" onclick="alterar('convenio')">Alterar</button>
        </div>

        <p><strong>Data de Solicitação:</strong> {{ \Carbon\Carbon::parse($solicitacao->data_solicitacao)->format('d/m/Y H:i') }}</p>

        <p><strong>Origem do Orçamento:</strong> {{$solicitacao->origem_orcamento === 'site' ? 'Site' : $solicitacao->origem_orcamento}}</p>
        <input type="hidden" name="origem_orcamento" value="{{ $solicitacao->origem_orcamento }}">

        <p><strong>Protocolo:</strong> {{$solicitacao->protocolo}}</p>
        <input type="hidden" name="protocolo" value="{{ $solicitacao->protocolo }}">

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

    <div class="col-md-4">
        <p><strong>Resumo do Procedimento:</strong></p>
        <textarea name="resumoProcedimento" id="resumo_procedimento" rows="4">{{$solicitacao->resumo_procedimento}}</textarea>


        <p><strong>Detalhes do Procedimento:</strong></p>
        <textarea name="detalhesProcedimento" id="detalhes_procedimento" rows="4">{{$solicitacao->detalhes_procedimento}}</textarea>

        <label for="data_provavel">Data Provável:</label>
        <input type="date" id="data_provavel" name="data_provavel" value="{{$solicitacao->data_provavel}}">

    </div>
    <div class="col-md-4 border-end border-grey">

    @if($solicitacao->tempo_cirurgia == 0)
            <p><strong>Tempo Cirúrgico Previsto:</strong> Não Informado</p>
        @else
            <p><strong>Tempo Cirúrgico Previsto:</strong> {{$solicitacao->tempo_cirurgia}} Horas</p>
        @endif

        <p><strong>Anestesias Selecionadas:</strong></p>

        @php
            $anestesias = [];

            if ($solicitacao->anestesia_raqui) $anestesias[] = 'Raquianestesia';
            if ($solicitacao->anestesia_sma) $anestesias[] = 'SMA (Sedação + Monitorização Anestésica)';
            if ($solicitacao->anestesia_peridural) $anestesias[] = 'Peridural';
            if ($solicitacao->anestesia_sedacao) $anestesias[] = 'Sedação';
            if ($solicitacao->anestesia_externo) $anestesias[] = 'Anestesia Externa';
            if ($solicitacao->anestesia_bloqueio) $anestesias[] = 'Bloqueio';
            if ($solicitacao->anestesia_local) $anestesias[] = 'Anestesia Local';
            if (!empty($solicitacao->anestesia_outros)) $anestesias[] = $solicitacao->anestesia_outros;

            $diarias = [];
            if ($solicitacao->diarias_enfermaria > 0) $diarias[] = "Enfermaria: {$solicitacao->diarias_enfermaria} diária(s)";
            if ($solicitacao->diarias_apartamento > 0) $diarias[] = "Apartamento: {$solicitacao->diarias_apartamento} diária(s)";
            if ($solicitacao->diarias_uti > 0) $diarias[] = "UTI: {$solicitacao->diarias_uti} diária(s)";
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
