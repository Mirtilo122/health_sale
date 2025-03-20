@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/anestesistaSalvar')



@section('resumo')

<button type="submit" class="btn btn-primary btn-sm" id="salvarSair">Salvar e Sair</button>
<button type="submit" class="btn btn-success btn-sm" onclick="prepararEnvio('anestesista')">Prosseguir</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection



@section('abas')

<style>

.tab-pane.disabled {
    pointer-events: none;
    opacity: 0.8;
}

.tab-pane.disabled .alterar-btn{
background-color:rgb(224, 224, 224);
color: black;
}

.tab-pane.disabled .btn-primary{
background-color:rgb(224, 224, 224);
color: black;
border: black;
}

</style>

    <input type="hidden" name="status" id="statusHidden" value="anestesista">
    <input type="hidden" name="tipo_data" id="tipo_data" value="data_criacao">
    <input type="hidden" name="aba_ativa" id="aba_ativa" value="anestesista-tab">

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Cirurgião</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane" type="button" role="tab" aria-controls="anestesista-tab-pane" aria-selected="false">Anestesista</button>
    </li>

@endsection

@section('conteudoAbas')

            <div class="tab-pane fade show disabled" id="procedimentos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Área do Cirurgião</h4>

                @include('orcamento.abasOrcamentos.abaCirurgiao')

            </div>

            <div class="tab-pane fade show active" id="anestesista-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Área do Anestesista</h4>

                @include('orcamento.abasOrcamentos.abaAnestesia')

            </div>

@endsection
