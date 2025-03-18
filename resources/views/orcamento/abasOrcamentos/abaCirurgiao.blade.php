<div class="row d-flex flex-direction-row">
    <div class="col-9 flex-fill">
        <p><strong>Resumo do Procedimento:</strong></p>
        <input type="text" name="resumoProcedimento" id="resumo_procedimento" value="{{$solicitacao->resumo_procedimento}}"></input>
    </div>
    <div class="col-2 flex-fill">
        <label for="data_provavel">Data Provável:</label>
        <div class="input-container">
            <input type="text" id="data_provavel"
                placeholder="DD/MM/AAAA"
                value="{{ \Carbon\Carbon::parse($solicitacao->data_provavel)->format('d/m/Y') }}"
                oninput="formatDate(this)"/>
            <input type="date" id="hidden-data_provavel"
                name="data_provavel"
                value="{{$solicitacao->data_provavel}}"
                style="display: none;"/>
            <button type="button" class="calendar-button mb-3" title="Clique para abrir o calendário"
                    onclick="openDatePicker('data_provavel')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                </svg>
            </button>
        </div>
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
                    <td><input type="text" id="valorCirurgiao" name="cirurgiaoPrincipal" class="form-control taxaCirurgiao money text-end" value="{{ $orcamento->taxa_cirurgiao['cirurgiaoPrincipal'] ?? '' }}" onblur="try { calcularTotal(); } catch(e) { console.error('Erro ao chamar calcularTotalCirurgiao:', e); }">
                </tr>
                <tr>
                    <td scope="row">Cirurgião Auxiliar</td>
                    <td><input type="text" id="valorCirurgiao" name="cirurgiaoAuxiliar" class="form-control taxaCirurgiao money text-end" value="{{ $orcamento->taxa_cirurgiao['cirurgiaoAuxiliar'] ?? '' }}" onblur="try { calcularTotal(); } catch(e) { console.error('Erro ao chamar calcularTotalCirurgiao:', e); }">
                </tr>
                <tr>
                    <td scope="row">Instrumentador</td>
                    <td><input type="text" id="valorCirurgiao" name="instrumentador" class="form-control taxaCirurgiao money text-end" value="{{ $orcamento->taxa_cirurgiao['instrumentador'] ?? '' }}" onblur="try { calcularTotal(); } catch(e) { console.error('Erro ao chamar calcularTotalCirurgiao:', e); }">
                </tr>
                <tr>
                    <td scope="row">Taxa de Video</td>
                    <td><input type="text" id="valorCirurgiao" name="outrosCustos" class="form-control taxaCirurgiao money text-end" value="{{ $orcamento->taxa_cirurgiao['outrosCustos'] ?? '' }}" onblur="try { calcularTotal(); } catch(e) { console.error('Erro ao chamar calcularTotalCirurgiao:', e); }">
                </tr>
                <tr>
                    <td scope="row"><strong>Total</strong></td>
                    <td class="text-end"><strong id="totalCirurgiao">0,00</strong></td>
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



