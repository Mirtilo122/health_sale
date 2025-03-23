<div class="row d-flex flex-direction-row">
    <div class="col-9 flex-fill">
        <p><strong>Resumo do Procedimento:</strong></p>
        <input type="text" name="resumo_procedimento" class="resumo_procedimento" id="cir_resumo_procedimento" value="{{$dados->resumo_procedimento}}"></input>
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Data Provável:</label>
        <div class="input-container">
            <input type="text" class="sync-date" id="cir_data_provavel"
                placeholder="DD/MM/AAAA"
                value="{{ $dados->data_provavel ? \Carbon\Carbon::parse($dados->data_provavel)->timezone(config('app.timezone'))->format('d/m/Y') : '' }}"
                oninput="formatDate(this)"/>
            <input type="date" class="sync-date" id="hidden-cir_data_provavel"
                name="data_provavel"
                value="{{ $dados->data_provavel ? \Carbon\Carbon::parse($dados->data_provavel)->timezone(config('app.timezone'))->format('Y-m-d') : '' }}"
                style="display: none;"/>
            <button type="button" class="calendar-button mb-3" title="Clique para abrir o calendário"
                    onclick="openDatePicker('cir_data_provavel')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="col-1 flex-fill d-flex align-items-center gap-2 justify-content-center pt-4">
        <input type="checkbox" id="urgente" name="urgente" value="1" {{$dados->urgente ? 'checked' : ''}}>
        <label for="urgente">Urgente</label>
    </div>
</div>

<div class="row d-flex flex-direction-row mb-3">
    <div class="col-10 flex-fill">
        <p><strong>Detalhes do Procedimento:</strong></p>
        <input type="text" name="detalhes_procedimento" class="detalhesProcedimento" id="cir_detalhes_procedimento" value="{{$dados->detalhes_procedimento}}">
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Tempo Previsto Em Horas:</label>
        <input type="number" id="cir_tempo_cirurgia" class="tempo_cirurgia" name="tempo_cirurgia" value="{{$dados->tempo_cirurgia}}" step="0.5">
    </div>
</div>




<input type="hidden" id="precosCirurgiaoLoad" value='{{json_encode($orcamento->taxa_cirurgiao ?? "[]") }}'>

<input type="hidden" name="taxa_cirurgiao" id="taxa_cirurgiao_hidden" value='{{ json_encode($orcamento->taxa_cirurgiao ?? "[]") }}'>

<div class="tabela_precos_cirurgia row d-flex flex-direction-row">
    <div class="col-6 flex-fill border-end">
        <h5 class=" mb-2">Honorários Cirurgião</h5>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="col-6">Descrição</th>
                    <th scope="col" class="col">Valor</th>
                    <th scope="col" class="d-none prazoCirurgiao col">A prazo</th>
                    <th scope="col" class="col">Ação</th>
                </tr>
            </thead>
            <tbody id="tabelaCirurgiao">



                <tr>
                    <td><input class="form-control" id="taxaCirurgiaoNome0" name="taxaCirurgiaoNome0" value="Cirurgião Principal" disabled></input></td>
                    <td>
                        <input type="text" id="taxaCirurgiaoValor0" name="taxaCirurgiaoValor0" class="form-control taxaCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id0'])
                            ? $orcamento->taxa_cirurgiao['id0']['Valor']
                            : (!empty($orcamento->taxa_cirurgiao['cirurgiaoPrincipal'])
                                    ? ($orcamento->taxa_cirurgiao['cirurgiaoPrincipal'])
                                    : '00,00') }}" onblur="calcularTotal()">
                    </td>
                    <td class="prazoCirurgiao d-none">
                        <input type="text" id="taxaCirurgiaoPrazo0" name="taxaCirurgiaoPrazo0" class="form-control d-none prazoCirurgiao taxaPrazoCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id0']) ? $orcamento->taxa_cirurgiao['id0']['Prazo'] : '00,00' }}" onblur="calcularTotalPrazoCirurgiao()">
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td><input class="form-control" id="taxaCirurgiaoNome1" name="taxaCirurgiaoNome1" value="Cirurgião Auxiliar" disabled></input></td>
                    <td>
                        <input type="text" id="taxaCirurgiaoValor1" name="taxaCirurgiaoValor1" class="form-control taxaCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id1'])
                            ? $orcamento->taxa_cirurgiao['id1']['Valor']
                            : (!empty($orcamento->taxa_cirurgiao['cirurgiaoAuxiliar'])
                                    ? ($orcamento->taxa_cirurgiao['cirurgiaoAuxiliar'])
                                    : '00,00') }}" onblur="calcularTotal()">
                    </td>
                    <td class="prazoCirurgiao d-none">
                        <input type="text" id="taxaCirurgiaoPrazo1" name="taxaCirurgiaoPrazo1" class="form-control d-none prazoCirurgiao taxaPrazoCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id1']) ? $orcamento->taxa_cirurgiao['id1']['Prazo'] : '00,00' }}" onblur="calcularTotalPrazoCirurgiao()">
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td><input class="form-control" id="taxaCirurgiaoNome2" name="taxaCirurgiaoNome2" value="Instrumentador" disabled></input></td>
                    <td>
                        <input type="text" id="taxaCirurgiaoValor2" name="taxaCirurgiaoValor2" class="form-control taxaCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id2'])
                            ? $orcamento->taxa_cirurgiao['id2']['Valor']
                            : (!empty($orcamento->taxa_cirurgiao['instrumentador'])
                                    ? ($orcamento->taxa_cirurgiao['instrumentador'])
                                    : '00,00') }}" onblur="calcularTotal()">
                    </td>
                    <td class="prazoCirurgiao d-none">
                        <input type="text" id="taxaCirurgiaoPrazo2" name="taxaCirurgiaoPrazo2" class="form-control d-none prazoCirurgiao taxaPrazoCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id2']) ? $orcamento->taxa_cirurgiao['id2']['Prazo'] : '00,00' }}" onblur="calcularTotalPrazoCirurgiao()">
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td><input class="form-control" id="taxaCirurgiaoNome3" name="taxaCirurgiaoNome3" value="Taxa de Video" disabled></input></td>
                    <td>
                        <input type="text" id="taxaCirurgiaoValor3" name="taxaCirurgiaoValor3" class="form-control taxaCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id3'])
                            ? $orcamento->taxa_cirurgiao['id3']['Valor']
                            : (!empty($orcamento->taxa_cirurgiao['taxaVideo'])
                                    ? ($orcamento->taxa_cirurgiao['taxaVideo'])
                                    : '00,00') }}" onblur="calcularTotal()">
                    <td class="prazoCirurgiao d-none">
                        <input type="text" id="taxaCirurgiaoPrazo3" name="taxaCirurgiaoPrazo3" class="form-control d-none prazoCirurgiao taxaPrazoCirurgiao money text-end"
                        value="{{ !empty($orcamento->taxa_cirurgiao['id3']) ? $orcamento->taxa_cirurgiao['id3']['Prazo'] : '00,00' }}" onblur="calcularTotalPrazoCirurgiao()">
                    </td>
                    <td></td>
                </tr>


                <tr>
                    <td scope="row"><strong>Total</strong></td>
                    <td class="text-end"><strong id="totalCirurgiao">0,00</strong></td>
                    <td class="text-end prazoCirurgiao d-none"><strong id="totalPrazoCirurgiao">0,00</strong></td>
                </tr>



            </tbody>
        </table>


        <button type="button" class="btn btn-primary mt-2" onclick="adicionarOutroCustoCirurgiao()">Adicionar Outros Custos de Cirurgião</button>
        <button type="button" class="btn btn-primary prazoCirurgiao mt-2" onclick="addVisibilidadePrazoCirurgiao()">Adicionar Valores a Prazo</button>
        <button type="button" class="btn btn-primary prazoCirurgiao d-none mt-2" onclick="removeVisibilidadePrazoCirurgiao()">Remover Valores a Prazo</button>



    </div>

    <div class="col-6 flex-fill">
    <h5 class="mb-2">Acomodações</h5>
        <div class="row d-flex flex-direction-row mt-2">
            <div class="col-4 flex-fill d-flex gap-4">
                <p>Enfermaria:</p>
                <input type="number" class="diarias_enfermaria" id="cir_diarias_enfermaria" name="diarias_enfermaria" class="w-25" value="{{$dados->diarias_enfermaria}}">
            </div>

            <div class="col-4 flex-fill d-flex gap-4">
                <p>Apartamento</p>
                <input type="number" class="diarias_apartamento" id="cir_diarias_apartamento" name="diarias_apartamento" class="w-25" value="{{$dados->diarias_apartamento}}">
            </div>

            <div class="col-4 flex-fill d-flex gap-4">
                <p>Diárias UTI</p>
                <input type="number" class="diarias_uti" id="cir_diarias_uti" name="diarias_uti" class="w-25" value="{{$dados->diarias_uti}}">
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



