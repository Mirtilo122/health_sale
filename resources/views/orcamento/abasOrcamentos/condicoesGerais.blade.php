<h4 class="mt-2">Condições de Pagamento</h4>

<div class="select_alterar mb-4">
    <select id="presetSelectPag">
        @php
            $padraoPag = optional($modeloPadroes->get('pagamento_hospital'))->modelo->conteudo ?? null;
            $condPag = $orcamento->cond_pagamento_hosp;
        @endphp

        <option value="{{ $padraoPag }}"
            @if(is_null($condPag)) selected @endif>
            Padrão de Modelo
        </option>

        <option value=""
            @if($condPag === '') selected @endif>
            Nenhum
        </option>

        @if(!is_null($condPag) && $condPag !== '')
            <option value="{{ $condPag }}" selected>
                Salvo para esse orçamento
            </option>
        @endif

        @foreach ($modelos as $modelo)
            <option value="{{ $modelo['conteudo'] }}" data-nome="{{ $modelo['nome'] }}">
                {{ $modelo['nome'] }}
            </option>
        @endforeach
    </select>
    <button type="button" id="insertPresetPag" class="alterar-btn">Adicionar</button>
</div>

<div class="row">
    <div class="col-10">
        <textarea id="condPagamentoHosp" name="condPagamentoHosp">
            {{ old('condPagamentoHosp', $orcamento->cond_pagamento_hosp ?? '') }}
        </textarea>
    </div>
    <div class="col-2">
        <label for="validade">Validade do Orçamento:</label>
        <div class="input-container">
            <input type="text" id="validade"
                   placeholder="DD/MM/AAAA"
                   value="{{ old('validade', $orcamento->validade ?? '') }}"
                   oninput="formatDate(this)"/>
            <input type="date" id="hidden-validade"
                   name="validade"
                   value="{{ old('validade', $orcamento->validade ?? '') }}"
                   style="display: none;"/>
            <button type="button" class="calendar-button" title="Clique para abrir o calendário"
                    onclick="openDatePicker('validade')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-calendar" viewBox="0 0 16 16">
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<h4 class="mt-2">Condições Gerais</h4>

<div class="select_alterar mb-4">
    <select id="presetSelect">
        @php
            $padraoGerais = optional($modeloPadroes->get('condicoes_gerais'))->modelo->conteudo ?? null;
            $condGerais = $orcamento->condicoes_gerais;
        @endphp

        <option value="{{ $padraoGerais }}"
            @if(is_null($condGerais)) selected @endif>
            Padrão de Modelo
        </option>

        <option value=""
            @if($condGerais === '') selected @endif>
            Nenhum
        </option>

        @if(!is_null($condGerais) && $condGerais !== '')
            <option value="{{ $condGerais }}" selected>
                Salvo para esse orçamento
            </option>
        @endif

        @foreach ($modelos as $modelo)
            <option value="{{ $modelo['conteudo'] }}" data-nome="{{ $modelo['nome'] }}">
                {{ $modelo['nome'] }}
            </option>
        @endforeach
    </select>
    <button type="button" id="insertPreset" class="alterar-btn">Adicionar</button>
</div>

<textarea id="editor" name="condicoes_gerais">
    {{ old('condicoes_gerais', $orcamento->condicoes_gerais ?? '') }}
</textarea>

