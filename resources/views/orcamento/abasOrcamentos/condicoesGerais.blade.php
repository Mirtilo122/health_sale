



<div class="row">
<div class="col-10">
    <label for="condPagamentoHosp">Condições de Pagamento</label>
    <textarea id="condPagamentoHosp" name="condPagamentoHosp">
        <?= old('condPagamentoHosp', $orcamento->cond_pagamento_hosp ?? '') ?>
    </textarea>
</div>
<div class="col-2">
        <label for="validade">Validade do Orçamento:</label>
        <div class="input-container">
            <input type="text" id="validade"
                placeholder="DD/MM/AAAA"
                value="{{ old('validade', isset($orcamento->validade) ? $orcamento->validade : '') }}"
                oninput="formatDate(this)"/>
            <input type="date" id="hidden-validade"
                name="validade"
                value="{{old('validade', isset($orcamento->validade) ? $orcamento->validade : '')}}"
                style="display: none;"/>
            <button type="button" class="calendar-button" title="Clique para abrir o calendário"
                    onclick="openDatePicker('validade')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>
</div>
</div>

<h4 class="mt-2">Condições Gerais</h4>

<div class="select_alterar mb-4">
    <select id="presetSelect">
        <option value="{{ $orcamento->condicoes_gerais }}" selected>Salvo para esse orçamento
        </option>
        @foreach ($modelos as $modelo)
            <option value="{{ $modelo['conteudo'] }}" data-nome="{{ $modelo['nome'] }}">
                {{ $modelo['nome'] }}
            </option>
        @endforeach
    </select>
    <button type="button" id="insertPreset" class="alterar-btn">Adicionar</button>
</div>

<textarea id="editor" name="condicoes_gerais"></textarea>

