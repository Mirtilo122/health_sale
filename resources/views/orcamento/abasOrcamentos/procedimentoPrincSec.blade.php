<div class="row d-flex flex-direction-row">
    <div class="col-2 flex-fill d-flex">
        <p>Procedimento Principal:</p>
    </div>

    <div class="col-3 flex-fill d-flex">
        <input type="number" id="cod_tuss_principal" name="cod_tuss_principal" value="{{$orcamento->cod_tuss_principal ?? 0}}" placeholder="Insira o Código TUSS...">
    </div>

    <div class="col-6 flex-fill d-flex">
        <input type="text" id="procedimento_principal" name="procedimento_principal" value="{{$orcamento->procedimento_principal ?? ''}}" placeholder="Insira o Procedimento...">
    </div>

    <div class="col-1 flex-fill d-flex">
    </div>
</div>

<input type="hidden" name="procedimentos_json" id="procedimentos_json">

<br>

<div id="procedimentos-container">

</div>

<button type="button" class="alterar-btn" onclick="adicionarSecundario()">Adicionar Procedimento Secundário</button>
