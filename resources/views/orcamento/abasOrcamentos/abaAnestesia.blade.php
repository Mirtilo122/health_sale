<div class="row">
    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_raqui" id="anestesia_raqui" value="1" {{ $orcamento->anestesia_raqui ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_raqui">
                Anestesia Raqui
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_sma" id="anestesia_sma" value="1" {{ $orcamento->anestesia_sma ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_sma">
                Anestesia SMA
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_peridural" id="anestesia_peridural" value="1" {{ $orcamento->anestesia_peridural ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_peridural">
                Anestesia Peridural
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_sedacao" id="anestesia_sedacao" value="1" {{ $orcamento->anestesia_sedacao ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_sedacao">
                Anestesia Sedação
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_externo" id="anestesia_externo" value="1" {{ $orcamento->anestesia_externo ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_externo">
                Anestesia Externo
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_bloqueio" id="anestesia_bloqueio" value="1" {{ $orcamento->anestesia_bloqueio ? 'checked' : '' }}>
            <label class="form-check-label" for="anestesia_bloqueio">
                Anestesia Bloqueio
            </label>
        </div>
    </div>

    <div class="col-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="anestesia_local" id="anestesia_local" value="1" {{ $orcamento->anestesia_local ? 'checked' : '' }}>
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

<div class="row d-flex flex-direction-row">
    <div class="col-6 flex-fill border-end">
        <h5 class="mt-4 mb-2">Honorários Anestesia</h5>

        <input type="hidden" name="taxa_anestesia" id="taxa_anestesia_hidden" value='{{ json_encode($orcamento->taxa_anestesista ?? []) }}'>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="col-10">Descrição</th>
                    <th scope="col" class="col-2">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">Taxa Anestesia</td>
                    <td><input type="number" id="taxaAnestesia" name="taxaAnestesia" class="form-control money" value="{{ $orcamento->taxa_anestesista['taxaAnestesia'] ?? '' }}" oninput="atualizarTaxaAnestesia()"></td>
                </tr>
                <tr>
                    <td scope="row">Outros Custos de Anestesia</td>
                    <td><input type="number" id="taxaAnestesia" name="outrosCustosAnestesia" class="form-control money"  value="{{ $orcamento->taxa_anestesista['outrosCustosAnestesia'] ?? '' }}" oninput="calcularTotalAnestesia()"></td>
                </tr>
                <tr>
                    <td scope="row"><strong>Total</strong></td>
                    <td><strong id="totalAnestesia">0.00</strong></td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="col-6 flex-fill">
        <h5 class="mt-4 mb-2">Condições de Pagamento</h5>
        <textarea name="condPagamentoCirurgiao" id="condPagamentoCirurgiao"></textarea>
    </div>
</div>
