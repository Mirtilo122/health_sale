



<div class="row">
<div class="col-10">
    <label for="condPagamentoHosp">Condições de Pagamento</label>
    <textarea id="condPagamentoHosp" name="condPagamentoHosp">
        <?= old('condPagamentoHosp', $orcamento->cond_pagamento_hosp ?? '') ?>
    </textarea>
</div>
<div class="col-2">
    <label for="validade">Validade do Orçamento:</label>
    
    <input type="date" id="validade" name="validade"
        value="<?= old('validade', isset($orcamento->validade) ? $orcamento->validade : '') ?>" />
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

