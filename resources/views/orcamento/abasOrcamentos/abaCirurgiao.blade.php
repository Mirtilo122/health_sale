<div class="row d-flex flex-direction-row">
    <div class="col-9 flex-fill">
        <p><strong>Resumo do Procedimento:</strong></p>
        <input type="text" name="resumoProcedimento" id="resumo_procedimento" value="{{$solicitacao->resumo_procedimento}}"></input>
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Data Provável:</label>
        <input type="date" id="data_provavel2" name="data_provavel" value="{{$solicitacao->data_provavel}}">
    </div>
    <div class="col-1 flex-fill d-flex align-items-center gap-2 justify-content-center pt-4">
        <input type="checkbox" id="urgente" name="urgente" value="1" {{$solicitacao->urgente ? 'checked' : ''}}>
        <label for="urgente">Urgente</label>
    </div>
</div>

<div class="row d-flex flex-direction-row mb-3">
    <div class="col-10 flex-fill">
        <p><strong>Detalhes do Procedimento:</strong></p>
        <input type="text" name="detalhesProcedimento" id="detalhes_procedimento" value="{{$solicitacao->detalhes_procedimento}}">
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Tempo Previsto Em Horas:</label>
        <input type="number" id="tempo_cirurgia" name="tempo_cirurgia" value="{{$solicitacao->tempo_cirurgia}}" step="0.5">
    </div>
</div>

<input type="hidden" name="taxa_cirurgiao" id="taxa_cirurgiao_hidden" value='{{ json_encode($orcamento->taxa_cirurgiao ?? []) }}'>

<div class="tabela_precos_cirurgia row d-flex flex-direction-row">
    <div class="col-6 flex-fill border-end">
        <h5 class=" mb-2">Honorários Cirurgião</h5>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="col-10">Descrição</th>
                    <th scope="col" class="col-2">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">Cirurgião Principal</td>
                    <td><input type="number" id="valorCirurgiao" name="cirurgiaoPrincipal" class="form-control money" value="{{ $orcamento->taxa_cirurgiao['cirurgiaoPrincipal'] ?? '' }}" oninput="atualizarTaxaCirurgiao()"></td>
                </tr>
                <tr>
                    <td scope="row">Cirurgião Auxiliar</td>
                    <td><input type="number" id="valorCirurgiao" name="cirurgiaoAuxiliar" class="form-control money" value="{{ $orcamento->taxa_cirurgiao['cirurgiaoAuxiliar'] ?? '' }}" oninput="calcularTotal()"></td>
                </tr>
                <tr>
                    <td scope="row">Instrumentador</td>
                    <td><input type="number" id="valorCirurgiao" name="instrumentador" class="form-control money" value="{{ $orcamento->taxa_cirurgiao['instrumentador'] ?? '' }}" oninput="calcularTotal()"></td>
                </tr>
                <tr>
                    <td scope="row">Outros Custos de Cirurgião</td>
                    <td><input type="number" id="valorCirurgiao" name="outrosCustos" class="form-control money" value="{{ $orcamento->taxa_cirurgiao['outrosCustos'] ?? '' }}" oninput="calcularTotal()"></td>
                </tr>
                <tr>
                    <td scope="row"><strong>Total</strong></td>
                    <td><strong id="totalCirurgiao">0.00</strong></td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="col-6 flex-fill">
    <h5 class="mb-2">Acomodações</h5>
        <div class="row d-flex flex-direction-row mt-2">
            <div class="col-4 flex-fill d-flex gap-4">
                <p>Enfermaria:</p>
                <input type="number" id="diarias_enfermaria" name="diarias_enfermaria" value="{{$solicitacao->diarias_enfermaria}}" class="w-25">
            </div>

            <div class="col-4 flex-fill d-flex gap-4">
                <p>Apartamento</p>
                <input type="number" id="diarias_apartamento" name="diarias_apartamento" value="{{$solicitacao->diarias_apartamento}}" class="w-25">
            </div>

            <div class="col-4 flex-fill d-flex gap-4">
                <p>Diárias UTI</p>
                <input type="number" id="diarias_uti" name="diarias_uti" value="{{$solicitacao->diarias_uti}}" class="w-25">
            </div>
        </div>

        <div class="mt-4 mb-2">
            <label for="condPagamentoCirurgiao">Condições de Pagamento</label>
            <textarea id="condPagamentoCirurgiao" name="condPagamentoCirurgiao">
                <?= old('condPagamentoCirurgiao', $orcamento->cond_pagamento_cirurgiao ?? '') ?>
            </textarea>
        </div>
    </div>
</div>


<br>



