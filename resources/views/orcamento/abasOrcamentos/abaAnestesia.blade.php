<div class="row">
    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_raqui" id="anestesia_raqui" value="1" {{ ($orcamento->anestesia_raqui ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_raqui">
                Anestesia Raqui
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_sma" id="anestesia_sma" value="1" {{ ($orcamento->anestesia_sma ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_sma">
                Anestesia SMA
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_peridural" id="anestesia_peridural" value="1" {{ ($orcamento->anestesia_peridural ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_peridural">
                Anestesia Peridural
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_sedacao" id="anestesia_sedacao" value="1" {{ ($orcamento->anestesia_sedacao ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_sedacao">
                Anestesia Sedação
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_externo" id="anestesia_externo" value="1" {{ ($orcamento->anestesia_externo ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_externo">
                Anestesia Externo
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_bloqueio" id="anestesia_bloqueio" value="1" {{ ($orcamento->anestesia_bloqueio ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_bloqueio">
                Anestesia Bloqueio
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_local" id="anestesia_local" value="1" {{ ($orcamento->anestesia_local ?? 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_local">
                Anestesia Local
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
    </div>
</div>

<div class="row">
    <div class="col-3">
        <label for="anestesia_outros" class="form-label">Outras Anestesias</label>
        <input type="text" name="anestesia_outros" class="form-control" value="{{ old('anestesia_outros', $orcamento->anestesia_outros) }}">
    </div>
</div>

<div class="preco_anestesista row d-flex flex-direction-row disabled">
    <div class="col-6 flex-fill border-end">
        <h5 class="mt-4 mb-2">Honorários Anestesia</h5>

        <input type="hidden" id="precosAnestesistaLoad" value='{{json_encode($orcamento->taxa_anestesista ?? "[]") }}'>

        <input type="hidden" name="taxa_anestesia" id="taxa_anestesia_hidden" value='{{ json_encode($orcamento->taxa_anestesista ?? "[]") }}'>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th scope="col" class="col-6">Descrição</th>
                <th scope="col" class="col">Valor</th>
                <th scope="col" class="d-none prazoAnestesia col">A prazo</th>
                <th scope="col" class="col">Ação</th>
            </tr>
            </thead>
            <tbody id="tabelaAnestesia">
                <tr>
                    <td><input class="form-control" id="taxaAnestesiaNome0" name="taxaAnestesiaNome0" value="Taxa Anestesista" disabled></input></td>
                    <td>
                        <input type="text" id="taxaAnestesiaValor0" name="taxaAnestesiaValor0" class="form-control taxaAnestesia money text-end"
                        value="{{ !empty($orcamento->taxa_anestesista['id0'])
                            ? $orcamento->taxa_anestesista['id0']['Valor']
                            : (!empty($orcamento->taxa_anestesista['taxaAnestesia'])
                                    ? ($orcamento->taxa_anestesista['taxaAnestesia'])
                                    : '00,00') }}" onblur="calcularTotalAnestesia()">
                    </td>
                    <td class="prazoAnestesia d-none">
                        <input type="text" id="taxaAnestesiaPrazo0" name="taxaAnestesiaPrazo0" class="form-control d-none prazoAnestesia taxaPrazoAnestesia money text-end"
                        value="{{ !empty($orcamento->taxa_anestesista['id0']) ? $orcamento->taxa_anestesista['id0']['Prazo'] : '00,00' }}" onblur="calcularTotalPrazoAnestesia()">
                    </td>
                </tr>
                <tr>
                    <td scope="row"><strong>Total</strong></td>
                    <td class="text-end"><strong id="totalAnestesia">0,00</strong></td>
                    <td class="text-end prazoAnestesia d-none"><strong id="totalPrazoAnestesia">0,00</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary mt-2" onclick="adicionarOutroCusto()">Adicionar Outros Custos de Anestesia</button>
        <button type="button" class="btn btn-primary prazoAnestesia mt-2" onclick="addVisibilidadePrazoAnestesia()">Adicionar Valores a Prazo</button>
        <button type="button" class="btn btn-primary prazoAnestesia d-none mt-2" onclick="removeVisibilidadePrazoAnestesia()">Remover Valores a Prazo</button>
    </div>


    <div class="col-6 flex-fill">
        <div class="mt-4 mb-2">
            <label for="presetSelectAnestesista">Modelo de Condições de Pagamento - Anestesista</label>
            <div class="select_alterar mb-2">
                <select id="presetSelectAnestesista">
                    @php
                        $padraoAnestesista = optional($modeloPadroes->get('pagamento_anestesista'))->modelo->conteudo ?? null;
                        $condPagAnestesista = $orcamento->cond_pagamento_anestesista;
                    @endphp

                    <option value="{{ $padraoAnestesista }}"
                        @if(is_null($condPagAnestesista)) selected @endif>
                        Padrão de Modelo
                    </option>

                    <option value=""
                        @if($condPagAnestesista === '') selected @endif>
                        Nenhum
                    </option>

                    @if(!is_null($condPagAnestesista) && $condPagAnestesista !== '')
                        <option value="{{ $condPagAnestesista }}" selected>
                            Salvo para esse orçamento
                        </option>
                    @endif

                    @foreach ($modelos as $modelo)
                        <option value="{{ $modelo['conteudo'] }}" data-nome="{{ $modelo['nome'] }}">
                            {{ $modelo['nome'] }}
                        </option>
                    @endforeach
                </select>

                <button type="button" id="insertPresetAnestesista" class="alterar-btn">Adicionar</button>
            </div>

            <label for="condPagamentoAnestesista">Condições de Pagamento</label>
            <textarea id="condPagamentoAnestesista" name="condPagamentoAnestesista">
                <?= old('condPagamentoAnestesista', $orcamento->cond_pagamento_anestesista ?? '') ?>
            </textarea>
        </div>
    </div>
</div>
