<h4>Informações do Paciente</h4>
<div class="row mt-1 d-flex">

    <div class="col-md-4 border-end border-grey">
        <label for="comorbidades">Paciente tem Comorbidades?</label>
        <div class="select_alterar">
            <input type="hidden" id="comorbidadesHidden" name="comorbidades" value="{{ $solicitacao->comorbidades }}">
            <select id="comorbidades" name="comorbidadesPaciente" onchange="toggleComorbidades(); atualizarHidden('comorbidades')" disabled>
                <option value="nao" @selected($solicitacao->comorbidades === "nao")>Não</option>
                <option value="sim" @selected($solicitacao->comorbidades === "sim")>Sim</option>
            </select>
            <button type="button" class="alterar-btn" onclick="alterar('comorbidadesPaciente')">Alterar</button>
        </div>

        <label for="cidadePaciente">Cidade:</label>
        <input type="text" id="cidadePaciente" name="cidade" value="{{$solicitacao->cidade}}" required>


        <div id="comorbidade" class="{{ $solicitacao->comorbidades === 'sim' ? '' : 'd-none' }}">
            <label for="descComorbidades">Descrição das Comorbidades:</label>
            <textarea id="descComorbidades" name="descricao_comorbidades" rows="4" value="{{$solicitacao->descricao_comorbidades}}"></textarea>
        </div>

        <label for="observacoesPaciente">Observações:</label>
        <textarea id="observacoesPaciente" name="observacoes_adicionais" rows="4" value="{{$solicitacao->observacoes_adicionais}}"></textarea>
    </div>

    <div class="col-md-4 border-end border-grey">

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


        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="{{$solicitacao->telefone}}">

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="{{$solicitacao->email}}">

    </div>



    <div class="col-md-4 border-end border-grey">


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

   


    </div>

</div>
