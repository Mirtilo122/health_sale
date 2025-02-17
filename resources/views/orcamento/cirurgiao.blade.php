@extends('orcamento.layoutsOrcamentos.layoutPadrao')

@section('action', '/orcamento/cirurgiaoSalvar')



@section('resumo')

<a href="/dashboard" class="btn btn-secondary btn-sm">Sair sem salvar</a>
<button type="submit" class="btn btn-primary btn-sm" id="salvarSair">Salvar e Sair</button>
<button type="submit" class="btn btn-success btn-sm" onclick="prepararEnvio('cirurgiao')">Prosseguir</button>
</div>
</div>
</div>

@endsection



@section('abas')

<style>

.preco_anestesista.disabled {
    pointer-events: none;
    opacity: 0.8;
}

.preco_anestesista.disabled .alterar-btn{
background-color:rgb(224, 224, 224);
color: black;
}

</style>

    <input type="hidden" name="status" id="status" value="cirurgiao">
    <input type="hidden" name="tipo_data" id="tipo_data" value="data_anestesista">

    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="procedimentos-tab" data-bs-toggle="tab" data-bs-target="#procedimentos-tab-pane" type="button" role="tab" aria-controls="procedimentos-tab-pane" aria-selected="false">Cirurgião</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="anestesista-tab" data-bs-toggle="tab" data-bs-target="#anestesista-tab-pane" type="button" role="tab" aria-controls="anestesista-tab-pane" aria-selected="false">Anestesista</button>
    </li>


@endsection

@section('conteudoAbas')

            <div class="tab-pane fade show active" id="procedimentos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                @include('orcamento.abasOrcamentos.abaCirurgiao')

            </div>

            <div class="tab-pane fade show" id="anestesista-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <h4>Área do Anestesista</h4>

                @include('orcamento.abasOrcamentos.abaAnestesia')

            </div>

@endsection
